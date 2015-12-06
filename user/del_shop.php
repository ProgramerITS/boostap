<?php 
session_start();

if(isset($_GET['cls'])){
		unset($_SESSION['order']);
		unset($_SESSION['monny']);
		unset($_SESSION['name_shop']);
		unset($_SESSION['cout_shop']);
		header("Location: ../show.php");
		exit;
}
if(isset($_POST)){
$_SESSION['order'] = isset($_SESSION['order'])?$_SESSION['order']:'';
$order = explode('|',$_SESSION['order']);

$_SESSION['monny'] = isset($_SESSION['monny'])?$_SESSION['monny']:'';
$monny = explode('|',$_SESSION['monny']);

$_SESSION['name_shop'] = isset($_SESSION['name_shop'])?$_SESSION['name_shop']:'';
$name_shop = explode('|',$_SESSION['name_shop']);
$v=0;
for($i=0;$i<count($order);$i++){

	if($i==$_GET['row']){
			unset($order[$i]);
			unset($monny[$i]);
			unset($name_shop[$i]);
	}
	

}
$_SESSION['name_shop'] = implode('|',$name_shop);
$_SESSION['monny']    = implode('|', $monny);
$_SESSION['order']    = implode('|', $order);
$cout_shop = $_SESSION['cout_shop'];
$cout_shop=$cout_shop-1;
$_SESSION['cout_shop']=$cout_shop;
}
header("Location: ../show.php");
?>