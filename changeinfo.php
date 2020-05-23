<?php
	session_start(); 
	error_reporting(E_ERROR);
	$name = $_POST['name'];
	$address = $_POST['address'];
	$mobile = $_POST['phone1'];
	$home=$_POST['phone2'];
	$work = $_POST['phone3'];
	$email = $_SESSION['customer_email'];
	$conn=mysqli_connect("localhost","root","SHENGzhe0426","jjfresh");
	mysqli_query("set names utf8");
	$sql="UPDATE account SET name='$name',address='$address',mobile='$mobile',homephone='$home',workphone='$work' WHERE email='$email'";
	$res=mysqli_query($conn,$sql);
	$url = "index_customer.php";
	echo "<script> alert('Change complete!');</script>";
	echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
?>