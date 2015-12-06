<?php 
session_start();
if($_SESSION['permision']!=2){
	header("Location: ../");
}
$cout_shop = isset($_SESSION['cout_shop'])?$_SESSION['cout_shop']:'0';
$name = isset($_SESSION['name'])?$_SESSION['name']:'';
$_SESSION['permision']=isset($_SESSION['permision'])?$_SESSION['permision']:'0';
include '../function/dbconn.php';
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
                <a class="navbar-brand" href="../">Znim shop</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="#">About</a>
                    </li>
                    
                    <li>
                        <a href="../show.php">Contact</a>
                    </li>
                    <?php  

                    if($_SESSION['permision']==2){?>
                    <li>
                        <a href="#">Admin</a>
                    </li>
                    <?php } ?>
                    
                </ul>   
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../user/update_user.php"><?=$name;?></a>
                    </li>
                    <li>
                    <a class="item" href="#">
                         <?php
                                if(!isset($_SESSION['email'])){
                                        echo '<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">Login</button>';
                                                               
                                    }else{
                                         echo'<form action="#">
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

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-2">
                <p class="lead"></p>
                <div class="list-group">
                
                </div>
            </div>

            <div class="col-md-9">

            

                <div class="row">

                   <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#myModal">show</button>
                    <button type="button" class="btn btn-default btn-lg btn-block" data-toggle="modal" data-target="#add">add</button>
                   
                    

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



<!-- Modal show-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
        </div>
        <div class="modal-body">
					        <div class="table-responsive">          
					  <table class="table">
					    <thead>
					      <tr>
					        <th>#</th>
					        <th>name</th>
					        <th>description</th>
					        <th>Money</th>
					        <th>reviews</th>
					        <th>EDIT</th>
					      </tr>
					    </thead>

					    <tbody>
					    <?php
					    	$query = "SELECT * FROM tb_yar";
					    	if(isset($_GET['search'])){
                        		$search = $_GET['search'];
                        			$query .= " WHERE name_yar LIKE '%$search%'";
                    			}
					    	//echo "$query";
					    	$result = mysql_query($query);	
					    	while ($row = mysql_fetch_assoc($result)) {
					    	
					     ?>
					      <tr>
					        <td><?=$row['id_yar'];?></td>
					        <td><?=$row['name_yar'];?></td>
					        <td><?=$row['description_yar'];?></td>
					        <td><?=$row['money_yar'];?></td>
					        <td><?=$row['reviews_yar'];?></td>
					        <td><a>EDIT</a></td>
					      </tr>
					      <?php } ?>
					    </tbody>
					  </table>
					  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>



<!-- Login FROM -->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="add" role="dialog">
    <div class="modal-dialog">
     <form class="form-horizontal" role="form" action="../img/upload_data.php" method="post" enctype="multipart/form-data">
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
                                                            <label class="control-label col-sm-2" for="pwd">money:</label>
                                                            <div class="col-sm-10">          
                                                            <select name="category" >
                                                                <option value="drug"></option>
                                                                <option value="water"></option>
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






<?php if(isset($_GET['search'])){ ?>
	<script type="text/javascript">
    $(window).load(function(){
        $('#myModal').modal('show');
    });
</script>
<?php } ?>




</body>

</html>