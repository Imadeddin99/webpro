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



$sql = "SELECT * FROM employee where id=".$_SESSION['ID'];
$result = $conn->query($sql);

if ($result->num_rows > 0)
$row=$result->fetch_assoc();


?>





<html lang="en">
<head>
<meta charset="UTF-8">
    <title></title>
     <link rel="stylesheet" href="style6.css" >
     </head>
<body>

<form class="box" action="index.html" method="post">
    <div id="pic1">

    </div>
    <div class="card">
   <!-- <img id="i1" src="eng%202.png" >-->
    <div class="upload-btn-wrapper">
            <button class="btn">Upload your pic</button>
        <input type="file"
               id="avatar" name="avatar"
               accept="image/png, image/jpeg" onchange="uploadfile()">
    </div>

    <table>
        <tr>
            <th>Name :</th>
            <td><?php echo "".$row['firstName']." ".$row['last_name']; ?></td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;ID :</th>
            <td><?php echo "".$row['id']; ?></td>
        </tr>
        <tr>
            <th>Email :</th>
            <td> <?php echo "".$row['email']; ?> </td>
        </tr>
        <tr>
            <th>Jop position :</th>
            <td><?php echo "".$row['job']; ?></td>
        </tr>
        <tr>
            <th>Start Date :</th>
            <td><?php echo "".$row['startDate']; ?></td>
        </tr>

    </table>
        <input type="button"  class="save" name="" value="change password" onclick="window.location.href='newpassword.html'" >
</form>
</body>


<script>

  function uploadfile(){
      window.location.href='uploadpic.php';
  }


</script>


</html>