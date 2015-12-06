<?php 
include '../function/dbconn.php';
    $filename = $_FILES['fileField']['name'];
	$pat = getcwd().DIRECTORY_SEPARATOR;
	$jp = explode('.', $filename);
	$path = $pat.'yar/';
	$filename = $_POST['name'].'.jpg';
	
	if($jp[count($jp)-1]=='jpg'){
		echo "jpg";
		   $target = $path.$filename;
		   move_uploaded_file($_FILES['fileField']['tmp_name'] ,$target);
		   echo "Upload commpese :: ".$target."<br>";
		   echo $filename;
		   $filename =$_POST['name'];

       	}else{
      				
			$filename ='NU';
			}





	if(!isset($_POST['oldname'])){
	
			$sql =  "INSERT INTO tb_yar (name_yar,description_yar,money_yar,img_yar,category) VALUES ('".$_POST['name']."','".$_POST['description']."','".$_POST['money']."','$filename','".$_POST['category']."')";
			$ck = mysql_query($sql);
			if($ck){
				
				header("Location: ../function/admin.php");
				exit;
			}
	}else{	


			$sql =  "UPDATE tb_yar SET name_yar = '".$_POST['name']."' ,description_yar='".$_POST['description']."',money_yar='".$_POST['money']."',category='".$_POST['category']."' WHERE name_yar = '".$_POST['oldname']."'";
			$ck = mysql_query($sql);
			echo "$sql";
			if($ck){
				header("Location: ../function/admin.php");
			}







	}
	
	header("Location: ../function/admin.php");
	exit;		

 ?>