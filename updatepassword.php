<?php
session_start();

$servername = "localhost";
$username='root';
$pass='';
$dbname='projectdb';
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}


$sql = "update employee set pass='" .$_POST['pass']. "'where id =" . $_SESSION['id'];
$result = $conn->query($sql);
$conn->close();
$_SESSION['response']="the password has been changed";
header("Location:index.php");




