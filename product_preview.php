<?php
    require 'connection.php';
    session_start();
    $item_id=$_GET['id'];
    $products_query="select * from items where id='$item_id'";
    $products_result=mysqli_query($con,$products_query) or die(mysqli_error($con));
    require 'check_if_added.php';
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/logo.gif" />
        <title>KZGT Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <br>
            <div class="container">
            <div class="thumbnail">
                <?php                    
                    while($item=mysqli_fetch_array($products_result)){
                        if(empty($item['description']) || is_null($item['description'])) {
                            $description = "No description added for this product...";
                        }
                        else {
                            $description = $item['description'];
                        }
                ?>
                <!-- product -->
                <div class="product-content product-wrap clearfix product-deatil">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="product-image">
                                <div id="myCarousel-2" class="carousel slide">
                                    <ol class="carousel-indicators">
                                        <li data-target="#myCarousel-2" data-slide-to="0" class=""></li>
                                        <li data-target="#myCarousel-2" data-slide-to="1" class="active"></li>
                                        <li data-target="#myCarousel-2" data-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <!-- Slide 1 -->
                                        <div class="item">
                                            <img src=<?php echo $item['url']?> class="img-responsive" alt="" />
                                        </div>
                                            <!-- Slide 2 -->
                                        <div class="item active">
                                            <img src=<?php echo $item['url']?> class="img-responsive" alt="" />
                                        </div>
                                        <!-- Slide 3 -->
                                        <div class="item">
                                            <img src=<?php echo $item['url']?> class="img-responsive" alt="" />
                                        </div>
                                    </div>
                                    <a class="left carousel-control" href="#myCarousel-2" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a>
                                    <a class="right carousel-control" href="#myCarousel-2" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                            <h2 class="name">
                                <?=$item['name']?>
                                <small>Product by KZGT Store</small>
                            </h2>
                            <hr />
                            <h3 class="price-container">
                                <?=$item['price']?>.00 rub
                                <small>*includes delivery</small>
                            </h3>
                            <div class="certified">
                                <ul>
                                    <li>
                                        <a href="javascript:void(0);">Delivery time: <span>7 Working Days</span></a>
                                    </li>
                                </ul>
                            </div>
                            <hr />
                            <div class="description description-tabs">
                                <ul id="myTab" class="nav nav-pills">
                                    <li class="active"><a href="#more-information" data-toggle="tab" class="no-margin">Product Description </a></li>
                                    <li class=""><a href="#specifications" data-toggle="tab">Specifications</a></li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div class="tab-pane fade active in" id="more-information">
                                        <br />
                                        <strong>Description:</strong>
                                        <p>
                                            <?=$description?>
                                        </p>
                                    </div>
                                    <div class="tab-pane fade" id="specifications">
                                        <br />
                                        <dl class="">
                                            <dt>Title</dt>
                                            <dd>Some text...</dd>                                
                                            <br />
                                            <!--
                                            <dt>Test lists</dt>
                                            <dd>A description list is perfect for defining terms.</dd>
                                            <br />

                                            <dt>Altra porta</dt>
                                            <dd>Vestibulum id ligula porta felis euismod semper</dd>
                                            -->
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                      <?php if(!isset($_SESSION['email'])){  ?>
                                        <p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                        <?php
                                        }
                                        else {
                                            if(check_if_added_to_cart($item['id'])){
                                                echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
                                            }else{
                                                ?>
                                                <a href="cart_add.php?id=<?=$item['id']?>" class="btn btn-success btn-block">Add to cart (<?=$item['price']?>.00 rub)</a>
                                                <?php
                                            }
                                        }
                                        ?>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="btn-group pull-right">
                                        <a href="tel:+79858954149"><button class="btn btn-white btn-default"><i class="fa fa-envelope"></i> Contact Seller</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end product -->
                <?php } ?>
            </div>
            </div>
        </div>
        <br><br><br><br><br>
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
