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
    <!--    <link href="style3.css" rel="stylesheet">-->

    <!--    <script src="deleteAjax.js" type="text/javascript"></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

</head>


<body onload="document.getElementById('example_wrapper').style.marginLeft='10px'">
<a type="button" id="modalshow" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;margin-right: 10px">Add a Log</a>
<p>
    <?php    if(isset($_SESSION['logadd']) && !empty($_SESSION['logadd'])) {
        echo "<p style='color: red'>".$_SESSION['logadd']."</p>";
        $_SESSION['logadd']="";
    }
    ?>

</p>
<table id="example" class="table-hover table table-striped " style="width:90%">
    <thead>
    <tr>
        <th>Title of SOP</th>
        <th>SOP code</th>
        <th>Effective Date</th>
        <th>Review Due Date</th>
        <th>Related Forms</th>
        <th>Related LOGs</th>
        <th>Distributed to (Departments)</th>
        <th>Author</th>
        <th></th>
        <th></th>

    </tr>
    </thead>
    <tbody>

    <?php

    $sql = "SELECT * FROM sop";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
           if( $row['logno']==$_GET['LOG']) {
               echo "<tr>";
               echo "<td>" . $row['title'] . "</td>";
               echo "<td>" . $row['depcode'] . "-" . $row['number'] . "-" . $row['version'] . "</td>";
               echo "<td>" . $row['effective'] . "</td>";
               echo "<td>" . $row['review'] . "</td>";
               echo "<td></td>";
               echo "<td></td>";
               echo "<td></td>";
               echo "<td>" . $row['author'] . "</td>";
               echo '<td><input type="button" value="edit" class="btn btn-primary btn-sm" ></td>';
               echo '<td><input type="button" value="delete" class="btn btn-secondary btn-sm" style="background-color: red;color: white"></td>';
               echo "</tr>";
           }
        }
    }






    ?>







    </tbody>
    <tfoot>
    <tr>
        <th>Title of SOP</th>
        <th>SOP code</th>
        <th>Effective Date</th>
        <th>Review Due Date</th>
        <th>Related Forms</th>
        <th>Related LOGs</th>
        <th>Distributed to (Departments)</th>
        <th>Author</th>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Add/Edit A SOP !</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="addlog.php" method="post">
                    <input class="form-control form-control-lg" id="first" type="text" name="title" placeholder="Title" style="margin-bottom: 10px" required pattern="[a-zA-Z0-9]{3}" title="You should Enter Valid Log Number">
                    <select class="form-control" style="margin-bottom: 10px" id="selector" name="dept">
                        <option>IT</option>
                        <option>QA</option>
                        <option>CLN </option>
                    </select>
                    <input type="password" name="passs" class="form-control" id="pass" placeholder="Password" required style="margin-bottom: 10px">

                    <input class="form-control form-control-lg" id="datepicker" type="text" name="eff" placeholder="Effective Date" style="margin-bottom: 10px" required onfocus="this.type='date'" onblur="this.type='text'">
                    <input class="form-control form-control-lg" id="datepicker2" type="text" name="rev" placeholder="Review Date" style="margin-bottom: 10px" required onfocus="this.type='date'" onblur="this.type='text'">
<?php
                 echo  ' <select class="form-control" style="margin-bottom: 10px" id="selector" name="dept" onchange="logsrelated()">';
                 echo "<option>Number of Logs related</option>";
                 for($i=0;$i<10;$i++) echo "<option>".$i."</option>";
                 echo '</select>';

?>
                    <?php
                    echo  ' <select class="form-control" style="margin-bottom: 10px" id="selector" name="dept" onchange="formsrelated()">';
                    echo "<option>Number of Forms related</option>";
                    for($i=0;$i<10;$i++) echo "<option>".$i."</option>";
                    echo '</select>';

                    ?>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>


   function relatedlogs(){

    }




</script>





</body>
</html>