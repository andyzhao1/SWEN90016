<?php
session_start();
error_reporting(E_ERROR);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 
require 'vendor/autoload.php';

$conn=mysqli_connect("localhost","root","SHENGzhe0426","jjfresh");
mysqli_query("set names utf8");

$email = $_SESSION['customer_email'];
$address = $_SESSION['customer_Address'];
$productName=$_POST['productName'];
$number = $_POST['number'];
$size=$_POST['size'];


date_default_timezone_set('Australia/Melbourne');
$deliverdate = $_POST['ddate'];
if($deliverdate == 1){
	$deliverdate = date("d/m/Y",strtotime("+1 day"));
}else if($deliverdate == 2){
	$deliverdate = date("d/m/Y",strtotime("+2 day"));
}else if($deliverdate == 3){
	$deliverdate = date("d/m/Y",strtotime("+3 day"));
}else if($deliverdate == 4){
	$deliverdate = date("d/m/Y",strtotime("+4 day"));
}else if($deliverdate == 5){
	$deliverdate = date("d/m/Y",strtotime("+5 day"));
}else if($deliverdate == 6){
	$deliverdate = date("d/m/Y",strtotime("+6 day"));
}else{
	$deliverdate = date("d/m/Y",strtotime("+7 day"));
}

$delivertime = $_POST['dtime'];
$dtime_index = 0;
$sql="select * from purchase where ddate='$deliverdate' and dtime='$delivertime'";
$res=mysqli_query($conn,$sql);
while($row=mysqli_fetch_row($res)){
	$dtime_index = $dtime_index + 1;
	if($dtime_index == 2){
		$url = "index_customer.php";
		echo "<script> alert('This time is full, please choose other delivery time.');</script>";
		echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
		exit(0);
	}
}

date_default_timezone_set('Australia/Melbourne'); 
$date = date("d/m/Y");
$time = date("h:i:sa");

$sql="select price from product where name='$productName'";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($res);
$price = $row[0]*$size*$number;
if($size == 1) $size = 'Small';
if($size == 2) $size = 'Medium';
if($size == 3) $size = 'Large';

$sql="select indexnum from purchase where name='$email'";
$res=mysqli_query($conn,$sql);
$index = 0;
while($row=mysqli_fetch_row($res)){
	if($row[0] > $index) $index = $row[0];
}
$index = $index + 1;

$sql="INSERT INTO purchase VALUES ('$email', '$productName', '$number', '$address', '$size', '$price', '$index', '$deliverdate', '$delivertime')";
$res=mysqli_query($conn,$sql);

$sql1="select stock from product where name='$productName'";
mysqli_query("set names 'utf8'");
$res1=mysqli_query($conn,$sql1);
$row=mysqli_fetch_row($res1);

$stock_left = $row[0] - $number;
$sql2="UPDATE product SET stock='$stock_left' WHERE name='$productName'";
mysqli_query("set names 'utf8'");
$res2=mysqli_query($conn,$sql2);

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
    $mail->Subject = 'Order Receipt';
    $mail->Body    = "<p>Date:'$date'</p><p>Time:'$time'</p><p>Type:'$productName'</p><p>Size:'$size'</p><p>Total Price:'$$price'</p>";
    $mail->AltBody = "Data:'$date'\nTime:'$time'\nType:'$productName'\nSize:'$size'\nTotal Price:'$$price'";

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

/*send email end*/


$url = "index_customer.php";
echo "<script> alert('Order Complete!');</script>";
//echo "<script> history.go(-1);</script>";
echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
?>