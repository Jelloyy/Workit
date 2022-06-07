<?php

session_start();

include("head.php");
include("connection.php");
include("functions.php");

$sendID = 0;

if(isset($_GET['id'])){
    $sendID = $_GET['id'];
}

$user_data = userData($con);
$sendTo = findUser($con, $sendID);

if($sendTo){
    $usr_mailbox = $sendTo['email'];
}else{
    $usr_mailbox = "";
}

if($_SERVER['REQUEST_METHOD']== "POST"){
    if(isset($_SESSION['user_id'])){
        $send_to = $_POST['send_to'];
        $title = $_POST['title'];
        $message = $_POST['message'];
        $date = date("Y-m-d H:i:s");
        $send_from = $user_data['email'];

        if(!empty($send_to) && !empty($title) && !empty($message) && isset($_SESSION['user_id']))
        {
            $query = "INSERT INTO mail (send_from, send_to, title, message, sent_date, seen) VALUES ('$send_from', '$send_to', '$title', '$message', '$date', '0')";

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
<?php if(isset($_SESSION['user_id'])){?>
    <div class="wrapper">
        <?php include("header.php"); ?>
        <div class="front-page">
            <div class="left-sidebar">
                <?php include("menu.php"); ?>
            </div>
            <div class="section">
            <?php if(isset($_SESSION['user_id'])){?>
                <section class="data2">
                    <p class="data2-title">Send mail</p>
                    <form class="edit-usr2" action="send_mail.php" method="POST">
                        <label>To:</label>
                        <input type="text" name="send_to" value="<?php 
                        if($sendTo!=NULL){
                        echo $usr_mailbox;}else{echo "";} ?>"><br />
                        <label>Title:</label>
                        <input type="text" name="title"><br />
                        <label>Message:</label>
                        <textarea class="message-form" type="text" name="message"></textarea><br />
                        <input class="save-btn" type="submit" value="Send">
                    </form>

                </section>
                <?php
                }?>
            </div>
        </div>
        <footer>
            <p>Work.it 2022</p>
        </footer>
    </div>
    <?php
    }else{
        header("Location: login_page.php");
    }?>
</body>
</html>