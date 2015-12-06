<?php
session_start();
$cout_shop = isset($_SESSION['cout_shop'])?$_SESSION['cout_shop']:'0';
$name = isset($_SESSION['name'])?$_SESSION['name']:'';
$_SESSION['permision']=isset($_SESSION['permision'])?$_SESSION['permision']:'0';
include '../function/dbconn.php';
if(empty($_SESSION['email'])){
 header("Location: ../");
}
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

   
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/shop-homepage.css" rel="stylesheet">

    

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

                <a class="navbar-brand" href="../">Znim shop</a>
           
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <?php  

                    if($_SESSION['permision']==2){?>
                    <li>
                        <a href="../function/admin.php">Admin</a>
                    </li>
                    <?php } ?>
                    
                </ul>   
                <ul class="nav navbar-nav navbar-right">
                      <form class="navbar-form navbar-left" role="search" action="" method="get">
                                <div class="form-group">
                               
                                       
                                          
                                                            <div class="input-group col-md-12">
                                                                <input type="text" class="  search-query form-control" placeholder="Search" name="search"/>
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-info" type="submit">
                                                                        <span class=" glyphicon glyphicon-search"></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                  </div>
                                   
                        </form>
                    <li>
                        <a href="#"><?=$name;?></a>
                    </li>
                    <li>
                    <a class="item" href="#">
                         <?php
                                if(!isset($_SESSION['email'])){
                                        echo '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">Login</button>';
                                                               
                                    }else{
                                         echo'<form action="../function/login.php">
                                                <input class="btn btn-info btn-xs" type="submit" value="logout">
                                              </form>';
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
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>


<!-- Modal login-->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT USER  </h4>
      </div>
      
        
      
      <div class="modal-body col-sm-12">
                

  <form class="form-horizontal" role="form" action="up_user.php" method="post">
  <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-10">
        <?php
        if($_SESSION['email']){
           $rs =  mysql_query("SELECT * FROM tb_login");
           $row = mysql_fetch_assoc($rs);
        }else{
            header("Location: ../");
        } 
        

         ?>

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

        <button type="button" class="btn btn-default btn-danger" onclick="window.location.href='../'" data-dismiss="modal">close</button>
         <input type="hidden" name="oldemail" value="<?=$row['email'];?>">
        </span >
        <span class="col-sm-6 pull-left">
        <button type="submit" class="btn btn-default btn-primary">upadate</button>
            
      </span ></div>
      </form>
    </div>

  </div>
  <script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });
</script>
</body>

</html>
