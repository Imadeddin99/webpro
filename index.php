<?php

session_start();

/*  $servername = "localhost";
  $username='root';
  $pass='';
  $dbname='projectdb';
  $conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }*/

if(isset($_POST['reg'])){
    $reg = $_POST['reg'];
    $_SESSION["ID"]=$reg;
}
else{
    $_SESSION["ID"]="0000";

}


?>



<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title> المراكز العلمية-جامعة النجاح الوطنية</title>
    <link rel="stylesheet" href="style.css" >
</head>
<body>

<form class="box" action="check.php" method="post" >
    <img src="eng%202.png">
<?php

if(isset($_SESSION['response']) && !empty($_SESSION['response'])) {
    echo "<p style='color: red'>".$_SESSION['response']."</p>";
    $_SESSION['response']="";
}



?>

    <input type="text"  pattern="[0-9]{4}" title="must contain at most 4 digit only" name="reg" placeholder="Registration number" id="reg">
    <input type="password" name="password" placeholder="Password" required title="please fill the password field">
    <div class="options">
        <label class="remember-me">
              <span class="checkbox">
                <input type="checkbox">
                <span class="checked"></span>
              </span>
            Remember me
        </label>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <a href="#blackout" data-toggle="box" data-target="#blackout"  >Forgot Your Password !</a>

    </div>
    <input type="submit" name="submit" value="Login" >
</form >


<!--<form action="check.php" method="post"  enctype="text/plain"   class="box">-->
<!--    <input type="text" name="potato">-->
<!--    <input type="submit">-->
<!--</form>-->

<!--  the next form is for Forget Password-->
<div id="blackout">
    <div id="box">
        Forget your Password!
        <form class="a" action="forget.php" method="post">
            <div>
              <?php  if(isset($_SESSION['forget-res']) && !empty($_SESSION['forget-res'])) {
                echo "<p style='color: red'>".$_SESSION['forget-res']."</p>";
                $_SESSION['forget-res']="";
                }

                ?>
                <input type="text" size=4 id="Regestration" name="rege" required pattern="[0-9]{4}" placeholder="Regestration number">
            </div>
            <div>

                <input type="text" size=20 id="email" name="em" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" placeholder="Email">
            </div>
            <input type="submit"  class="save" name="" value="verify" >

        </form>

        <!--          input out of form edit it later-->

        <a href="#" class="close">Close window</a>
    </div>
</div>

</body>
