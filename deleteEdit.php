<?php

session_start();
if (empty($_SESSION)||!isset($_SESSION)){
    header("Location:index.php");
    exit();
}
$servername = "localhost";
$username='root';
$pass='';
$dbname='projectdb';
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}

$sql11 = "select * from employee where id=".$_POST['id'];
$result11 = $conn->query($sql11);
$row11=$result11->fetch_assoc();
$title=$row11['firstName']." ".$row11["last_name"];

if($_POST['type']=="delete"){

    $sql = "delete from employee where id=".$_POST['id'];
    $result = $conn->query($sql);

    $notifno = 0;
    $sql11 = "select * from notification order by number desc";
    $result11 = $conn->query($sql11);
    if ($result11 && $result11->num_rows > 0) {
        $row1 = $result11->fetch_assoc();
        $notifno = $row1['number'] + 1;
    }

    $user = $_SESSION['first'] . " " . $_SESSION['last'];
    $today = date('Y-n-j');
    $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user deleted an employee  : $title ', '$today','User Deleted')";
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






    header("Location:employeePage.php");
}
else if($_POST['type']=="edit"){




}









?>