<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="img/logo.gif" />
        <title>KZGT Store</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"> <!-- bootstrap css -->
        <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script> <!-- jquery lib -->
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> <!-- bootstrap -->
        <link rel="stylesheet" href="css/style.css" type="text/css"> <!-- Custom CSS -->
    </head>
    <body>
        <div>
           <?php
            require 'header.php';
           ?>
           <div id="bannerImage">
               <div class="container">
                   <center>
                   <div id="bannerContent">
                       <h1>KZGT be like</h1>
                       <p>He likes us.</p>
                       <a href="products.php" class="btn btn-danger">Shop Now</a>
                   </div>
                   </center>
               </div>
           </div>

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