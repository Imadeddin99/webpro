<?php

include 'adminNav.php';
if (empty($_SESSION)||!isset($_SESSION)){
    header("Location:http://localhost/webpro");
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



$sql = "SELECT * FROM employee where id=".$_SESSION['ID'];
$result = $conn->query($sql);

if ($result->num_rows > 0)
    $row=$result->fetch_assoc();


?>





<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <title></title>
    <link rel="stylesheet" href="style6.css" >
</head>
<body>

<form class="box" action="uploadpic.php" method="post"  enctype="multipart/form-data">
    <div id="pic1" style="">  <img id="i1"   width="100%" height="100"  src="<?php echo $row['path'] ?>"  > </div>
    <div class="card">

        <div class="upload-btn-wrapper">
            <button class="btn" type="submit" id="submit" name="submit">Upload your pic</button>
            <input type="file"
                   id="avatar" name="avatar"
                   accept="image/png, image/jpeg" onchange="document.getElementById('submit').click()">
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
                <th>Department :</th>
                <td> <?php echo "".$row['depcode']; ?> </td>
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
        <input type="button"  class="save" name="" value="change password" onclick="window.location.href='newpassword.php'" >
</form>
</body>


<script>

    function uploadfile(){
        window.location.href='uploadpic.php';
    }


</script>


</html>