<?php


$servername = "localhost";
$username='root';
$pass='';
$dbname='projectdb';
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}



if($_POST['type']=="delete"){

    $sql = "delete from employee where id=".$_POST['id'];
    $result = $conn->query($sql);
    header("Location:employeePage.php");
}
else if($_POST['type']=="edit"){




}









?>