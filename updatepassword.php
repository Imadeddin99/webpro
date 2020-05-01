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


$sql = "update employee set pass='" .password_hash($_POST['pass'],PASSWORD_DEFAULT). "'where id =" . $_SESSION['ID'];
$result = $conn->query($sql);
$conn->close();
$_SESSION['response']="the password has been changed";
header("Location:index.php");




