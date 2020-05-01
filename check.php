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


$sql = "SELECT * FROM employee where id=".$_POST["reg"];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row=$result->fetch_assoc();
if(password_verify($_POST['password'],$row["pass"])){

    $_SESSION['ID']=$_POST['reg'];
    $_SESSION['first']=$row['firstName'];
    $_SESSION['last']=$row['last_name'];
    $_SESSION['depcode']=$row['depcode'];
    if( $row['job_abbr']=="Ad") $_SESSION['job']="Admin";
    else if ( $row['job_abbr']=="QA") $_SESSION['job']="QA";
    else     $_SESSION['job']="user";

    $_SESSION['response']="";
    $conn->close();
header("Location:adminNav.php");
exit();
}
    $conn->close();
$_SESSION['response']="password isn't correct";
    header("Location:index.php");
    exit();


}


else {$conn->close();

    $_SESSION['response']="no such user with this ID";
    header("Location:index.php");
    exit();
}


