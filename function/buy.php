<?php 
session_start();
$cout_shop = isset($_SESSION['cout_shop'])?$_SESSION['cout_shop']:'0';
if($_POST['order']==0){
		header("Location: ../");
		exit;
}
$cout_shop=$cout_shop+1;
$_SESSION['cout_shop']=$cout_shop;

		$data_shop = explode('|', $_SESSION['name_shop']);
		$data_shop[count($data_shop)] =$_POST['nameyar'];
		$_SESSION['name_shop']=implode('|', $data_shop);
		print_r($data_shop);

		$data_shop = explode('|', $_SESSION['monny']);
		$data_shop[count($data_shop)] =$_POST['money'];
		$_SESSION['monny']=implode('|', $data_shop);
		print_r($data_shop);


		$data_shop = explode('|', $_SESSION['order']);
		$data_shop[count($data_shop)] =$_POST['order'];
		$_SESSION['order']=implode('|', $data_shop);
		print_r($data_shop);


//echo $_SESSION['cout_shop'];
header("Location: ../show.php");
exit;
 ?>