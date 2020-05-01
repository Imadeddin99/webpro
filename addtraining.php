<?php
session_start();
if (empty($_SESSION)||!isset($_SESSION)){
    header("Location:index.php");
    exit();
}
include 'adminNav.php';
$servername = "localhost";
$username='root';
$pass='';
$dbname='projectdb';
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}


$title=$_POST['title'];
$complete=$_POST['complete'];

$signed=$_SESSION['first']." ".$_SESSION['last'];
$signed=mysqli_escape_string($conn,$signed);
$id=$_GET['id'];
$sql="insert into training(title,complete,signed,id) values('$title','$complete','$signed','$id')";
if ($conn->query($sql)){

    $notifno = 0;
    $sql11 = "select * from notification order by number desc";
    $result11 = $conn->query($sql11);
    if ($result11 && $result11->num_rows > 0) {
        $row1 = $result11->fetch_assoc();
        $notifno = $row1['number'] + 1;
    }
   $user2="";
    $sql2222="select * from employee where id=".$id;
    $result2=$conn->query($sql2222);
    $row11=$result2->fetch_assoc();
    $user2=$row11['firstName']." ".$row11['last_name'];
    $user = $_SESSION['first'] . " " . $_SESSION['last'];
    $today = date('Y-n-j');
    $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user added a Training log : $title to the user $user2 ','$today','Traning LOG Added')";
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




    $_SESSION['ress']="Training Log Added Successfully";
    $conn->close();
    header("Location:traning_add.php?id=".$id);
    exit();

}
else{
    $_SESSION['ress']="Training Log was not added";
    $conn->close();
   header("Location:traning_add.php?id=".$id);
    exit();

}