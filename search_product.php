<?php
    session_start();
    require 'connection.php';
    $item_name=$_GET['itemname'];
    $products_query="select * from items where name LIKE '%$item_name%'";
    $products_result=mysqli_query($con,$products_query) or die(mysqli_error($con));
    $no_products=mysqli_num_rows($products_result);
    if($no_products==0)
    {
        ?>
        <script>
        window.alert("There are no products with this name...");
        </script>
        <?php
    }
    require 'check_if_added.php';
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
            <div class="container">
                <div class="jumbotron">
                    <h1>Welcome to our KZGT Store!</h1>
                    <p>More comments.</p>
                </div>
            </div>
            <div class="container">
            <?php
            $numOfCols = 4;
            $rowCount = 0;                      
                while($item=mysqli_fetch_array($products_result)){
            ?>
            <?php 
            $rowCount++;
            if ($rowCount % $numOfCols == 0) {?>
                <div class="row">
            <?php
            }
            ?>
                <div class="col-md-3 col-sm-6">
                    <div class="thumbnail">
                            <a href="product_preview.php?id=<?=$item['id']?>">
                                <img src=<?php echo $item['url']?> alt=<?php echo $item['url']?>>
                            </a>
                            <center>
                                <div class="caption">
                                    <h3><?=$item['name']?></h3>
                                    <p>Price: <?=$item['price']?>.00 rub</p>
                                    <?php if(!isset($_SESSION['email'])){  ?>
                                        <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                        <?php
                                        }
                                        else{
                                            if(check_if_added_to_cart($item['id'])){
                                                echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
                                            }else{
                                                ?>
                                                <a href="cart_add.php?id=<?=$item['id']?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                <?php
                                            }
                                        }
                                    ?>
                            </div>
                        </center>
                    </div>
                </div>

            <?php if ($rowCount % $numOfCols == 0) {?>
                </div>           
            <?php
            }
            ?>

            <?php } ?>
            </div>
            <br><br><br><br><br><br><br><br>
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
