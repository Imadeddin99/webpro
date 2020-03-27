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
<a type="button" id="modalshow" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right;margin-right: 10px">Add a Form</a>
<p>
    <?php    if(isset($_SESSION['formadd']) && !empty($_SESSION['formadd'])) {
        echo "<p style='color: red'>".$_SESSION['formadd']."</p>";
        $_SESSION['formadd']="";
    }
    ?>

</p>
<table id="example" class="table-hover table table-striped " style="width:90%">
    <thead>
    <tr>
        <th>Title of Document</th>
        <th>Document Code</th>
        <th>Effective Date</th>
        <th>Review Due Date</th>
        <th>Distributed to (Departments)</th>
        <th>Author</th>
        <th></th>

    </tr>
    </thead>
    <tbody>

    <?php

    $sql = "SELECT * FROM form where logno="."'".$_GET['LOG']."' and state='new'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if( $row['logno']==$_GET['LOG']) {


                $sql1="select dept from formrelateddept where form='".$row['form']."' and log='".$_GET['LOG']."'";
                $result1=$conn->query($sql1);
                $dept="";
                while($result1&&$r=$result1->fetch_assoc()){
                    $dept=$dept.$r['dept']." , ";
                }

$dept=substr($dept,0,strlen($dept)-2);
                $logno=$_GET['LOG'];
                $path=$row['path'];
                echo "<tr>";
                echo "<td><a href='$path' target='_blank'>" . $row['title'] . "</a></td>";
                echo "<td> FORM-" . $row['form'] . "-" . $row['version'] . "</td>";
                echo "<td>" . $row['effective'] . "</td>";
                echo "<td>" . $row['review'] . "</td>";
                echo "<td>".$dept."</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo '<td ><input type="button" value="delete" class="btn btn-secondary btn-sm" 
style="background-color: red;color: white;margin-left: 0px" onclick="deletesop(\''.$row['form'].'\',\''.$logno.'\')"></td>';
                echo "</tr>";
            }
        }
    }






    ?>







    </tbody>
    <tfoot>
    <tr>
        <th>Title of Document</th>
        <th>Document Code</th>
        <th>Effective Date</th>
        <th>Review Due Date</th>
        <th>Distributed to (Departments)</th>
        <th>Author</th>
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
                <h3 class="modal-title" id="exampleModalLabel">Add/Edit A Form !</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="addform.php?LOG=<?php echo $_GET['LOG']; ?>" method="post" enctype="multipart/form-data">
                    <input class="form-control form-control-lg" id="first" type="text" name="title" placeholder="Title" style="margin-bottom: 10px" required >
                    <input class="form-control form-control-lg" id="first" type="text" name="number" placeholder="Form Number" style="margin-bottom: 10px" required pattern="[0-9]{3}" title="You should Enter Valid SOP Number">
                    <input type="password" name="passs" class="form-control" id="pass" placeholder="Password" required style="margin-bottom: 10px">
                    <input class="form-control form-control-lg" id="datepicker" type="text" name="effective" placeholder="Effective Date" style="margin-bottom: 10px" required onfocus="this.type='date'" onblur="this.type='text'">
                    <input class="form-control form-control-lg" id="datepicker2" type="text" name="review" placeholder="Review Date" style="margin-bottom: 10px" required onfocus="this.type='date'" onblur="this.type='text'">
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" accept="application/pdf" name="sop">
                    <div style="margin-bottom: 10px;margin-top: 15px">
                        <select multiple="multiple" class="" id="depts" style="width: 100%;" name="relateddepts[]">
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
                    </div>

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

    function deletesop(id,logno) {
        var page=window.location.href;
        $.ajax({
            type: 'POST',
            url: 'deleteform.php',
            data: { type: "delete",form:id,LOG:logno },
            success: function(response) {
                window.location.href=page;
            }

        });
    }


</script>
<script>
    $(function() {
        $('#depts').multipleSelect({
            filter: true,
            placeholder:"Select the Related Departments",
            animate:'slide',
        })
    })
</script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>

</body>
</html>
