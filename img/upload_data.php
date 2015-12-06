<?php 
	include '../function/dbconn.php';
    $filename = $_FILES['fileField']['name'];
	$path = getcwd().DIRECTORY_SEPARATOR;
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
      		echo"<script language=\"JavaScript\">";
			echo 'alert("File extensions .'.$jp[count($jp)-1].' Please only upload .jpg")';
			echo"</script>";
			
			$filename ='NU';
			}
			$sql =  "INSERT INTO tb_yar (name_yar,description_yar,money_yar,img_yar) VALUES ('".$_POST['name']."','".$_POST['description']."','".$_POST['money']."','$filename')";
			$ck = mysql_query($sql);
			if($ck){
				header("Location: ../function/admin.php");
			}
			

 ?>