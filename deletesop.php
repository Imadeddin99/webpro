<?php
session_start();
if($_POST['type']=='delete'){


    $sop=$_POST['sop'];
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

    $sql="delete from sop where number='".$_POST['sop']."' and depcode='".$_POST['dep']."' and logno='".$_POST['log']."'";
if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);

    $sql="delete from relatedlog where sop='".$_POST['sop']."' and realdept='".$_POST['dep']."' and reallog='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);


    $sql="delete from relateddept where sop='".$_POST['sop']."' and realdept='".$_POST['dep']."' and log='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);

    $sql="delete from relatedform where sop='".$_POST['sop']."' and realdept='".$_POST['dep']."' and log='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);


}


?>