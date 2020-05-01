<?php
include "adminNav.php";
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
$events='';
$author=$_SESSION['first']." ".$_SESSION['last'];
$author=mysqli_escape_string($conn,$author);
$sql="select * from sop where author='".$author."' and state='new'";
$res=$conn->query($sql);
if($res&&$res->num_rows>0){
    while($row=$res->fetch_assoc()){

        $title=$row['depcode']."-".$row['number']."-".$row['version']." Review Event";
        $review=$row['review'];

      $events=$events. "{title: '$title', start: '$review',  end: '$review' },";

    }
}

$sql="select * from sop where depcode='".$_SESSION['depcode']."' and state='new'";
$res=$conn->query($sql);
if($res&&$res->num_rows>0){
    while($row=$res->fetch_assoc()){

        $title=$row['depcode']."-".$row['number']."-".$row['version']." Review Event";
        $review=$row['review'];

        $events=$events. "{title: '$title', start: '$review',  end: '$review' },";

    }
}







$sql="select * from form where author='".$author."' and state='new'";
$res=$conn->query($sql);
if($res&&$res->num_rows>0){
    while($row=$res->fetch_assoc()){
        $sql2="select * from formrelateddept where form='".$row['form']."' and dep='".$_SESSION['depcode']."'";
        $res2=$conn->query($sql2);
if($_SESSION['job']=='Admin'||$_SESSION['job']=="QA"||$res2->num_rows>0){
        $title="Form-".$row['form']."-".$row['version']." Review Event";
        $review=$row['review'];

        $events=$events. "{title: '$title', start: '$review',  end: '$review' },";
}
    }




}


$events=substr($events,0,strlen($events)-1);

?>


<html lang='en'>
<head>
    <meta charset='utf-8' />
    <link href='./packages/core/main.css' rel='stylesheet' />
    <link href='./packages/daygrid/main.css' rel='stylesheet' />
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
<!--    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />-->
    <link href="./packages/timegrid/main.css">
    <link href="./packages/bootstrap/main.css">
    <link href="./packages/list/main.css">

    <script src='./packages/core/main.js'></script>
    <script>
        function extend() {


        }

    </script>
<script src="daygrid.js"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var h=window.innerHeight*0.9;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: [
                  <?php echo $events ?>
                ],
                    plugins: ['bootstrap', 'dayGrid', 'timeGrid', 'list','interaction' ], // an array of strings!
                themeSystem: 'bootstrap',
                header: {
                    center: 'dayGridMonth,timeGridFourDay' // buttons for switching between views
                },
                height:h,
                views: {
                    timeGridFourDay: {
                        type: 'timeGrid',
                        duration: { days: 3 },
                        buttonText: 'for day'
                    }
                },
            });

            calendar.render();
        });

    </script>
</head>
<body onload="extend()">

<div id='calendar' style="width: 90%;left: 5%;position: relative;height: 100%"></div>
<script src="./packages/bootstrap/main.js"></script>
<script src='./packages/daygrid/main.js'></script>
<script src="./packages/timegrid/main.js"></script>
<script src="./packages/list/main.js"></script>
<script src="./packages/interaction/main.js"></script>


</body>
</html>