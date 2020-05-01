<?php
session_start();
if (empty($_SESSION)||!isset($_SESSION)){
    header("Location:index.php");
    exit();
}
if($_POST['type']=='delete'){


    $sop=$_POST['sop'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projectdb";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql="delete from sop where number='".$_POST['sop']."' and depcode='".$_POST['dep']."' and logno='".$_POST['log']."'";
if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);

    $sql="delete from relatedlog where sop='".$_POST['sop']."' and realdept='".$_POST['dep']."' and reallog='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);


    $sql="delete from relateddept where sop='".$_POST['sop']."' and realdept='".$_POST['dep']."' and log='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);

    $sql="delete from relatedform where sop='".$_POST['sop']."' and realdept='".$_POST['dep']."' and log='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);

    $notifno = 0;
    $sql11 = "select * from notification order by number desc";
    $result11 = $conn->query($sql11);
    if ($result11 && $result11->num_rows > 0) {
        $row1 = $result11->fetch_assoc();
        $notifno = $row1['number'] + 1;
    }

    $title=$_POST['dep']."-".$_POST['sop'];
    $user = $_SESSION['first'] . " " . $_SESSION['last'];
    $today = date('Y-n-j');
    $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user deleted an sop  : $title ', '$today','SOP Deleted')";
    $conn->query($sql22);
    $sql22="select * from employee where job='Admin'";
    $result11=$conn->query($sql22);
    if ($result11&&$result11->num_rows>0){
        while ($row1=$result11->fetch_assoc()){
            $idddd=$row1['id'];
            $sql111="insert into seen(number ,id,state) values($notifno,$idddd,'notseen')";
            $conn->query($sql111);
        }
    }





}


?>