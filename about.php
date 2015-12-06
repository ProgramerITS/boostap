<?php 
session_start();

$cout_shop = isset($_SESSION['cout_shop'])?$_SESSION['cout_shop']:'0';
$_SESSION['email'] = isset($_SESSION['email'])?$_SESSION['email']:'';
$name = isset($_SESSION['name'])?$_SESSION['name']:'';
$_SESSION['permision']=isset($_SESSION['permision'])?$_SESSION['permision']:'0';
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
include './function/dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Zinim Shop</title>

   
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <link href="./css/shop-homepage.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
</head>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Zanim shop</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="./about.php">About</a>
                    </li>
                    
                    <li>
                        <a href="./show.php">Contact</a>
                    </li>
                    <?php  

                    if($_SESSION['permision']==2){?>
                    <li>
                        <a href="./function/admin.php">Admin</a>
                    </li>
                    <?php } ?>
                    
                </ul>   
                <ul class="nav navbar-nav navbar-right">
                    <li>
                         <?php  
                            echo '<a ';
                            if(isset($_SESSION['name'])){
                                  echo 'data-toggle="modal" data-target="#edit"';
                            }
                            echo '>'.$name;
                            if(isset($details->country)){
                                if(!empty($name)){
                                    echo " : ";
                                }
                                echo $details->country;
                            }

                            echo '</a>';
                        ?>
                    </li>
                    <li>
                    <a class="item" href="#">
                         <?php
                                if(!isset($_SESSION['email'])){
                                        echo '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">Login</button>';
                                                               
                                    }else{
                                         if(empty($_SESSION['email'])){
                                          echo '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">Login</button>';
                                        }else{
                                         echo'<form action="./function/login.php">
                                                <input class="btn btn-info btn-xs" type="submit" value="logout">
                                              </form>';}
                                    }
                            ?>
                        
                        </a>
                    </li>
                    <li>
                        <a class="item" href="#">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            <label>shop</label>
                            <?php  if($cout_shop>0){?>
                            <button type="button" class="btn btn-warning btn-xs"><?=$cout_shop;?></button>
                            <?php } ?>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-2">
                <p class="lead"></p>
                <div class="list-group">
                
                </div>
            </div>

            <div class="col-md-9">

            

                <div class="row alert alert-info">
                    <br>
      
                   <div class="alert alert-warning" >
                         <font size="6">รายชือสมาชิก</font> 

                   </div>
                   <div class="alert alert-warning">
                   <font size="5">
                           <p><a href="https://www.facebook.com/nack.sinclairvincent"> Mr.Theerawat butsongka  No.6</a></p>
                           <p><a href="https://www.facebook.com/Kig.ITS"> Mr.Phisut  kosayamat    No.9</a></p>
                           <p><a href="https://www.facebook.com/profile.php?id=100004522155585&pnref=story"> Mr.Angkarn Karisin      No.24</a> </p>
                           </font>
                   </div>
                    

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Zamin shop 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


  <!-- Login FROM -->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog ">
     <form class="form-horizontal" role="form" action="./function/login.php" method="post">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">login</h4>
        </div>
        <div class="modal-body">
                             <div class="form-group">
                             <label class="col-sm-2" for="email">Email:</label>
                             <div class="col-sm-10">
                             <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required autofocus>
                             </div>
                             </div>
                             
                                        <div class="form-group">
                                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                                        <div class="col-sm-10">          
                                        <input type="password" name="pass" class="form-control" id="pwd" placeholder="Enter password" required autofocus>
                                        </div>
                                        </div>
                                                    <div class="form-group">        
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                    <div class="checkbox">
                                                    <label><input type="checkbox"> Remember me</label>
                                                    </div>
                                                    <p><a href="./user/reg.php">register?</a></p>
                                                    </div>
                                                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <span class="col-sm-6 pull-left">
        <button type="submit" class="btn btn-default btn-primary">Login</button>
      
      </span >
        </div>
      </div>
      </form>
    </div>
  </div>
  
</div>




<!-- ADD FROM -->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="add" role="dialog">
    <div class="modal-dialog">
     <form class="form-horizontal" role="form" action="./img/upload_data.php" method="post" enctype="multipart/form-data">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add  data</h4>
        </div>
        <div class="modal-body">
                             <div class="form-group">
                             <label class="col-sm-2" for="name">name:</label>
                             <div class="col-sm-10">
                             <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" required autofocus>
                             </div>
                             </div>
                                              <div class="form-group">
                                             <label class="col-sm-2" for="name">description:</label>
                                             <div class="col-sm-10">
                                                    <textarea class="form-control"  name="description">-</textarea>
                                             </div>
                                             </div>
                                                            <div class="form-group">
                                                            <label class="control-label col-sm-2" for="pwd">category:</label>
                                                            <div class="col-sm-10">          
                                                            <select name="category" >
                                                                <option value="drug">drug</option>
                                                                <option value="water">wate</option>
                                                            </select>
                                                            </div>
                                                            </div>



                                                                                            <div class="form-group">
                                                                                            <label class="control-label col-sm-2" for="pwd">money:</label>
                                                                                            <div class="col-sm-10">          
                                                                                            <input type="number" name="money" class="form-control" id="money" placeholder="Enter money" min="0" required autofocus>
                                                                                            </div>
                                                                                            </div>
                                                                                                             <div class="form-group">
                                                                                                             <label class="control-label col-sm-2" for="pwd">image:</label>
                                                                                                             <div class="col-sm-10">    
                                                                                                                <span class="btn btn-default btn-file">      
                                                                                                                      <input   type="file" name="fileField" value="myValue" accept=".jpg" id="fileField">
                                                                                                                </span>
                                                                                                             </div>
                                                                                                             </div>
                                                  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <span class="col-sm-6 pull-left">
        <button type="submit" class="btn btn-default btn-primary">Add</button>
      
      </span >
        </div>
      </div>
      </form>
    </div>
  </div>
  
</div>



 <!-- EDIT USER FROM -->
<div class="container">
<?php 
 $rs =  mysql_query("SELECT * FROM tb_login WHERE email='".$_SESSION['email']."'");
 $row = mysql_fetch_assoc($rs);


 ?>
  <!-- Modal -->
  <div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog ">
     <form class="form-horizontal" role="form" action="./user/up_user.php" method="post">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">EDIT USER</h4>
        </div>
        <div class="modal-body">
              <div class="form-group">
              <label class="control-label col-sm-2" for="name">Name:</label>
              <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="<?=$row['name'];?>" required autofocus>
              </div>
              </div>
                       <div class="form-group">
                       <label class="control-label col-sm-2" for="email">Email:</label>
                       <div class="col-sm-10">
                       <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?=$row['email'];?>" required autofocus>
                       </div>
                       </div>
                                <div class="form-group">
                                <label class="control-label col-sm-2" for="pwd">Password:</label>
                                <div class="col-sm-10">          
                                <input type="password" name="pass" class="form-control" id="pwd" placeholder="Enter password" required autofocus>
                                </div>
                                </div>
        </div>
        <div class="modal-footer ">
        <span class="col-sm-6 pull-right">

        <button type="button" class="btn btn-default btn-danger"  data-dismiss="modal">close</button>
         <input type="hidden" name="oldemail" value="<?=$row['email'];?>">
        </span >
        <span class="col-sm-6 pull-left">
        <button type="submit" class="btn btn-default btn-primary">upadate</button>
            
      </span ></div>
      </div>
      </form>
    </div>
  </div>
  
</div>







<!-- EDIT FROM -->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="editData" role="dialog">
    <div class="modal-dialog">
     <form class="form-horizontal" role="form" action="./img/upload_data.php" method="post" enctype="multipart/form-data">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">edit  data</h4>
        </div>
        <div class="modal-body">
                                            <?php
                                                $dataSql = isset($_GET['data'])?$_GET['data']:'';
                                                $rs = mysql_query("SELECT * FROM tb_yar WHERE name_yar = '$dataSql'");
                                                $row = mysql_fetch_assoc($rs);

                                             ?>
                             <div class="form-group">
                             <label class="col-sm-2" for="name">name:</label>
                             <div class="col-sm-10">
                             <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="<?=$row['name_yar'];?>" required autofocus>
                             </div>
                             </div>
                                             
                                              <div class="form-group">
                                             <label class="col-sm-2" for="name">description:</label>
                                             <div class="col-sm-10">
                                                    <textarea class="form-control"  name="description"><?=$row['description_yar'];?></textarea>
                                             </div>
                                             </div>
                                                            <div class="form-group">
                                                            <label class="control-label col-sm-2" for="pwd">money:</label>
                                                            <div class="col-sm-10">          
                                                            <select name="category" >
                                                                <option value="drug" <?php if($row['category']=='drug'){echo 'selected';}?>>drug</option>
                                                                <option value="water"<?php if($row['category']=='water'){echo 'selected';}?>>wate</option>
                                                            </select>
                                                            </div>
                                                            </div>



                                                                                            <div class="form-group">
                                                                                            <label class="control-label col-sm-2" for="pwd" >money:</label>
                                                                                            <div class="col-sm-10">          
                                                                                            <input type="number" name="money" class="form-control" id="money" placeholder="Enter money" min="0" value="<?=$row['money_yar'];?>" required autofocus>
                                                                                            </div>
                                                                                            </div>
                                                                                                             <div class="form-group">
                                                                                                             <label class="control-label col-sm-2" for="pwd">image:</label>
                                                                                                             <div class="col-sm-10">    
                                                                                                                <span class="btn btn-default btn-file">      
                                                                                                                      <input   type="file" name="fileField" value="myValue" accept=".jpg" id="fileField">
                                                                                                                </span>
                                                                                                             </div>
                                                                                                             </div>
                                                                                                             <input type="hidden" name="oldname" value="<?=$row['name_yar'];?>">
                                                  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <span class="col-sm-6 pull-left">
        <button type="submit" class="btn btn-default btn-primary">update</button>
      
      </span >
        </div>
      </div>
      </form>
    </div>
  </div>
  
</div>







 <!-- EDIT USER FROM -->
<div class="container">
<?php 
 $rs =  mysql_query("SELECT * FROM tb_login");
 


 ?>
  <!-- Modal -->
  <div class="modal fade" id="permision" role="dialog">
    <div class="modal-dialog ">
     <form class="form-horizontal" role="form" action="permision_update.php" method="post">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Permision</h4>
        </div>
        <div class="modal-body">
        <table class="table table-hover">
                    <thead>
                           <tr>
                                <th>#</th><th>name</th><th>email</th><th>permision</th>
                              </tr>
              <?php 
                while ($row = mysql_fetch_assoc($rs)) {
                    echo '<tr>';
                         echo '<td>'.$row['id'].'</td>';
                         echo '<td>'.$row['name'].'</td>';
                         echo '<td>'.$row['email'].'</td>';
                         echo '<td><input type="number" name="'.$row['id'].'" value="'.$row['permision'].'" placeholder="" min="0" max="2" required autofocus></td>';
                    echo '</tr>';
                }
               ?>
               </table>
        </div>
        <div class="modal-footer ">
        <span class="col-sm-6 pull-right">

        <button type="button" class="btn btn-default btn-danger"  data-dismiss="modal">close</button>
         <input type="hidden" name="oldemail" value="<?=$row['email'];?>">
        </span >
        <span class="col-sm-6 pull-left">
        <button type="submit" class="btn btn-default btn-primary">upadate</button>
            
      </span ></div>
      </div>
      </form>
    </div>
  </div>
  
</div>
<?php if(isset($_GET['data'])){ ?>
    <script type="text/javascript">
    $(window).load(function(){
        $('#editData').modal('show');
    });
</script>
<?php } ?>

<?php if(isset($_GET['search'])){ ?>
  <script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });
</script>
<?php } ?>




</body>

</html>