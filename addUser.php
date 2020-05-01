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


$sql1="select * from employee where id=".$_POST['idd'];
$res=$conn->query($sql1);
if($res && $res->num_rows>0){
    $conn->close();
    $_SESSION['ress']="There is a user with same ID";
    header("Location:employeePage.php");
    exit();
}


$passs=password_hash($_POST['passs'],PASSWORD_DEFAULT);
$first= mysqli_escape_string($conn,$_POST['first']);
$email=$_POST['emaill'];
echo $first;
$job=$_POST['job'];
$id=$_POST['idd'];
$date=$_POST['start'];
$depcode=$_POST['depcode'];
$last= mysqli_escape_string($conn,$_POST['last']);
$ja='';
if($job=='Quality Assurance')$ja='QA';
if ($job=="Admin")$ja='Ad';
if($job=="User")$ja='u';
$sql = "INSERT INTO employee (id,firstName, last_name, email,job,pass,startDate,job_abbr,depcode)
VALUES ($id, '$first','$last', '$email','$job','$passs','$date','$ja','$depcode')";
if ($conn->query($sql)) {
    $notifno = 0;
    $sql11 = "select * from notification order by number desc";
    $result11 = $conn->query($sql11);
    if ($result11 && $result11->num_rows > 0) {
        $row1 = $result11->fetch_assoc();
        $notifno = $row1['number'] + 1;
    }

    $title=$first." ".$last;
    $user = $_SESSION['first'] . " " . $_SESSION['last'];
    $today = date('Y-n-j');
    $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user added a/an $job  : $title ', '$today','Employee Added')";
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





    $_SESSION['ress']="The Operation is Done Successfully";

} else {
   $_SESSION['ress']="Error: " . $sql . "<br>" . $conn->error;
}
header("Location:employeePage.php");
$conn->close();
exit();
?>