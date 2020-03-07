<?php




session_start();
include 'adminNav.php';

$servername = "localhost";
$username='root';
$pass='';
$dbname='projectdb';
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);}

$passs=$_POST['passs'];
$first=$_POST['first'];
$email=$_POST['emaill'];
$job=$_POST['job'];
$id=$_POST['idd'];
$date=$_POST['start'];
$last=$_POST['last'];
$ja='';
if($job=='Quality Assurance')$ja='QA';
if ($job=="Admin")$ja='Ad';
if($job=="user")$ja='u';

$sql = "INSERT INTO employee (id,firstName, last_name, email,job,pass,startDate,job_abbr)
VALUES ($id, '$first','$last', '$email','$job','$passs','$date','$ja')";


if ($conn->query($sql) === TRUE) {
$_SESSION['ress']="Added";
    header("Location:employeePage.php");
    $conn->close();

    exit();

} else {
    $_SESSION['ress']="Error: " . $sql . "<br>" . $conn->error;
    header("Location:employeePage.php");
    $conn->close();

    exit();
}

?>



