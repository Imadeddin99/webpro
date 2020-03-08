<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);







$servername = "localhost";
$username = 'root';
$pass = '';
$dbname = 'projectdb';
$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, firstName, job_abbr,pass,email FROM employee where id=". $_POST["rege"];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (($_POST['em'] == $row['email'])) {

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.googlemail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'nnus2020@gmail.com';                     // SMTP username
            $mail->Password = 'nnus123456789';                               // SMTP password
            $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Recipients
            $mail->setFrom('nnus2020@gmail.com', 'Adminstration');
            $mail->addAddress($_POST["em"]);               // Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            //$mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Change Password';
            $mail->Body = '<p>Dear '.$row['firstName'].',</p><p> This email was sent to you to change the password on Scientific Centers Website , if it was you please follow
            the next link , if not just ignore this email. </p>
            <a href="http://localhost/webpro/newpassword.html">Change Password</a>   
            <p>Thanks and regards. </p>
            <p>Admin.</p>';
            $mail->AltBody=',,,';
            $mail->send();
            $conn->close();
            $_SESSION['id']=$row['id'];
            $_SESSION['name']=$row['firstName'];
            $_SESSION['forget-res']="email had been sent";
            header("Location:index.php#blackout");
            exit();
        } catch (Exception $e) {
            $_SESSION['forget-res']="Massage Couldn't be sent please try again later";
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location:index.php#blackout");
            $conn->close();

            exit();
        }
    }
    else {
        $conn->close();

        $_SESSION['forget-res']="The email is not correct";

        header("Location:index.php#blackout"); exit();

    }
    // header("Location: adminDash.html");
    exit;}

else{
    $conn->close();

    $_SESSION['forget-res']="No such user has this ID";
    header("Location:index.php#blackout");
    exit();
}




