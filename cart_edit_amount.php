<?php
    require 'connection.php';
    //require 'header.php';
    session_start();
    
    $item_id=$_GET['id'];
    $item_amount=$_GET['amount'];
    if($_GET['amount'] <= 0)
    {
        $user_id=$_SESSION['id'];
        $delete_query="delete from users_items where user_id='$user_id' and item_id='$item_id'";
        $delete_query_result=mysqli_query($con,$delete_query) or die(mysqli_error($con));
        header('location: cart.php');
    }
    else
    {
        $edit_cart_query="update users_items set amount='$item_amount' where item_id='$item_id'";
        $edit_cart_result=mysqli_query($con,$edit_cart_query) or die(mysqli_error($con));
        header('location: cart.php');
    }
?>