<?php
include'dbconn.php'; 
print_r($_POST);
session_start();
session_destroy();
session_start();
if(!isset($_SESSION['email'])){
	$email = $_POST['email'];
	$pass  = $_POST['pass'];
	$rs = mysql_query("SELECT * FROM tb_login WHERE email = '$email' AND password='$pass'");
	if(mysql_num_rows($rs)>0){
			$row = mysql_fetch_assoc($rs);
			$_SESSION['email']=$row['email'];
			$_SESSION['name']=$row['name'];
			$_SESSION['permision']=$row['permision'];
	}
	
}else{
	session_destroy();
	echo "string";
    }
header("Location: ../");
?>