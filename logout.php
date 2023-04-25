<?php
    require 'database_connect.php';

    session_start();
    
    $user_id = $_SESSION['user_id'];

    $user = mysqli_query($con, "UPDATE users SET token='' WHERE id='$user_id'");

    unset($_SESSION['token']);
    unset($_SESSION['user_id']);
    unset($_SESSION['role']);

    header('location: ./');
?>