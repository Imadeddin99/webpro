<?php
session_start();
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

$sql = "SELECT pass FROM employee where id=" . $_SESSION['ID'] ;
$result = $conn->query($sql);

if ($result&&$result->num_rows > 0) {
    // output data of each row
    $row=$result->fetch_assoc();
  if($row['pass']==$_POST['passs']) {

      $sql = "SELECT number FROM log where number=" . $_POST['number'];
      $res = $conn->query($sql);
      if ($res &&$res->num_rows == 0) {
          $no = $_POST['number'];
          $date = $_POST['eff'];
          $app=$_SESSION['first']." ".$_SESSION['last'];
          $sql = "INSERT INTO log (number, version, eff,approved) VALUES('$no', '00', '$date','$app')";
          $conn->query($sql);
          echo "inserted";
$conn->close();
          $_SESSION['logadd'] = "Log Added Successfully";
          header("Location:filePage.php");

      } else {
          //say it does exist
          $_SESSION['logadd'] = "Log does exist , Addition Failed";
header("Location:filePage.php");
      }
  }
  else{
      header("Location:filePage.php");

      $_SESSION['logadd'] = "pass isn't correct";
      }


} else {
    $_SESSION['logadd']="Something wrong happened";
    header("Location:filePage.php");

}






?>