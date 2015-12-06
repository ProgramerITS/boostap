<?php 
include '../function/dbconn.php';
$sql = "SELECT reviews_yar FROM tb_yar WHERE name_yar='".$_GET['name']."'";
$rs = mysql_query($sql);
$row = mysql_fetch_assoc($rs);
$num = $row['reviews_yar'];
$num = $num+1;
// print_r($num);

$sql = "UPDATE tb_yar SET reviews_yar='$num' WHERE name_yar='".$_GET['name']."'";
mysql_query($sql);

header("Location: ../show.php?img=".$_GET['name']."");

exit;
?>