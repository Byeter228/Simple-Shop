<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
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
        <link rel="stylesheet" href="css/style_settings.css" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body>
        <div>
            <?php
                require 'header.php';
            ?>
            <br>
<div class="container">
    <div class="view-account">
        <section class="module">
            <div class="module-inner">
                <div class="side-bar">
                    <div class="user-info">
                         <?php
                            $filename = 'img/' . $_SESSION['nick'] . '.jpg';

                            if(file_exists($filename)) 
                            {         
                                $img_file = "img_read.php?src=" . $filename;
                            }
                            else {
                                $img_file = "img_read.php?src=" . "img/default_img.png";
                            }
                            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
                        ?>
                        <img class="img-profile img-circle img-responsive center-block" src="<?=$img_file?>" alt="">
                        <ul class="meta list list-unstyled">
                            <li class="name"><?=$_SESSION['nick']?>
                            <br>
                                <?php 
                                    if($_SESSION['perms'] == "")
                                    {
                                    ?>
                                        <label class="label label-info">Client</label>
                                    <?php 
                                    }
                                    else
                                    {
                                    ?>
                                        <label class="label label-info"><?=$_SESSION['perms']?></label>
                                      <?php 
                                    }
                                ?>
                            </li>
                            <li class="email"><a href="#"><?=$_SESSION['email']?></a></li>
                            <li class="activity">Last logged in: <?=$_SESSION['last_login_time']?></li>
                        </ul>
                    </div>
            		<nav class="side-menu">
        				<ul class="nav">
        					<li><a href="settings.php"><span class="fa fa-user"></span> Profile</a></li>
        					<li class="active"><a href="settings_datachange.php"><span class="fa fa-cog"></span> Settings</a></li>
        					<li><a href="settings_address.php"><span class="fa fa-envelope"></span> Address</a></li>
        					
        					<li><a href="#"><span class="fa fa-th"></span> Others</a></li>
        				</ul>
        			</nav>
                </div>
                <div class="content-panel">
                    <h2 class="title">Settings<span class="pro-label label label-warning">PRO</span></h2>
                    <form class="form-horizontal" method="post" action="setting_script.php">
                        <fieldset class="fieldset">
                            <h3 class="fieldset-title">Change password</h3>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Old password</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control" name="oldPassword">
                                    <p class="help-block">This is the old password </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">New password</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control" name="newPassword">
                                    <p class="help-block">This is the new password </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2  col-sm-3 col-xs-12 control-label">Re-type new password</label>
                                <div class="col-md-10 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control" name="retype">
                                    <p class="help-block">This is the re-type new password </p>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-10 col-sm-9 col-xs-12 col-md-push-2 col-sm-push-3 col-xs-push-0">
                                <input class="btn btn-primary" type="submit" name="submit" value="Update password">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
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
