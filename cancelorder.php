<?php 
session_start();
error_reporting(E_ERROR); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 
require 'vendor/autoload.php';

$conn=mysqli_connect("localhost","root","SHENGzhe0426","jjfresh");
mysqli_query("set names utf8");

$email=$_GET['email'];
$index=$_GET['index'];

$sql="select * from purchase where name='$email' and indexnum='$index'";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($res);
$productName=$row[1];
$number = $row[2];
$size=$row[4];

$sql="delete from purchase where name='$email' and indexnum='$index'";
mysqli_query($conn,$sql);

/*send email*/
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    	// Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'jjfreshautomail@gmail.com';                     // SMTP username
    $mail->Password   = 'JJFresh.123';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('jjfreshautomail@gmail.com');
    //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($email);               // Name is optional
    $mail->addReplyTo('jjfreshautomail@gmail.com');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Order Cancellation';
    $mail->Body    = "<h1>The following order has been cancelled: </h1><p>Type:'$productName'</p><p>Number:'$number'</p><p>Size:'$size'</p>";
    $mail->AltBody = "The following order has been cancelled:\nType:'$productName'\nNumber:'$number'\nSize:'$size'";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

/*send email end*/

$url = "index_customer.php";
echo "<script> alert('Order has been deleted!');</script>";
//echo "<script> history.go(-1);</script>";
echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
?>