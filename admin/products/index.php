<?php
    session_start();
    include 'func.php';
    
    if(!isset($_SESSION['email'])){ 
        header("Location: https://kazuma.host/login.php");
        exit( );
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../../img/logo.gif" />
	<title>KZGT ADMIN - Products</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" type="text/css"> <!-- bootstrap css -->
    <script type="text/javascript" src="../../bootstrap/js/jquery-3.2.1.min.js"></script> <!-- jquery lib -->
    <script type="text/javascript" src="../../bootstrap/js/bootstrap.min.js"></script> <!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
</head>
<body>
    <?php 
    if($_SESSION['perms'] != "ADMIN") {
        ?>
        <script>
            window.alert("U not a admin!");
            window.location.replace("https://kazuma.host/");
        </script>
        <?php
            exit( );
        }
    ?>
    
    <nav class="navbar navbar-inverse navabar-fixed-top">
               <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a href="https://kazuma.host/index.php" class="navbar-brand">KZGT Store</a>
                   </div>
                   
                   <div class="collapse navbar-collapse" id="myNavbar">
                       <ul class="nav navbar-nav navbar-right">
                            <li>
                            <p>
                            <form class="form-inline" action="../../search_product.php">
                                <input class="form-control" style="height: 30px;" type="search" name="itemname" placeholder="Search" aria-label="Search">
                            </form>
                            </p>
                            </li>
                           <?php
                           if(isset($_SESSION['email'])){
                                   if($_SESSION['perms'] == "ADMIN") {
                           ?>
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-dashboard"></span> Admin <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="../users/index.php">Users <span class="glyphicon glyphicon-user"></span></a></li>
                                        <li><a href="index.php">Products <span class="glyphicon glyphicon-apple"></span></a></li>
                                        <!--
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                        -->
                                    </ul>
                                </li>
                            <?}?>
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list"></span> Products <span class="caret"></span></a>
                             <ul class="dropdown-menu">
                                 <?php
                                    require '../../connection.php';
                            
                                    $category_query="select distinct category from items";
                                    $category_result=mysqli_query($con,$category_query) or die(mysqli_error($con));
                                    $no_category=mysqli_num_rows($category_result);
                                    if($no_category<=1)
                                    {
                                        ?>
                                        <li><a href="../../products.php">All products <span class="glyphicon glyphicon-th"></span></a></li>
                                        <?php
                                    }
                                    else
                                    {
                                          while($item=mysqli_fetch_array($category_result)){
                                            if(!empty($item['category']) && $item['category'] != "ADS")
                                            {
                                            ?> 
                                                <li><a href="../../category_product.php?category=<?=$item['category']?>"><?=$item['category']?></a></li>
                                            <?php
                                            }
                                          }
                                          ?>
                                          <li role="separator" class="divider"></li>
                                          <li><a href="../../products.php">All product's <span class="glyphicon glyphicon-th"></span></a></li>
                                          <?php
                                    }
                                    ?>
                                <!--
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                                -->
                            </ul>
                           </li>
                           <li><a href="../../cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                           <li><a href="../../settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                           <li><a href="../../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                           <?php
                           }
                            ?>
                       </ul>
                   </div>
               </div>
    </nav>

	<div class="container well">
		<div class="row">
			<div class="col mt-1">
				<?=$success ?>
				<button class="btn btn-success mb-1" data-toggle="modal" data-target="#Modal"><i class="fa fa-user-plus"></i></button>
				<table class="table shadow ">
					<thead class="thead-dark">
						<tr>
							<th>№</th>
							<th>Название</th>
							<th>Цена</th>
							<th>Изображение (Ссылка)</th>
							<th>Категория</th>
							<th>Описание</th>
							<th>Действие</th>
						</tr>
						<?php foreach ($result as $value) { ?>
						<tr>
							<td><?=$value['id'] ?></td>
							<td><?=$value['name'] ?></td>
							<td><?=$value['price'] ?> р</td>
							<td><?=mb_strimwidth($value['url'],0, 40, "...") ?></td>
                            <td><?=$value['category'] ?></td>
                            <td><?=mb_strimwidth($value['description'],0, 45, "...") ?></td>
							<td>
								<a class="btn btn-success btn-sm" data-toggle="modal" data-target="#editModal<?=$value['id'] ?>"><i class="fa fa-edit"></i></a> 
								<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?=$value['id'] ?>"><i class="fa fa-trash"></i></a>
								<?php require 'modal.php'; ?>
							</td>
						</tr> <?php } ?>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="Modal">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content shadow">
	      <div class="modal-header">
	        <h5 class="modal-title">Добавить товар</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form action="" method="post">
	        	<div class="form-group">
	        		<input type="text" class="form-control" name="name" value="" placeholder="Название">
	        	</div>
				<div class="form-group">
	        		<input type="text" class="form-control" name="price" value="" placeholder="Цена">
	        	</div>
	        	<div class="form-group">
	        		<input type="text" class="form-control" name="url" value="" placeholder="Ссылка на изображение">
	        	</div>
                <div class="form-group">
	        		<input type="text" class="form-control" name="category" value="" placeholder="Категория">
	        	</div>
	        	<div class="form-group">
        		    <textarea class="form-control" rows="3" name="description" placeholder="Описание" style="resize: vertical;"></textarea>
        	    </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
	        <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
	      </div>
	  		</form>
	    </div>
	  </div>
	</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
</body>
</html>