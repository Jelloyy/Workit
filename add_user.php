<?php

session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);

if($_SERVER['REQUEST_METHOD']== "POST"){
    if(isset($_SESSION['user_id']) && $user_data['acces'] === '2'){
        $name = $_POST['name'];
        $surename = $_POST['surename'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $group = $_POST['group'];
        $date = date("Y-m-d");
        $date_seen = date("Y-m-d H:i:s");

        // DO NAPRAWY - TUTAJ NIE DZIAŁA VVVVVVVV
        if(!empty($name) && !empty($surename) && !empty($pass) && !empty($email) && !empty($group))
        {
            $query = "INSERT INTO users (name,surename,pass,email,groups,logged,acces,avatar,date_join,last_seen) VALUES ('$name','$surename','$pass','$email','$group','0','0','css/images/user.png','$date','$date_seen')";

            mysqli_query($con, $query);
            header("Location: index.php");
            die;
        }else{
            echo "Fill all required fields...<br />";
        }
    }
}
?>

<body>
<?php if(isset($_SESSION['user_id']) && $user_data['acces'] === '2'){?>
    <div class="wrapper">
        <?php include("header.php"); ?>
        <div class="front-page">
            <div class="left-sidebar">
                <?php include("menu.php"); ?>
            </div>
            <div class="section">
                <section class="data2">
                    <p class="data2-title">Add new user</p>
                    <form class="edit-usr" action="add_user.php" method="POST">
                        <label>Name:</label>
                        <input type="text" name="name"><br />
                        <label>Surename:</label>
                        <input type="text" name="surename"><br />
                        <label>Password:</label>
                        <input type="password" name="pass"><br />
                        <label>E-mail:</label>
                        <input type="text" name="email"><br />
                        <label>Group:</label>
                        <input type="text" name="group"><br />
                        <input class="save-btn" type="submit" value="Add">
                    </form>

                </section>
            </div>
        </div>
        <footer>
            <p>Work.it 2022</p>
        </footer>
    </div>
    <?php
    }else{
        echo "login first";
        header("Location: login_page.php");
    }?>
</body>
</html>