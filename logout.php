<?php
session_start();

include("connection.php");

if(isset($_SESSION['user_id'])){
    $id = $_SESSION['user_id'];
    $logout = "UPDATE users SET logged='0' WHERE id='$id'";
    mysqli_query($con, $logout);
    unset($_SESSION['user_id']);
}

header("Location: login_page.php");
die;