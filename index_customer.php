<?php
session_start();
error_reporting(E_ERROR); 
$email = $_SESSION['customer_email'];

	function printProducttable()
	{
		$conn=mysqli_connect("localhost","root","SHENGzhe0426","jjfresh");
        mysqli_query("set names utf8");
		
		$sql="select * from product";
		$res=mysqli_query($conn, $sql);
		//$rows=mysql_affected_rows($conn);
		$colums=mysqli_num_fields($res);
		
		
		echo"<div style='text-align:center'>";
		echo "<table border='1'style='text-align:center;margin:auto'><tr>";
		echo "<th>Product</th>";
		echo "<th>Surplus Stock</th>";
		echo "<th>Prices(small size)</th>";
		echo "</tr></div>";

		while($row=mysqli_fetch_row($res)){
			echo "<tr>";
			for($i=0; $i<$colums; $i++){
				if($i==0){
					//getProductName($row[$i]);
					echo "<td>$row[$i]</td>";
				}
				if($i==1){
					//getStock($row[$i]);
					echo "<td>$row[$i]</td>";
				}
				if($i==2){
					echo "<td>$$row[$i]</td>";
				}
				
				
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	
	function showorder($email)
	{
		$conn=mysqli_connect("localhost","root","SHENGzhe0426","jjfresh");
        mysqli_query("set names utf8");
		$sql="select * from purchase where name = '$email'";
		$res=mysqli_query($conn, $sql);
		$colums=mysqli_num_fields($res);
		
		
		echo"<div style='text-align:center'>";
		echo "<table border='1'style='text-align:center;margin:auto'><tr>";
		echo "<th>Customer email</th>";
		echo "<th>Product</th>";
		echo "<th>Number</th>";
		echo "<th>Address</th>";
		echo "<th>Size</th>";
		echo "<th>Prices</th>";
		echo "<th>Delivery date</th>";
		echo "<th>Delivery time</th>";
		echo "<th>Cancel</th>";
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
					//getddate;
					echo "<td>$row[$i]</td>";
				}
				if($i==8){
					//getdtime;
					if($row[$i] == 1) echo "<td>4-5pm</td>";
					if($row[$i] == 2) echo "<td>5-6pm</td>";
					if($row[$i] == 3) echo "<td>6-7pm</td>";
				}
			}
			echo  "<td><a href='cancelorder.php?email=". $email ."&index=". $row[6] ."'>Cancel</a></td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<p></p>";
		echo "<p></p>";
	}
	
	
?>
<html>


<head>
<title>JJFresh</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
	<script>
		$(document).ready(function(){
			if($("#productName").val()!=""){
			//$.ajax({url:"check.php?productName="+$("#productName").val()+"&field=productName",success:function(result){
			//	$("#check1").html(result);}});
			$.ajax({url:"check.php?number="+$("#number").val()+"&field=number",success:function(result){
				$("#check2").html(result);}});
			}
				
			//$("#productName").keyup(function(){
			//	$.ajax({url:"check.php?productName="+$("#productName").val()+"&field=productName",success:function(result){
			//	$("#check1").html(result);}});
			//});
			$("#number").keyup(function(){
				$.ajax({url:"check.php?number="+$("#number").val()+"&field=number",success:function(result){
				$("#check2").html(result);}});
			});
		});

		function finalcheck(){
			var check1 = $("#check2").html();
			if(check1 != "ok"){
				alert("Choose the number of items!");
				return false;
			}
			else{
				return true;
			}
		}
	</script>
<style>
#first,
#second{
text-align:center;
	background:#fff;
	border:1px solid #ddd;
	margin:0 auto;
	width:1000px;
	font-size:16px;
	-moz-box-shadow:1px 1px 7px #ccc;
	-webkit-box-shadow:1px 1px 7px #ccc;
	box-shadow:1px 1px 7px #ccc;
}


.form_wrapper input[type="text"],
.form_wrapper input[type="password"],
.form_wrapper select{
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
.form_wrapper input[type="password"]:focus,
.form_wrapper select:focus{
	background:#feffef;
}
.form_wrapper input[type="submit"] {

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

<form action="logout.php" method="post" class="">
	<?php 
		echo $email;
	?>
	<input type="submit" value="logout" name="submit">
</form>

<div id ="first" >
<h2>Product List </h2>
<?php
	printProducttable();	
?>
	
<h2>Order Here!</h2>
<form action="buybuybuy.php" method="post" class="form_wrapper">
			<!--<input type="text"  id="productName"  name="productName"   placeholder="Product Name" required=""><div id="check1"></div>-->
			<select id="productName" name="productName">
			  <option value ="Fruit box">Fruit box</option>
			  <option value ="Vegetable box">Vegetable box</option>
			  <option value="Mixed fruit and vegetable box">Mixed fruit and vegetable box</option>
			</select><p></p>
			<input type="text"  id="number"  name="number"       placeholder="Purchase Number" required=""><div id="check2"></div><p></p>
			Size:<select name="size">
			  <option value ="1">Small</option>
			  <option value ="2">Medium</option>
			  <option value="3">Large</option>
			</select>
			Deliver date:<select name="ddate">
			  <option value ="1">Tomorrow</option>
			  <option value="2">In tow days</option>
			  <option value="3">In three days</option>
			  <option value="4">In four days</option>
			  <option value="5">In five days</option>
			  <option value="6">In six days</option>
			  <option value="7">In seven days</option>
			</select>
			Deliver time:<select name="dtime">
			  <option value ="1">4-5pm</option>
			  <option value ="2">5-6pm</option>
			  <option value="3">6-7pm</option>
			</select>
			<div class="clearfix"></div>
			<input onclick="return finalcheck();" type="submit" value="Buy" name="submit">
</form>
<div>
	Note: Small - For couple; Medium - For family of 4(double price); Large - family of 6(triple price)
</div>

<div id ="second" >
<h2>Order Summary</h2>
<?php
	showorder($email);	
?>

</div>

</div>
<div id ="third" >
<h2>Change/update your detail</h2>
<form action="changeinfo.php" method="post" class="form_wrapper">
			<input type="text"  name="name"   placeholder="Type your name here" required="">
			<input type="text"  name="address"      placeholder="Add/update address" required="">
			<input type="text"  name="phone1"       placeholder="Mobile" required="">
			<input type="text"  name="phone2"       placeholder="Home number" required="">
			<input type="text"  name="phone3"       placeholder="Work number" required="">
			
			<div class="clearfix"></div>
			<input onclick="" type="submit" value="Submit" name="submit">
</form>


</div>

</body>


</html>