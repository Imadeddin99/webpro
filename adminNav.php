<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Control Panel</title>
    <script src="https://kit.fontawesome.com/97db899fc1.js" crossorigin="anonymous"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="nav/jquery.responsive-collapse.css" rel="stylesheet">
    <style>
        body { background-color: #fafafa; font-family:'Roboto';}
        h1 { margin:70px auto; text-align:center;}
    </style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" style="background-color: #34495e;position: initial">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
        </div>
        <img src="eng%202.png" style="width: 20%" >

        <div class="navbar-collapse collapse navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="mainPage.php"> Main Page</a></li>
                <li><a href="employeePage.php">Employee page</a></li>

                <li><a href="#">Files Page</a></li>
                <li><a href="#">Calender Page</a></li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> User <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="userp.php">Profile</a></li>
                        <li class="divider"></li>
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
<!--<script type="text/javascript">-->
<!---->
<!--    var _gaq = _gaq || [];-->
<!--    _gaq.push(['_setAccount', 'UA-36251023-1']);-->
<!--    _gaq.push(['_setDomainName', 'jqueryscript.net']);-->
<!--    _gaq.push(['_trackPageview']);-->
<!---->
<!--    (function() {-->
<!--        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;-->
<!--        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';-->
<!--        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);-->
<!--    })();-->
<!---->
<!--</script>-->
<?php

if (isset($_POST['logout'])){
   session_destroy();

}

?>





</body>
</html>