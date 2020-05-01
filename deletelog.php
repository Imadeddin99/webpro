<?php
session_start();
if (empty($_SESSION)||!isset($_SESSION)){
    header("Location:index.php");
    exit();
}
if ($_POST['type']=='delete') {
    $servername = "localhost";
    $username = 'root';
    $pass = '';
    $dbname = 'projectdb';
    $conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "select number,depcode from sop where logno='" . $_POST['log'] . "'";


    $result=$conn->query($sql);

    while ($result&&$result2=$result->fetch_assoc()){


        $sql1="delete from relatedlog where sop='".$result2['number']."' and realdept='".$result2['depcode']."'";
        if($conn->query($sql1)!==true)die("deleting failed Failed".$conn->error);


        $sql1="delete from relateddept where sop='".$result2['number']."' and realdept='".$result2['depcode']."'";
        if($conn->query($sql1)!==true)die("deleting failed Failed".$conn->error);

        $sql1="delete from relatedform where sop='".$result2['number']."' and realdept='".$result2['depcode']."'";
        if($conn->query($sql1)!==true)die("deleting failed Failed".$conn->error);




    }


    $sql="delete from sop where logno='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);


    $sql="delete from relatedlog where log='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);

    $sql="delete from log where number='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);

    $sql="delete from form where logno='".$_POST['log']."'";
    $conn->query($sql);

    $sql="delete from formrelateddept where log='".$_POST['log']."'";
    $conn->query($sql);

    $notifno = 0;
    $sql11 = "select * from notification order by number desc";
    $result11 = $conn->query($sql11);
    if ($result11 && $result11->num_rows > 0) {
        $row1 = $result11->fetch_assoc();
        $notifno = $row1['number'] + 1;
    }

    $title="LOG-".$_POST['log'];
    $user = $_SESSION['first'] . " " . $_SESSION['last'];
    $today = date('Y-n-j');
    $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user deleted a log  : $title ', '$today','LOG Deleted')";
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






