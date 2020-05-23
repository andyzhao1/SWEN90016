<?php
session_start();
error_reporting(E_ERROR); 
$zh=$_POST['zh'];
$password=$_POST['password'];
$user=$_POST['user'];
$address=$_POST['address'];
$url="index.html";

if(!isset($user)){
    echo "<script> alert('please select a user type');</script>";
    $url="register.html";
	echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
	exit(0);
}
$conn=mysqli_connect("localhost","root","SHENGzhe0426","jjfresh"); 



$sql1="INSERT INTO account ".
        "(email,password, accountType, address) ".
        "VALUES ".
        "('$zh','$password','$user','$address')";
mysqli_query("set names 'utf8'");
mysqli_query($conn,$sql1);

echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
?>

