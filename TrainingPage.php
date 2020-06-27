<?php
include 'adminNav.php';
if (empty($_SESSION)||!isset($_SESSION)){
    header("Location:index.php");
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


?>


<html lang="en">

<head>
    <title>Employees Page</title>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!--    <link href="style3.css" rel="stylesheet">-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--    <script src="deleteAjax.js" type="text/javascript"></script>-->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">





    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
</head>


<body onload="document.getElementById('example_wrapper').style.marginLeft='10px'">






<table id="example" class="table-hover table table-striped " style="width:90% " >
    <thead>
    <tr>
        <th>Title of Document</th>
        <th>Signed By</th>
        <th>Completion Date</th>

    </tr>
    </thead>
    <tbody>

    <?php

$sql="select * from training where id=".$_SESSION['ID'];
$result=$conn->query($sql);
if($result&&$result->num_rows>0){

    while($row=$result->fetch_assoc()){


        echo "<tr>";

        echo "<td>".$row['title']."</td>";
        echo "<td>".$row['signed']."</td>";
        echo "<td>".$row['complete']."</td>";
        echo "</tr>";






    }




}



    ?>







    </tbody>
    <tfoot>
    <tr>
        <th>Title of Document</th>
        <th>Signed By</th>
        <th>Completion Date</th>

    </tr>
    </tfoot>
</table>



<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


</body>
</html>
