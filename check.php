<?php
session_start();
$field = $_GET['field'];
	if($field == 'productName'){
	$pattern1 = "/^[a-zA-Z ]+$/i";
	if($_GET['productName'] == ""){echo "";}
	else if(preg_match($pattern1,$_GET['productName'])){ echo "ok";}
	else echo "<p style=\"color:red;\">Example:Apple<p>";
	}
	
	if($field == 'number'){
	$pattern2 = "/^[0-9]+$/i";
	if($_GET['number'] == ""){echo "";}
	else if(preg_match($pattern2,$_GET['number'])) {echo "ok";}
	else echo "<p style=\"color:red;\">Example:0<p>";
	}
	
	if($field == 'email'){
	$pattern3 = "/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/i";
	if($_GET['email'] == ""){echo "";}
	else if(preg_match($pattern3,$_GET['email'])) {echo "ok";}
	else echo "<p style=\"color:red;\">Example:customer@customer.com<p>";
	}

	/* if($field == 'attendance'){
	$pattern4 = "/^[0-9]{1,3}%+$/i";
	if($_GET['attendance'] == ""){echo "";}
	else if(preg_match($pattern4,$_GET['attendance'])) {echo "ok";}
	else echo "<p style=\"color:red;\">Example:xx%<p>";
	}
	
	if($field == 'performance'){
	$pattern5 = "/^[0-9]{1,3}%+$/i";
	if($_GET['performance'] == ""){echo "";}
	else if(preg_match($pattern5,$_GET['performance'])) {echo "ok";}
	else echo "<p style=\"color:red;\">Example:xx%<p>";
	} */
?>