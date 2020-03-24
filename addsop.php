<?php
session_start();
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

$sql = "SELECT pass FROM employee where id=" . $_SESSION['ID'] ;
$result = $conn->query($sql);

if ($result&&$result->num_rows > 0) {
    // output data of each row
    $row=$result->fetch_assoc();
    if($row['pass']==$_POST['passs']) {

        $sql = "SELECT number, version FROM sop where number='" . $_POST['number']."' and depcode ='".$_POST['depcode']."' order by version desc";
        $res = $conn->query($sql);
        $version='00';
        $state='new';
if($res&&$res->num_rows>0){
    $row=$res->fetch_assoc();
    $sql = "update  sop set state = 'updated' where number='" . $_POST['number']."' and depcode='".$_POST['depcode']."'";
    //here to deal with version number

    $conn->query($sql);
$version=$row['version'];
echo $version;
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



}




            $number = $_POST['number'];
            $rev=$_POST['review'];
            $eff = $_POST['effective'];
            $author=$_SESSION['first']." ".$_SESSION['last'];
            $title=$_POST['title'];
            $depcode=$_POST['depcode'];
            $logn=$_GET['LOG'];



        $target_dir = "SOPs/";

            $target_file = $target_dir . basename($_FILES["sop"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
            $filename="SOP-".$number."-".$version;
            $extension  = pathinfo( $_FILES["sop"]["name"], PATHINFO_EXTENSION );

            $basename2   = $target_dir.$filename . '.' . $extension; // 5dab1961e93a7_1571494241.jpg
            $check = getimagesize($_FILES["sop"]["tmp_name"]);
            $check=filesize($_FILES["sop"]["tmp_name"]);
                $uploadOk = 1;
                move_uploaded_file($_FILES["sop"]["tmp_name"], $basename2);







        $sql1 = "INSERT INTO sop(author,title,effective,review,state,number,version,logno,depcode,path) values('$author','$title','$eff','$rev','$state','$number','$version','$logn','$depcode','$basename2')";

           if ( $conn->query($sql1)===true);
           else die('Could not insert into database:' . mysqli_error($conn));
            $conn->close();
            $_SESSION['formadd'] = "Log Added Successfully";
          // header("Location:sopspage.php?LOG=".$_GET['LOG']);


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