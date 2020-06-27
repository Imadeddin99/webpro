<?php
session_start();
?>

<html>
<head>
    <title>Admin NavBar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="nav/jquery.responsive-collapse.css" rel="stylesheet">
    <style>
        body { background-color:#fafafa; font-family:'Roboto';}
        h1 { margin:70px auto; text-align:center;}
    </style>
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top" style="background-color: #34495e;position: initial">
    <div style="margin-bottom: -3%;"> <img src="eng%202.png" style="width: 18% ; margin-left:2%; " ></div>
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

        </div>
        <div class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="TrainingPage.php"> Training Page</a></li>
                <li><a href="filePage.php"> Files Page</a></li>

                <li><a href="formsPage.php"> Forms Page </a></li>

                <?php
                if($_SESSION['job']=='Admin')echo '<li><a href="employeePage.php"> Employees Page</a></li>';
                ?>
                <li><a href="calenderPage.php"> Calender Page</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> User <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="userp.php">Profile</a></li>
                        <li class="divider"></li>
                        <?php
                        if($_SESSION['job']=='Admin')echo '<li><a href="notifications.php">Notifications</a></li>
                        <li class="divider"></li>';

                        ?>
                        <li><a href="index.php" name="logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="nav/jquery.responsive-collapse.js"></script>

<script type="text/javascript">
    $(window).load(function() {
        $('ul.navbar-nav').responsiveCollapse();
    });
</script>


</body>
</html>
<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">






































