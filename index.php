<?php
session_start();
$cout_shop = isset($_SESSION['cout_shop'])?$_SESSION['cout_shop']:'0';
$name = isset($_SESSION['name'])?$_SESSION['name']:'';
$_SESSION['permision']=isset($_SESSION['permision'])?$_SESSION['permision']:'0';
include './function/dbconn.php';
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
$_SESSION['email'] = isset($_SESSION['email'])?$_SESSION['email']:'';
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Zanim Shop</title>

   
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/shop-homepage.css" rel="stylesheet">

    

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
                <a class="navbar-brand" href="#">Zanim shop</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#">About</a>
                    </li>
                    
                    <li>
                        <a href="show.php">Contact</a>
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
                        <a class="item" href="#" data-toggle="modal" data-target="#<?php if($cout_shop>0){ echo "buy";}?>">
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

            <div class="col-md-3">
                <p class="lead">Category</p>
               <div class="list-group">
                    <a href="?category=water" class=" list-group-item <?php if($_GET['category']=='water'){echo "disabled";} ?>" >Water medicines</a>
                    <a href="?category=drug" class="list-group-item <?php if($_GET['category']=='drug'){echo "disabled";} ?>" >Drug grain</a>
                    
                </div>
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="./img/slide/1.jpg" alt="" height="300" width="800">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="./img/slide/2.jpg" alt="" height="300" width="800">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="./img/slide/3.jpg" alt="" height="300" width="800">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row">

                   
                    <?php 

                    $sql = "SELECT * FROM tb_yar ";
                    if(isset($_GET['category'])){
                      $category = $_GET['category'];
                          $sql .= " WHERE category ='$category'";
                    }
                    $sql .= " ORDER BY reviews_yar DESC LIMIT 6";
                    //echo "$sql";
                    
                    $rs = mysql_query($sql);
                    while ($row = mysql_fetch_assoc($rs)) {
                   
                     ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                         <a href="./user/add_vile.php?name=<?=$row['name_yar'];?>">
                            <img src="./img/yar/<?=$row['img_yar'].'.jpg';?>" alt="Cinque Terre" style="width:320px;height:150px;" >
                            </a>
                            
                            <div class="caption">
                                <h4 class="pull-right"><?=$row['money_yar'].'฿';?></h4>
                                <h4><a href="./user/add_vile.php?name=<?=$row['name_yar'];?>"><?=$row['name_yar'];?></a>
                                </h4>
                                <p><?=$row['description_yar'];?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?=$row['reviews_yar'];?> reviews</p>
                                <p>

                                    <?php
                                    $star = $row['reviews_yar']/10;
                                  
                                    for($i=0;$i<5;$i++){
                                       if($star>0){
                                            echo '<span class="glyphicon glyphicon-star"></span>';
                                            $star--;
                                        }else{
                                            echo '<span class="glyphicon glyphicon-star-empty"></span>';
                                        }}
                                    ?>
                                </p>
                                <form action="./function/buy.php" method="post">
                                 <span><input id="txtName" size="1" name="order" type="number" value="0" min="0"/>
                                        <input type="hidden" name="money" value="<?=$row['money_yar'];?>">
                                        <input type="hidden" name="nameyar" value="<?=$row['name_yar'];?>">
                                         <button class="glyphicon glyphicon-shopping-cart" type="submit"> Buy </button>
                                    </span></form><br>
                                                         
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                   
                    

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
                    <p>Copyright &copy; Your Website 2014</p>
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



 <!-- SHOP FROM -->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="buy" role="dialog">
    <div class="modal-dialog ">
     <form class="form-horizontal" role="form" action="./pdf/report2.php" method="post">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">จำนวนสินค้า  <?=$cout_shop;?> ชิ้น</h4>
        </div>
        <div class="modal-body">
              <table class="table table-hover">
                    <thead>
                           <tr>
                                <th>#</th><th>name</th><th>order</th><th>salary</th>
                              </tr>
                          </thead>
                           <?php 

                           $_SESSION['order'] = isset($_SESSION['order'])?$_SESSION['order']:'';
                           $order = explode('|',$_SESSION['order']);

                           $_SESSION['monny'] = isset($_SESSION['monny'])?$_SESSION['monny']:'';
                           $monny = explode('|',$_SESSION['monny']);

                            $_SESSION['name_shop'] = isset($_SESSION['name_shop'])?$_SESSION['name_shop']:'';
                           $name_shop = explode('|',$_SESSION['name_shop']);
                           $cout_monney=0;
                           for($i=1;$i<$cout_shop+1;$i++){
                                        
                                    echo'
                                  
                                    <tbody>
                                        <tr>';
                                            echo "<td>".$i."</td>";
                                            echo "<td>$name_shop[$i]</td>";
                                            echo "<td>$order[$i]</td>";
                                            $mon = $order[$i]*$monny[$i];
                                            echo "<td>$mon</td>";
                                            $cout_monney +=$mon;
                                             echo '<td><a class="glyphicon glyphicon-remove " href="./user/del_shop.php?row='.$i.'" ></a></td>';
                                         echo'</tr>
                                    </tbody>';
                                
                           };?>
            <tbody>
                                                    <tr><td></td><td></td><td></td><td><?=$cout_monney;?></td><td></td></tr>
            </tbody>
           </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <span class="col-sm-6 pull-left">
        <button type="submit" class="btn btn-default btn-success">BUY</button>
        <button type="buton" class="btn btn-default btn-danger" onclick="window.location.href='./del_shop.php?cls'">clear</button>
      
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




</body>

</html>
