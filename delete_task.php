<?php

include("connection.php");
include("functions.php");

session_start();

$user_data = userData($con);

if(isset($_SESSION['user_id']) && $user_data['acces'] >='1'){
    $id = $_GET['id'];

    $query = "DELETE FROM tasks WHERE id='$id'";

    $result = mysqli_query($con, $query);

    header("Location: tasks.php");
    return $result;
    die;
}else{
    header("Location: login_page.php");
}