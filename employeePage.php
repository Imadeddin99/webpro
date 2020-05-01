<?php
include 'adminNav.php';
if(!isset($_SESSION['job']) || empty($_SESSION['job'])||$_SESSION['job']!='Admin') {
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

<!--    <script src="deleteAjax.js" type="text/javascript"></script>-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

</head>





<body onload="document.getElementById('example_wrapper').style.marginLeft='10px'">



<?php
if($_SESSION['job']!='user')echo'<a type="button" id="modalshow" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;margin-right: 10px">Add an Employee</a>';
?>

<p>
<?php    if(isset($_SESSION['ress']) && !empty($_SESSION['ress'])) {
    echo "<p style='color: red'>".$_SESSION['ress']."</p>";
$_SESSION['ress']="";
}
?>
</p>
<table id="example" class="table-hover table table-striped " style="width:90%">


    <thead>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Registration Number</th>
        <th>Start date</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>

    <?php

    $sql = "SELECT id, firstName, last_name,pass,job,startDate,email FROM employee";
    $result = $conn->query($sql);

    if ($result&&$result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
    $id=$row['id'];
    $first=$row['firstName'];
    $last=$row['last_name'];
    $email=$row['email'];
    $pass=$row['pass'];
    $start=$row['startDate'];
    $job=$row['job'];


    if ($_SESSION['job']==="Admin") {
        $idd=$row['id'];

        echo "<tr>";
        echo "<td><a href='traning_add.php?id=$idd'>" . $row['firstName'] . " " . $row['last_name'] . "</a></td>";
        echo "<td>" . $row['job'] . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['startDate'] . "</td>";
        echo '<td><input type="button" value="edit" class="btn btn-primary btn-sm" onclick="editAjax(' . '\'' . $id . '\'' . ',' . '\'' . $first . '\''
            . ',' . '\'' . $last . '\'' . ',' . '\'' . $email . '\'' . ',' . '\'' . $pass . '\'' . ',' . '\'' . $start . '\'' . ',' . '\'' . $job . '\'' . ')" ></td>';
        echo '<td><input type="button" value="delete" class="btn btn-secondary btn-sm" style="background-color: red;color: white"
 onclick="deleterow(' . $id . ')"></td>';

        echo "</tr>";


    }


    else{

        echo "<tr>";
        echo "<td>" . $row['firstName'] . " " . $row['last_name'] . "</td>";
        echo "<td>" . $row['job'] . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['startDate'] . "</td>";
        echo '<td><input type="button" value="edit" class="btn btn-primary btn-sm" onclick="editAjax(' . '\'' . $id . '\'' . ',' . '\'' . $first . '\''
            . ',' . '\'' . $last . '\'' . ',' . '\'' . $email . '\'' . ',' . '\'' . $pass . '\'' . ',' . '\'' . $start . '\'' . ',' . '\'' . $job . '\'' . ')" ></td>';
        echo '<td><input type="button" value="delete" class="btn btn-secondary btn-sm" style="background-color: red;color: white"
 onclick="deleterow(' . $id . ')"></td>';

        echo "</tr>";




    }









        }
    }



$conn->close();

    ?>

    </tbody>
    <tfoot>
    <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Registration Number</th>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Add/Edit An Employee !</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="addUser.php" method="post">
                <input class="form-control form-control-lg" id="first" type="text" name="first" placeholder="First Name" style="margin-bottom: 10px" required pattern="[a-zA-Z]{0-30}" title="You should Enter Valid Name">
                <input class="form-control form-control-lg" id="last" name="last" type="text" placeholder="Last Name" style="margin-bottom: 10px" required pattern="[a-zA-Z]{0-30}" title="You should Enter Valid Name">

                <input class="form-control form-control-lg" type="text" id="reg" name="idd" placeholder="Registration Number" style="margin-bottom: 10px" required pattern="[0-9]{4}" title="You should Enter Number of 4 digits only">
                <input type="password" name="passs" class="form-control" id="pass" placeholder="Password" required style="margin-bottom: 10px">
                <input class="form-control form-control-lg" type="text" id="email" name="emaill" placeholder="Email" style="margin-bottom: 10px" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" title="You should Enter a valid Email">
                <select class="form-control" style="margin-bottom: 10px" id="selector" name="job">
                    <option>Admin</option>
                    <option>Quality Assurance</option>
                    <option>User</option>
                </select>
                    <select class="form-control" style="margin-bottom: 10px" id="selector" name="depcode" >
                        <option>CLN</option>
                        <option>QAU</option>
                        <option>VAL</option>
                        <option>REG</option>
                        <option>DMW</option>
                        <option>LAB</option>
                        <option>ITC</option>
                        <option>MDI</option>
                        <option>N/A</option>
                    </select>
                <input class="form-control form-control-lg" id="datepicker" type="text" name="start" placeholder="Starting Date" style="margin-bottom: 10px" required onfocus="this.type='date'" onblur="this.type='text'">



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="edit">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Get the modal
    function deleterow(reg) {
        $.ajax({
            type: 'POST',
            url: 'deleteEdit.php',
            data: { type: "delete",id:reg },
            success: function(response) {
                window.location.href="EmployeePage.php";
            }
        });

    }

    function editAjax(reg,first,last,email,pass,start,job) {
        document.getElementById("modalshow").click();


        console.log(reg);

        document.getElementById("first").value=first;
        document.getElementById("last").value=last;
        document.getElementById("email").value=email;
        document.getElementById("pass").value=pass;
        //document.getElementById("job").value="";
        //  document.getElementById("datepicker").setDate(start);
//    $datepicker.datepicker('setDate', start);

        document.getElementById("datepicker").value=start;
        document.getElementById("reg").value=""+reg;
        document.getElementById("selector").value=job;

        var object=document.getElementById('edit');
        object.onclick = function() {

            $.ajax({
                type: 'POST',
                url: 'deleteEdit.php',
                data: {type: "delete", id: reg},
                success: function (response) {
                    window.location.href="EmployeePage.php";
                }
            });


        };

    }
</script>



</body>
</html>