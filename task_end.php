<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = userData($con);
$id = $_GET['id'];

if(isset($_SESSION['user_id']) && $user_data['acces'] >='1'){
    $query = "UPDATE tasks SET ended='1' WHERE id='$id'";
    mysqli_query($con, $query);
    header("Location: tasks.php");
    die;
}
