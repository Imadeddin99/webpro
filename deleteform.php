<?php
session_start();
if ($_POST['type']=='delete') {
    $servername = "localhost";
    $username = 'root';
    $pass = '';
    $dbname = 'projectdb';
    $conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


$sql="delete from form where logno='".$_POST['LOG']."'and form='".$_POST['form']."'";
    if($conn->query($sql))echo "true";
    else {
        die($conn->error);
    }

    $sql="delete from formrelateddept where log='".$_POST['LOG']."'and form='".$_POST['form']."'";
    if($conn->query($sql))echo "true";
    else {
        die($conn->error);
    }

}
    ?>