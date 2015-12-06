<?php 
session_start();
include 'dbconn.php';
if($_SESSION['permision']!=2){
	header("Location: ../");
}

mysql_query('DELETE FROM tb_yar WHERE name_yar=\''.$_GET['del'].'\'');
header("Location: ./admin.php");
?>