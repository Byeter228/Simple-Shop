<?php
    require '../connection.php';
    session_start();
    $email=mysqli_real_escape_string($con,$_GET['email']);
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email)){
        echo "EMAIL_ERROR"; //Incorrect Email
        return;
    }
    $password=md5(md5(mysqli_real_escape_string($con,$_GET['password'])));
    $user_authentication_query="select id,email,perms from users where email='$email' and password='$password'";
    $user_authentication_result=mysqli_query($con,$user_authentication_query) or die(mysqli_error($con));
    $rows_fetched=mysqli_num_rows($user_authentication_result);
    if($rows_fetched==0){
        echo "PASS_ERROR"; //Incorrect Password
    }else{
        $row=mysqli_fetch_array($user_authentication_result);
        $_SESSION['email']=$email;
        $_SESSION['id']=$row['id'];  //user id
        if($row['perms'] == "ADMIN")
            echo "ADMIN"; //ADMIN PERMS
        else if($row['perms'] == "ACCOUNTANT")
            echo "ACCOUNTANT"; //ADMIN PERMS
        else if($row['perms'] == "MANAGER")
            echo "MANAGER"; //ADMIN PERMS
        else if($row['perms'] == "STOREKEEPER")
            echo "STOREKEEPER"; //ADMIN PERMS
        else
            echo "NULL";
    }
    
 ?>