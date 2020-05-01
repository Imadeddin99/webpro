


<?php
session_start();
if (empty($_SESSION)||!isset($_SESSION)){
header("Location:index.php");
exit();
}


?>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>new password</title>
    <link rel="stylesheet" href="style4.css" >
    <script src="checkvalidation.js"></script>
</head>
<body style="background-color: #34495e">
<form class="box" action="updatepassword.php" method="post">
    <h1> new password</h1>
    <p style="color: red" id="errormsg"></p>
    <input type="password"  name="pass" placeholder="new password" id="pass1">
    <input type="password" name="pass" placeholder="confirm new Password" onchange="checkvalidate()" onkeyup="checkvalidate()" id="pass2">
    <div class="options">

        &nbsp;
        <a href="#" data-toggle="modal" data-target="#myModal"  >Resend A New Email</a>

    </div>
    <input type="submit" name="" value="confirm" >
</form>



</body>
</html>