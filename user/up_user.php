<?php 
session_start();
include '../function/dbconn.php';
if(empty($_SESSION['email'])){
		 header("Location: ../");
}
 $name  = $_POST['name'];
 $email = $_POST['email'];
 $pass  = $_POST['pass'];
 $oldemail = $_POST['oldemail'];
 $sql = "UPDATE tb_login SET  name='$name',email='$email',password='$pass' WHERE email='$oldemail'";
$ck = mysql_query($sql);
if(!$ck){
		echo "error". $sql ;
}
header("Location: ../");


 ?>