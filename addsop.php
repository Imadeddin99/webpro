<?php
session_start();
if (empty($_SESSION)||!isset($_SESSION)){
    header("Location:index.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectdb";
$notifflag=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT pass FROM employee where id=" . $_SESSION['ID'] ;
$result = $conn->query($sql);

if ($result&&$result->num_rows > 0) {
    // output data of each row
    $row=$result->fetch_assoc();
    if(password_verify($_POST['passs'],$row["pass"])) {

        $sql = "SELECT number, version FROM sop where number='" . $_POST['number']."' and depcode ='".$_POST['depcode']."' and logno='".$_GET['LOG']."' order by version desc";
        $res = $conn->query($sql);
        $version='00';
        $state='new';
        $number = $_POST['number'];
        $depcode=$_POST['depcode'];
        $logno=$_GET['LOG'];
        if($res&&$res->num_rows>0){





    $row=$res->fetch_assoc();
    $sql = "update  sop set state = 'updated' where number='" . $_POST['number']."' and depcode='".$_POST['depcode']."' and logno='".$_GET['LOG']."'";
    //here to deal with version number

    $conn->query($sql);




            $version=$row['version'];

    switch ($version[1]){
        case '0':$version[1]='1';break;
        case '1':$version[1]='2';break;
        case '2':$version[1]='3';break;
        case '3':$version[1]='4';break;
        case '4':$version[1]='5';break;
        case '5':$version[1]='6';break;
        case '6':$version[1]='7';break;
        case '7':$version[1]='8';break;
        case '8':$version[1]='9';break;
        case '9':$version[1]='A';break;
        case 'A':$version[1]='B';break;
        case 'B':$version[1]='C';break;
        case 'C':$version[1]='D';break;
        case 'D':$version[1]='E';break;
        case 'E':$version[1]='F';break;
        case 'F':$version[1]='0';break;
    }

    if($version[1]=='0' and $version[0]!='0'){
        switch ($version[0]){
            case '0':$version[0]='1';break;
            case '1':$version[0]='2';break;
            case '2':$version[0]='3';break;
            case '3':$version[0]='4';break;
            case '4':$version[0]='5';break;
            case '5':$version[0]='6';break;
            case '6':$version[0]='7';break;
            case '7':$version[0]='8';break;
            case '8':$version[0]='9';break;
            case '9':$version[0]='A';break;
            case 'A':$version[0]='B';break;
            case 'B':$version[0]='C';break;
            case 'C':$version[0]='D';break;
            case 'D':$version[0]='E';break;
            case 'E':$version[0]='F';break;
            case 'F':$version[0]='0';break;
        }

    }
    $notifflag=1;
            $notifno = 0;
            $sql11 = "select * from notification order by number desc";
            $result11 = $conn->query($sql11);
            if ($result11 && $result11->num_rows > 0) {
                $row1 = $result11->fetch_assoc();
                $notifno = $row1['number'] + 1;
            }


            $user = $_SESSION['first'] . " " . $_SESSION['last'];
            $name = $depcode ."-". $number . "-" . $version;
            $today = date('Y-n-j');
            $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user Updated a SOP :$name  ', '$today','SOP Updated')";
            $conn->query($sql22);
            $sql22="select * from employee where job='Admin'";
            $result11=$conn->query($sql22);
            if ($result11&&$result11->num_rows>0){
                while ($row1=$result11->fetch_assoc()){
                    $idddd=$row1['id'];
                    $sql111="insert into seen(number ,id,state) values($notifno,$idddd,'notseen')";
                    $conn->query($sql111);
                }
            }





            $sql2="delete from relatedlog where sop='".$number."' and reallog='".$_GET['LOG']."'";
    $conn->query($sql2);

            $sql2="delete from relatedform where sop='".$number."' and log='".$_GET['LOG']."'";
            $conn->query($sql2);

            $sql2="delete from relateddept where sop='".$number."' and log='".$_GET['LOG']."'";
            $conn->query($sql2);

}

        foreach ($_POST['relatedlogs'] as $icon){

        $sql2="insert into relatedlog(sop,log,realdept,reallog) values('$number','$icon','$depcode','$logno')";
        $conn->query($sql2);

        }


        foreach ($_POST['relatedforms'] as $icon){

            $sql2="insert into relatedform(sop,form,realdept,log) values('$number','$icon','$depcode','$logno')";
            $conn->query($sql2);

        }

        foreach ($_POST['relateddepts'] as $icon){

            $sql2="insert into relateddept(sop,dept,realdept,log) values('$number','$icon','$depcode','$logno')";
            $conn->query($sql2);

        }




            $rev=$_POST['review'];
            $eff = $_POST['effective'];
            $author=$_SESSION['first']." ".$_SESSION['last'];
            $author=mysqli_escape_string($conn,$author);
            $title=$_POST['title'];
             $logn=$_GET['LOG'];



        $target_dir = "SOPs/";

            $target_file = $target_dir . basename($_FILES["sop"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
            $filename=$depcode."-".$number."-".$version;
            $extension  = pathinfo( $_FILES["sop"]["name"], PATHINFO_EXTENSION );

            $basename2   = $target_dir.$filename . '.' . $extension; // 5dab1961e93a7_1571494241.jpg
            $check = getimagesize($_FILES["sop"]["tmp_name"]);
            $check=filesize($_FILES["sop"]["tmp_name"]);
                $uploadOk = 1;
                move_uploaded_file($_FILES["sop"]["tmp_name"], $basename2);







        $sql1 = "INSERT INTO sop(author,title,effective,review,state,number,version,logno,depcode,path) values('$author','$title','$eff','$rev','$state','$number','$version','$logn','$depcode','$basename2')";

           if ( $conn->query($sql1)===true){
               if ($notifflag===0) {
                   $notifno = 0;
                   $sql11 = "select * from notification order by number desc";
                   $result11 = $conn->query($sql11);
                   if ($result11 && $result11->num_rows > 0) {
                       $row1 = $result11->fetch_assoc();
                       $notifno = $row1['number'] + 1;
                   }


                   $user = $_SESSION['first'] . " " . $_SESSION['last'];
                   $name = $depcode ."-". $number . "-" . $version;
                   $today = date('Y-n-j');

                   $sql22 = "Insert into notification (number,notif,notifdate,header) values($notifno,'$user added a SOP : $name ', '$today','SOP Added')";
                   echo $sql22;
                   if (!$conn->query($sql22))die($conn->error);

                   $sql22="select * from employee where job='Admin'";
                   $result11=$conn->query($sql22);
                   if ($result11&&$result11->num_rows>0){
                       while ($row1=$result11->fetch_assoc()){
                           $idddd=$row1['id'];
                           $sql111="insert into seen(number ,id,state) values($notifno,$idddd,'notseen')";
                           $conn->query($sql111);
                       }
                   }




               }


           }
           else die('Could not insert into database:' . mysqli_error($conn));
            $conn->close();
            $_SESSION['formadd'] = "SOP Added Successfully";
           header("Location:sopspage.php?LOG=".$_GET['LOG']);


    }
    else{
        $_SESSION['formadd'] = "pass isn't correct";
        header("Location:sopspage.php?LOG=".$_GET['LOG']);

    }


} else {
    $_SESSION['formadd']="Something wrong happened";
    header("Location:sopspage.php?LOG=".$_GET['LOG']);
}






?>