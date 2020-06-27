<?php
include "adminNav.php";
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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

</head>


<body onload="document.getElementById('example_wrapper').style.marginLeft='10px'">

<?php
if($_SESSION['job']!='user')echo'<a type="button" id="modalshow" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;margin-right: 10px">Add a Log</a>';
?>
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
        <th>Log Title</th>
        <th>Effective Date</th>
        <th>Approved By</th>
        <?php
        if($_SESSION['job']!='user')echo'<th></th>';

        ?>    </tr>
    </thead>
    <tbody>

    <?php

    $sql = "SELECT number ,eff,approved FROM log";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            $num=$row['number'];
            echo "<tr>";
            echo "<td> <a href='form.php?LOG=$num'>LOG-".$row['number']."</a></td>";
            echo "<td>".$row['eff']."</td>";
            echo "<td>".$row['approved']."</td>";
            if($_SESSION['job']!='user')   echo '<td width="5%"><input type="button" value="delete" class="btn btn-secondary btn-sm" 
style="background-color: red;color: white;margin-left: 0px" onclick="deletelog(\''.$row['number'].'\')"></td>';
            echo "</tr>";
        }
    }






    ?>







    </tbody>
    <tfoot>
    <tr>
        <th>Log Title</th>
        <th>Effective Date</th>
        <th>Approved By</th>
        <?php
        if($_SESSION['job']!='user')echo'<th></th>';

        ?>
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
                <h3 class="modal-title" id="exampleModalLabel">Add/Edit A LOG !</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="addlog.php" method="post">
                    <input class="form-control form-control-lg" id="first" type="text" name="number" placeholder="Log Number" style="margin-bottom: 10px" required pattern="[a-zA-Z0-9]{3}" title="You should Enter Valid Log Number">

                    <input type="password" name="passs" class="form-control" id="pass" placeholder="Password" required style="margin-bottom: 10px">

                    <input class="form-control form-control-lg" id="datepicker" type="text" name="eff" placeholder="Effective Date" style="margin-bottom: 10px" required onfocus="this.type='date'" onblur="this.type='text'">

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

    function deletelog(number) {
        var page=window.location.href;
        $.ajax({
            type: 'POST',
            url: 'deletelog.php',
            data: { type: "delete",log:number },
            success: function(response) {
                //console.log(response)
                window.location.href=page;
            }

        });
    }



</script>







</body>
</html>