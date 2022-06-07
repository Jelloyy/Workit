<?php
session_start();
include("connection.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = $_POST['login'];
    $pass = $_POST['pass'];
    
    if(!empty($login) && !empty($pass)){

        $query = "SELECT * FROM users WHERE email = '$login' limit 1";
        $result = mysqli_query($con, $query);

        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['pass'] === $pass){
                    $_SESSION['user_id'] = $user_data['id'];
                    $id = $user_data['id'];
                    $date = date("Y-m-d H:i:s");
                    $loggedIn = "UPDATE users SET logged='1', last_seen='$date' WHERE id='$id'"; 
                    mysqli_query($con, $loggedIn);
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "Wrong username or password";
        header("Location: login_page.php");
    }
    echo "Please fill all required fields";
    header("Location: login_page.php");
}