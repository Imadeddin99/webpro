<?php
session_start();
if (empty($_SESSION)||!isset($_SESSION)){
    header("Location:index.php");
    exit();
}
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
  if(password_verify($_POST['passs'],$row["pass"])) {

      $sql = "SELECT number FROM log where number=" . $_POST['number'];
      $res = $conn->query($sql);
      if ($res &&$res->num_rows == 0) {
          $no = $_POST['number'];
          $date = $_POST['eff'];
          $app=$_SESSION['first']." ".$_SESSION['last'];
          $sql = "INSERT INTO log (number, version, eff,approved) VALUES('$no', '00', '$date','$app')";
          $conn->query($sql);
          echo "inserted";

              $notifno = 0;
              $sql11 = "select * from notification order by number desc";
              $result11 = $conn->query($sql11);
              if ($result11 && $result11->num_rows > 0) {
                  $row1 = $result11->fetch_assoc();
                  $notifno = $row1['number'] + 1;
              }


              $user = $_SESSION['first'] . " " . $_SESSION['last'];
              $name = "LOG-" . $no ;
              $today = date('Y-n-j');
              $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user added a LOG $name : $title ', '$today','LOG Added')";
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