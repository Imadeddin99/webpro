<?php
include 'adminNav.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectdb";
$notifflag=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}








?>
<html>
<head>

    <title>Notifications</title>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <style>
        *{
            margin: 0px;
            padding: 0px;



        }

        .content {
            width: 70% ;
            margin: 20px auto;
            margin-top: 80px;


            box-shadow: 1px 1px 10px 2px #333;
            border-radius: 5px;



        }
        .header {
            background: #34495e;
            color: white;
            padding: 15px 0px;

        }
        .moving-body {
            padding: 4px;
            height: 60%;
            overflow: auto;

        }


        .a{

            background: #5aabd0;
            padding: 5px 20px;
            margin-left: 20px;
            margin-bottom: 10px;
            width: 96%;
            cursor: pointer;

        }

        .card-header {
            margin-bottom: 7px;
        }
.card-body{
margin-left: 7px;
    font-size: 17px;

}
    </style>
</head>
<body>








<div class="content"> <h1 class="header" align="center" > Notifications  </h1>
    <div class="moving-body" >
        <?php

        $sql="select * from seen where id=".$_SESSION['ID']." and state='notseen'";
        $res=$conn->query($sql);
        if ($res&&$res->num_rows>0){
            while($row=$res->fetch_assoc()){

                $sql2="select * from notification where number=".$row['number'];
                $res2=$conn->query($sql2);
                while ($row2=$res2->fetch_assoc()) {
                    $header = $row2['header'];
                    $body = $row2['notif'];
                    if(stripos($header,"added")!==false){
                        echo ' <div class="a" style="background-color: #7C929B">
            <div class="card-header"><h2>'.$header.' &nbsp;<span class="Badge">New</span></h2></div>
            <div class="card-body">

                <p class="card-text">'.$body.'</p>
            </div>
        </div>';
                    }
                   else if(stripos($header,"updated")!==false){
                        echo ' <div class="a" style="background-color: #B6D1D6">
            <div class="card-header"><h2>'.$header.' &nbsp;<span class="Badge">New</span></h2></div>
            <div class="card-body">

                <p class="card-text">'.$body.'</p>
            </div>
        </div>';
                    }
                   else if(stripos($header,"deleted")!==false){
                        echo ' <div class="a" style="background-color: #D3DCDF">
            <div class="card-header"><h2>'.$header.' &nbsp;<span class="Badge">New</span></h2></div>
            <div class="card-body">

                <p class="card-text">'.$body.'</p>
            </div>
        </div>';
                    }

                }
            }
        }


        $sql="select * from seen where id=".$_SESSION['ID']." and state='seen' order by number desc";
        $res=$conn->query($sql);
        if ($res&&$res->num_rows>0){
            while($row=$res->fetch_assoc()){

                $sql2="select * from notification where number=".$row['number'];
                $res2=$conn->query($sql2);
                while ($row2=$res2->fetch_assoc()) {
                    $header = $row2['header'];
                    $body = $row2['notif'];
                    if(stripos($header,"added")!==false){
                        echo ' <div class="a" style="background-color: #7C929B">
            <div class="card-header"><h2>'.$header.' &nbsp;</h2></div>
            <div class="card-body">

                <p class="card-text">'.$body.'</p>
            </div>
        </div>';
                    }
                    else if(stripos($header,"updated")!==false){
                        echo ' <div class="a" style="background-color: #B6D1D6">
            <div class="card-header"><h2>'.$header.' &nbsp;</h2></div>
            <div class="card-body">

                <p class="card-text">'.$body.'</p>
            </div>
        </div>';
                    }
                    else if(stripos($header,"deleted")!==false){
                        echo ' <div class="a" style="background-color: #D3DCDF ">
            <div class="card-header"><h2>'.$header.' &nbsp;</h2></div>
            <div class="card-body">

                <p class="card-text">'.$body.'</p>
            </div>
        </div>';
                    }

                }
            }
        }

        $sql="update seen set state='seen' where id=".$_SESSION['ID'];
        $conn->query($sql);


        ?>
    </div>
</div>



</body>
</html>


