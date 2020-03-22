<?php
session_start();


$target_dir = "pics/";
echo $_SESSION['ID'];
if(isset($_POST["submit"])) {
    echo "hello";
$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $filename=$_SESSION['ID'];
    $extension  = pathinfo( $_FILES["avatar"]["name"], PATHINFO_EXTENSION );

    $basename2   = $target_dir.$filename . '.' . $extension; // 5dab1961e93a7_1571494241.jpg
    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $basename2)) {

header("Location:userp.php");

        } else {
            echo "Sorry, there was an error uploading your file.";
        }


    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

}

?>