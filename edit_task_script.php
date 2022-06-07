<?php
session_start();

include("connection.php");
include("functions.php");

if(isset($_SESSION['user_id'])){

    $user_data = userData($con);

    $id = $_GET['id'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $content = $_POST['content'];
    $group = $_POST['group'];

    if(isset($_SESSION['user_id']) && $user_data['acces'] === '2'){
        $query = "UPDATE tasks SET title='$title', description='$desc', content='$content', groups='$group' WHERE id='$id'";
        $result = mysqli_query($con, $query);
        header("Location: task.php?id=".$id);
        return $result;
    }
    die;
}else{
    header("Location: login_page.php");
}