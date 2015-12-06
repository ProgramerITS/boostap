<?php 
session_start();
if($_SESSION['permision']!=2){
	header("Location: ../");
}
include '../function/dbconn.php';
$rs =  mysql_query("SELECT * FROM tb_login");
while ($row = mysql_fetch_assoc($rs)) {
	$ck = mysql_query('UPDATE tb_login SET permision='.$_POST[$row['id']].' WHERE id=\''.$row['id'].'\'');
	if(!$ck){
		exit;
	}

}
header("Location: ../function/admin.php");
?>