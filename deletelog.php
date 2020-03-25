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


    $sql = "select number,depcode from sop where logno='" . $_POST['log'] . "'";


    $result=$conn->query($sql);

    while ($result&&$result2=$result->fetch_assoc()){


        $sql1="delete from relatedlog where sop='".$result2['number']."' and realdept='".$result2['depcode']."'";
        if($conn->query($sql1)!==true)die("deleting failed Failed".$conn->error);


        $sql1="delete from relateddept where sop='".$result2['number']."' and realdept='".$result2['depcode']."'";
        if($conn->query($sql1)!==true)die("deleting failed Failed".$conn->error);

        $sql1="delete from relatedform where sop='".$result2['number']."' and realdept='".$result2['depcode']."'";
        if($conn->query($sql1)!==true)die("deleting failed Failed".$conn->error);




    }


    $sql="delete from sop where logno='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);


    $sql="delete from relatedlog where log='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);

    $sql="delete from log where number='".$_POST['log']."'";
    if($conn->query($sql)!==true)die("deleting failed Failed".$conn->error);









}



?>






