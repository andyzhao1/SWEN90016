<?php
session_start();
error_reporting(E_ERROR); 
$email = $_SESSION['admin_email'];
	function printProducttable()
	{
		$conn=mysqli_connect("localhost","root","SHENGzhe0426","jjfresh");
        mysqli_query("set names utf8");
		
		$sql="select * from purchase";
		$res=mysqli_query($conn, $sql);
		$colums=mysqli_num_fields($res);
		
		
		echo"<div style='text-align:center'>";
		echo "<table border='1'style='text-align:center;margin:auto'><tr>";
		echo "<th>Customer name</th>";
		echo "<th>Product</th>";
		echo "<th>Number</th>";
		echo "<th>Address</th>";
		echo "<th>Size</th>";
		echo "<th>Prices</th>";
		echo "<th>Delivery date</th>";
		echo "<th>Delivery time</th>";
		echo "</tr></div>";

		while($row=mysqli_fetch_row($res)){
			echo "<tr>";
			for($i=0; $i<$colums; $i++){
				if($i==0){
					//getName;
					echo "<td>$row[$i]</td>";
				}
				if($i==1){
					//getproduct);
					echo "<td>$row[$i]</td>";
				}
				if($i==2){
					//getnumber;
					echo "<td>$row[$i]</td>";
				}
				if($i==3){
					//getaddress;
					echo "<td>$row[$i]</td>";
				}
				if($i==4){
					//getsize;
					echo "<td>$row[$i]</td>";
				}
				if($i==5){
					//getprice;
					echo "<td>$$row[$i]</td>";
				}
				if($i==7){
					//getdeliverydate;
					echo "<td>$row[$i]</td>";
				}
				if($i==8){
					//getdtime;
					if($row[$i] == 1) echo "<td>4-5pm</td>";
					if($row[$i] == 2) echo "<td>5-6pm</td>";
					if($row[$i] == 3) echo "<td>6-7pm</td>";
				}
				
			}
			echo "</tr>";
		}
		echo "</table>";

	}
	
	
?>
<html>


<head>
<title>Adminiatrator management</title>
<style>

.form_wrapper{
text-align:center;

	background:#fff;
	border:1px solid #ddd;
	margin:0 auto;
	width:1200px;
	font-size:16px;
	-moz-box-shadow:1px 1px 7px #ccc;
	-webkit-box-shadow:1px 1px 7px #ccc;
	box-shadow:1px 1px 7px #ccc;
}
.form_wrapper input[type="text"],
.form_wrapper input[type="password"]{
	border: solid 1px #E5E5E5;
	margin: 5px 30px 0px 30px;
	padding: 9px;

	font-size:16px;
	background: #FFFFFF;
	background: 
		-webkit-gradient(
			linear, 
			left top, 
			left 25, 
			from(#FFFFFF), 
			color-stop(4%, #EEEEEE), 
			to(#FFFFFF)
		);
	background: 
		-moz-linear-gradient(
			top, 
			#FFFFFF,
			#EEEEEE 1px, 
			#FFFFFF 25px
			);
	-moz-box-shadow: 0px 0px 8px #f0f0f0;
	-webkit-box-shadow: 0px 0px 8px #f0f0f0;
	box-shadow: 0px 0px 8px #f0f0f0;
}
.form_wrapper input[type="text"]:focus,
.form_wrapper input[type="password"]:focus{
	background:#feffef;
}
.form_wrapper input[type="submit"] {
text-align:center;
	background: #e3e3e3;
	border: 1px solid #ccc;
	color: #333;
	font-family: "Trebuchet MS", "Myriad Pro", sans-serif;
	font-size: 14px;
	font-weight: bold;
	padding: 8px 0 9px;
	text-align: center;
	width: 150px;
	cursor:pointer;
	margin:15px 20px 10px 10px;
	text-shadow: 0 1px 0px #fff;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 3px;
	-moz-box-shadow: 0px 0px 2px #fff inset;
	-webkit-box-shadow: 0px 0px 2px #fff inset;
	box-shadow: 0px 0px 2px #fff inset;
}
.form_wrapper input[type="submit"]:hover {
	background: #d9d9d9;
	-moz-box-shadow: 0px 0px 2px #eaeaea inset;
	-webkit-box-shadow: 0px 0px 2px #eaeaea inset;
	box-shadow: 0px 0px 2px #eaeaea inset;
	color: #222;
}
</style>
</head>


<body>
<!-- <h2> Hi, you are <u Style="color:#96CDCD">administrator</u>, you can set up an acccount </h2> -->

<form action="logout.php" method="post" class="">
	<?php 
		echo $email;
	?>
	<input type="submit" value="logout" name="submit">
</form>
<div class="form_wrapper">

<h2>Order List </h2>
	<?php
		printProducttable();	
	?>


</div>
</body>
</html>