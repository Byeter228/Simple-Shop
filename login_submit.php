<?php
    require 'connection.php';
    session_start();
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email)){
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }
    $password=md5(md5(mysqli_real_escape_string($con,$_POST['password'])));
    if(strlen($password)<6){
        echo "Password should have atleast 6 characters. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=login.php" />
        <?php
    }
    $user_authentication_query="select id,email,perms,name,city,address,last_login from users where email='$email' and password='$password'";
    $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($user_authentication_result);
    if($rows_fetched==0){
        //no user
        //redirecting to same login page
        ?>
        <script>
            window.alert("Wrong username or password");
        </script>
        <meta http-equiv="refresh" content="1;url=login.php" />
        <?php
        //header('location: login');
        //echo "Wrong email or password.";
    }else{
        $row=mysqli_fetch_array($user_authentication_result);
        $_SESSION['email']=$email;
        $_SESSION['perms']=$row['perms'];
        $_SESSION['nick']=$row['name'];
        $_SESSION['id']=$row['id'];  //user id
        $_SESSION['city']=$row['city'];
        $_SESSION['address']=$row['address'];
        $username = $row['name'];
        $date = date('m/d/y - h:i A');
        $logintime = "UPDATE users SET last_login = '$date' where name = '$username'";
        mysqli_query($con, $logintime);
        $user_time_query="select id, last_login from users where email='$email' and password='$password'";
        $user_time_result=mysqli_query($con,$user_time_query) or die(mysqli_error($con));
        $row=mysqli_fetch_array($user_time_result);
        
        $_SESSION['last_login_time']=$row['last_login'];

        header('location: products.php');
    }
    
 ?>