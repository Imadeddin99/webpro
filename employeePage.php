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

?>


<html lang="en">

<head>
<title>Employees Page</title>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link href="style3.css" rel="stylesheet">

    <script src="deleteAjax.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <style>
        /* The Modal (background) */
        input{
            display: block;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>





<body>
<a href="#modalRegisterForm"  class="btn btn-primary btn-sm" style="float: right;margin-right: 10px" role="button" id="add">Add an Employee</a>
<p>
<?php    if(isset($_SESSION['ress']) && !empty($_SESSION['ress'])) {
    echo "<p style='color: red'>".$_SESSION['ress']."</p>";
$_SESSION['ress']="";
}
?>

</p>
<table id="example" class="table-hover table table-striped " style="width:100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Registration Number</th>
        <th>Password</th>
        <th>Start date</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php

    $sql = "SELECT id, firstName, last_name,pass,job,startDate,email FROM employee";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
    $id=$row['id'];
    $first=$row['firstName'];
    $last=$row['last_name'];
    $email=$row['email'];
    $pass=$row['pass'];
    $start=$row['startDate'];
    $job=$row['job'];
            echo "<tr>";
            echo "<td>".$row['firstName']." ".$row['last_name']."</td>";
            echo "<td>".$row['job']."</td>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['pass']."</td>";
            echo "<td>".$row['startDate']."</td>";
            echo '<td><input type="button" value="edit" class="btn btn-primary btn-sm" onclick="editAjax('.'\''.$id.'\''.','.'\''.$first.'\''
                .','.'\''.$last.'\''.','.'\''.$email.'\''.','.'\''.$pass.'\''.','.'\''.$start.'\''.','.'\''.$job.'\''.')" ></td>';
            echo '<td><input type="button" value="delete" class="btn btn-secondary btn-sm" style="background-color: red;color: white"
 onclick="deleterow('.$id.')"></td>';


        }
    }





    ?>

    </tbody>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Registration Number</th>
        <th>Password</th>
        <th>Start date</th>
        <th></th>
        <th></th>
    </tr>
    </tfoot>
</table>



<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

<div id="myModal" class="modal" style="position: absolute;z-index: 4"  >

    <!-- Modal content -->
    <div class="modal-content" >
        <span class="close">&times;</span>
        <br>
        <div style="position: relative;top: 50%;left: 35%; height: 50%">
        <h1>Add an Employee !</h1>
        <form method="post" action="addUser.php">
         <input type="text" size="50" placeholder="First Name" id="first" required name="first">
            <input type="text" size="50" placeholder="Last Name" id="last" required name="last">
            <input type="text" size="50" placeholder="Regestration Number" id="reg" required name="idd">
            <input type="password" size="50" required id="pass" placeholder="Password" name="passs">
            <input type="email" size="50" required id="email" placeholder="Email" name="emaill">
            <select  id="selector" required name="job">
               <option>Admin</option>
               <option>Quality Assurance </option>
               <option>User</option>
           </select>
            <input type="date" id="datepicker" lang="en" placeholder="Starting Date" required name="start">
            <input type="submit" value="Submit" id="submit">
    </form>
        </div>


    </div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");
    // Get the button that opens the modal
    var btn = document.getElementById("add");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }














</script>



</body>
</html>