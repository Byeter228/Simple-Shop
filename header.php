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
                            <form class="form-inline" action="search_product.php">
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
                                        <li><a href="admin/users/index.php">Users <span class="glyphicon glyphicon-user"></span></a></li>
                                        <li><a href="admin/products/index.php">Products <span class="glyphicon glyphicon-apple"></span></a></li>
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
                                    require 'connection.php';
                            
                                    $category_query="select distinct category from items";
                                    $category_result=mysqli_query($con,$category_query) or die(mysqli_error($con));
                                    $no_category=mysqli_num_rows($category_result);
                                    if($no_category<=1)
                                    {
                                        ?>
                                        <li><a href="products.php">All products <span class="glyphicon glyphicon-th"></span></a></li>
                                        <?php
                                    }
                                    else
                                    {
                                          while($item=mysqli_fetch_array($category_result)){
                                            if(!empty($item['category']) && $item['category'] != "ADS")
                                            {
                                            ?> 
                                                <li><a href="category_product.php?category=<?=$item['category']?>"><?=$item['category']?></a></li>
                                            <?php
                                            }
                                          }
                                          ?>
                                          <li role="separator" class="divider"></li>
                                          <li><a href="products.php">All product's <span class="glyphicon glyphicon-th"></span></a></li>
                                          <?php
                                    }
                                    ?>
                                <!--
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                                -->
                            </ul>
                           </li>
                           <!--<li><a href="products.php"><span class="glyphicon glyphicon-list"></span> Products</a></li>-->
                           <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                           <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a></li>
                           <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                           <?php
                           }else{
                            ?>
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list"></span> Products <span class="caret"></span></a>
                             <ul class="dropdown-menu">
                                 <?php
                                    require 'connection.php';
                            
                                    $category_query="select distinct category from items";
                                    $category_result=mysqli_query($con,$category_query) or die(mysqli_error($con));
                                    $no_category=mysqli_num_rows($category_result);
                                    if($no_category<=1)
                                    {
                                        ?>
                                        <li><a href="products.php">All products <span class="glyphicon glyphicon-th"></span></a></li>
                                        <?php
                                    }
                                    else
                                    {
                                          while($item=mysqli_fetch_array($category_result)){
                                            if(!empty($item['category']) && $item['category'] != "ADS")
                                            {
                                            ?> 
                                                <li><a href="category_product.php?category=<?=$item['category']?>"><?=$item['category']?></a></li>
                                            <?php
                                            }
                                          }
                                          ?>
                                          <li role="separator" class="divider"></li>
                                          <li><a href="products.php">All product's <span class="glyphicon glyphicon-th"></span></a></li>
                                          <?php
                                    }
                                    ?>
                                <!--
                                <li role="separator" class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                                -->
                            </ul>
                           </li>
                           <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                           <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                           <?php
                           }
                           ?>
                           
                       </ul>
                   </div>
               </div>
</nav>
