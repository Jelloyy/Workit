<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$id = $_GET['id'];

$mail = findMail($con, $id);
$user_data = userData($con);
$query = "UPDATE mail SET seen='1'";
mysqli_query($con, $query);
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
                <section class="data2">
                <?php if($mail && $mail['send_to'] === $user_data['email']){?>
                    <div class="task-wrapper2">
                        <h1 class="data2-title"><?php echo $mail['title']; ?></h1>
                        <p>From: <?php echo $mail['send_from']; ?></p>
                        <p><?php echo $mail['message']; ?></p>
                        <p>Date: <?php echo $mail['sent_date']; ?></p>
                    </div>
                <?php
                }elseif(!$mail || $mail['send_to']!=$user_data['email']){
                    echo "Wrong adress";
                }?>
                </section>
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