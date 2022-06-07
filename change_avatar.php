<?php
session_start();

include("connection.php");
include("functions.php");

$id = $_GET['id'];
$user_data = userData($con);
$findUser = findUser($con, $id);

if(isset($_SESSION['user_id'])){
    if($id===$user_data['id']){

        $avatar = $_POST['usr_avt'];

        if(isset($_SESSION['user_id'])){
            $query = "UPDATE users SET avatar='$avatar' WHERE id='$id'";
            $result = mysqli_query($con, $query);
            header("Location: user.php?id=".$id);
            return $result;
        }
        die;

    }else{
        header("Location: user.php?id=".$id);
    }
}else{
    echo "Login first";
    header("Location: login_page.php");
}