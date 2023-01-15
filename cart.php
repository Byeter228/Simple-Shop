<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location: login.php');
    }
    $user_id=$_SESSION['id'];
    $user_products_query="select it.id,it.name,it.price,it.url,it.description,ut.amount from users_items ut inner join items it on it.id=ut.item_id where ut.user_id='$user_id'";
    $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
    $no_of_user_products= mysqli_num_rows($user_products_result);
    $sum=0;
    if($no_of_user_products==0){
        //echo "Add items to cart first.";
    ?>
        <script>
        window.alert("No items in the cart!!");
        </script>
    <?php
    }else{
        while($row=mysqli_fetch_array($user_products_result)){
            $sum=$sum+($row['price'] * $row['amount']); 
       }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/logo.gif" />
        <title>KZGT Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <!-- jquery library -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <!-- Latest compiled and minified javascript -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <!-- External CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php 
               require 'header.php';
            ?>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="products.php">
                                                <button type="button" class="btn btn-primary btn-sm btn-block">
                                                    <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <?php 
                                    $user_products_result=mysqli_query($con,$user_products_query) or die(mysqli_error($con));
                                    $no_of_user_products= mysqli_num_rows($user_products_result);
                                    $counter=1;
                                while($row=mysqli_fetch_array($user_products_result)){
                                    
                                    ?>
                                <div class="row">
                                    <div class="col-xs-2">
                                        <a href="product_preview.php?id=<?=$row['id']?>">
                                            <img class="img-responsive" src="<?=$row['url']?>">
                                        </a>
                                    </div>
                                    <div class="col-xs-4">
                                        <h4 class="product-name">
                                            <a href="product_preview.php?id=<?=$row['id']?>">
                                                <strong>
                                                    <?php echo $row['name']?>
                                                </strong>
                                            </a>
                                        </h4>
                                        <h4>
                                            <small>
                                                <?php echo mb_strimwidth($row['description'],0, 250, "...")?>
                                            </small>
                                        </h4>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="col-xs-6 text-right">
                                            <h6><strong><?php echo $row['price']?> rub <span class="text-muted">x</span></strong></h6>
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control form-control-sm" type="number" value="<?=$row['amount']?>" onchange="window.location.replace('cart_edit_amount.php?id=<?=$row['id']?>&amount='+ this.value)">
                                        </div>
                                        <div class="col-xs-2">
                                            <a href="cart_remove.php?id=<?php echo $row['id'] ?>">
                                                <button type="button" class="btn btn-link btn-xs">
                                                    <span class="glyphicon glyphicon-trash"> </span>
                                                </button>
                                            </a>    
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <?php $counter=$counter+1;}?>

                                <div class="row">
                                    <div class="text-center">
                                        <div class="col-xs-9">
                                            <h6 class="text-right">Added items?</h6>
                                        </div>
                                        <div class="col-xs-3">
                                            <a href="#" onClick="window.location.reload( true );">
                                                <button type="button" class="btn btn-default btn-sm btn-block">
                                                    Update cart
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row text-center">
                                    <div class="col-xs-9">
                                        <h4 class="text-right">Total <strong><?php echo $sum;?> rub</strong></h4>
                                    </div>
                                    <div class="col-xs-3">
                                        <a href="success.php?id=<?php echo $user_id?>">
                                            <button type="button" class="btn btn-success btn-block">
                                                Checkout
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br><br><br><br>
            <footer class="footer">
               <div class="container">
               <center>
                   <p>Contact Us: +7 985 895-41-49</p>
               </center>
               </div>
           </footer>
        </div>
    </body>
</html>
