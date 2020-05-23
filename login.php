<?php
session_start();
error_reporting(E_ERROR); 
$zh=$_POST['zh'];
$password=$_POST['password'];
$user=$_POST['user'];

if(!isset($user)){
    echo "<script> alert('please select a user type');</script>";
    echo "<script> history.go(-1);</script>";
}
$conn=mysqli_connect("localhost","root","SHENGzhe0426","jjfresh"); 



$sql1="select * from account where email ='$zh' and password='$password' and accounttype='$user'";
//$sql2="select * from teacher where teach_id ='$zh' and password='$password' and AccountType='$user' ";
//$sql3="select * from student where stuno ='$zh' and password='$password' and AccountType='$user' ";
mysqli_query("set names 'utf8'");
switch($user){
    case 0:$result=mysqli_query($conn,$sql1)or die('got some trouble'); 
               $row = mysqli_fetch_array($result);
               $count=$row[0];
               if($count!=""){
                   $url="index_admin.php";
                   $_SESSION['admin_email']=$row['email'];
                   $_SESSION['admin_Address']=$row['address'];
                   echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
               }
               else {
                   echo "<script> alert('You are not admin user!');</script>";
				   echo "<script> history.go(-1);</script>";
                }
                break;
    case 1:$result=mysqli_query($conn,$sql1);
        $result=mysqli_query($conn,$sql1)or die('got some trouble'); 
               $row = mysqli_fetch_array($result);
               $count=$row[0];
               if($count!=""){
                   $url="index_customer.php";
                   $_SESSION['customer_email']=$row['email'];
                   $_SESSION['customer_Address']=$row['address'];
                   echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
               }
               else {
				   $sql2="select * from account where email ='$zh' and accounttype='$user'";
				   $result2=mysqli_query($conn,$sql2);
				   $row2 = mysqli_fetch_array($result2);
				   $count=$row2[0];
				   
				   if($count!=""){
						echo "<script> alert('Check password');</script>";
						echo "<script> history.go(-1);</script>";
				   }else{
						$url="register.html";
						echo "<script type='text/javascript'>"."location.href='".$url."'"."</script>";
				   }
                }
                break;
    default :break;
}  
?>




