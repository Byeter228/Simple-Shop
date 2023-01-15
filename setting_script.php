<?php
    session_start();
    require 'connection.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }  

    if (isset($_POST['submit'])) {
        $old_password= md5(md5(mysqli_real_escape_string($con,$_POST['oldPassword'])));
        $new_password= md5(md5(mysqli_real_escape_string($con,$_POST['newPassword'])));
        $email=$_SESSION['email'];
        //echo $email;
        $password_from_database_query="select password from users where email='$email'";
        $password_from_database_result=mysqli_query($con,$password_from_database_query) or die(mysqli_error($con));
        $row=mysqli_fetch_array($password_from_database_result);
        //echo $row['password'];
        if($row['password']==$old_password){
            $update_password_query="update users set password='$new_password' where email='$email'";
            $update_password_result=mysqli_query($con,$update_password_query) or die(mysqli_error($con));
            echo "Your password has been updated.";
            ?>
            <meta http-equiv="refresh" content="3;url=settings.php" />
            <?php
        }else{
            ?>
            <script>
                window.alert("Wrong password!!");
            </script>
            <meta http-equiv="refresh" content="1;url=settings_datachange.php" />
            <?php
            //header('location:settings.php');
        }
    }
    else if (isset($_POST['sumbit_profile'])) {
        $new_email = $_POST['email'];
        $email=$_SESSION['email'];

        
        $update_profile_query="update users set email='$new_email' where email='$email'";
        $update_profile_result=mysqli_query($con,$update_profile_query) or die(mysqli_error($con));
        echo "Your profile data has been updated.";

        $_SESSION['email']=$new_email;
        ?>
        <meta http-equiv="refresh" content="3;url=settings.php" />
        <?php
    }
    else if (isset($_POST['sumbit_address'])) {
        $new_city = $_POST['city'];
        $new_address = $_POST['address'];
        $email=$_SESSION['email'];
        
        $update_address_query="update users set city='$new_city', address='$new_address' where email='$email'";
        $update_address_result=mysqli_query($con,$update_address_query) or die(mysqli_error($con));
        echo "Your address data has been updated.";

        $_SESSION['city']=$new_city;
        $_SESSION['address']=$new_address;
        ?>
        <meta http-equiv="refresh" content="3;url=settings_address.php" />
        <?php
    }
    else if(isset($_POST['sumbit_profile_img']))
    {
        $path = 'img/';
        $uploadfile = $path . $_SESSION['nick'] . '.jpg';
        $size = 1024000;

        //Error
        if(!is_uploaded_file($_FILES['userfile']['tmp_name']))  
        {
            echo "Wrong upload to the server...";
            ?>
            <meta http-equiv="refresh" content="1;url=settings.php" />
            <?php
            die();
        } 

        //Check for image 
        if (!getimagesize($_FILES["userfile"]["tmp_name"])) {
            echo "Wrong upload [its not a photo]...";
            ?>
            <meta http-equiv="refresh" content="1;url=settings.php" />
            <?php
            die();
        }

        // Check file size
        if ($_FILES['userfile']['size'] > $size) {
	        ?>
            <script>
                window.alert("Wrong size (max: 10 mb)!!");
            </script>
            <meta http-equiv="refresh" content="1;url=settings.php" />
            <?php
            die();
        }

        //Check file exists
        if(file_exists($uploadfile)) 
        {         
            unlink($uploadfile);
        }

        if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
		    echo 'Wrong upload...';
	    else
		    echo 'Your img has been updated.';
        ?>
        <meta http-equiv="refresh" content="1;url=settings.php" />
        <?php
    }
?>