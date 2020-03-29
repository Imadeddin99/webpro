<?php
session_start();
include "adminNav.php";


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
                        buttonText: '4 day'
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