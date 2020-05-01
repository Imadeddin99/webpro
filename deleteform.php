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


$sql="delete from form where logno='".$_POST['LOG']."'and form='".$_POST['form']."'";
    if($conn->query($sql)){
        $notifno = 0;
        $sql11 = "select * from notification order by number desc";
        $result11 = $conn->query($sql11);
        if ($result11 && $result11->num_rows > 0) {
            $row1 = $result11->fetch_assoc();
            $notifno = $row1['number'] + 1;
        }
        $title="FORM-".$_POST['form'];
        $user = $_SESSION['first'] . " " . $_SESSION['last'];
        $today = date('Y-n-j');
        $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user deleted a form: $title ', '$today','Form Deleted')";
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
    else {
        die($conn->error);
    }

    $sql="delete from formrelateddept where log='".$_POST['LOG']."'and form='".$_POST['form']."'";
    if($conn->query($sql))echo "true";
    else {
        die($conn->error);
    }

}
    ?>