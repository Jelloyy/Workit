<?php
session_start();

include("connection.php");
include("functions.php");

if(isset($_SESSION['user_id'])){

$user_data = userData($con);

$id = $_GET['id'];
$name = $_POST['name'];
$surename = $_POST['surename'];
$email = $_POST['email'];
$group = $_POST['group'];
$acces = $_POST['acces'];
$avatar = $_POST['avatar'];

if(isset($_SESSION['user_id']) && $user_data['acces'] === '2'){
    $query = "UPDATE users SET name='$name', surename='$surename', email='$email', acces='$acces', groups='$group', avatar='$avatar' WHERE id='$id'";
    $result = mysqli_query($con, $query);
    header("Location: edit.php?id=".$id);
    return $result;
}
die;
}else{
    header("Location: login_page.php");
}