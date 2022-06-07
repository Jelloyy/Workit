<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);
$id = $_GET['id'];

$user = findUser($con, $id);
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
                    <div class="usr-wrapper">
                        <h1 class="data2-title"><?php echo $user['name']." ".$user['surename']; ?></h1>
                        <img class="usr-avatar" src="<?php echo $user['avatar']; ?>" alt=avatar>
                        <p>adress e-mail: <span><?php echo $user['email']; ?></span></p>
                        <p>group: <span><?php echo $user['groups']; ?></span></p>
                        <p>joined us: <span><?php echo $user['date_join']; ?></span></p>
                        <p>last seen: <span><?php echo $user['last_seen']; ?></span></p>
                        <?php if($id!=$user_data['id']){?>
                            <p>send message: <a class="send" href="send_mail.php?id=<?php echo $user['id']; ?>"><i class="fa-solid fa-envelope"></i></a></p>
                        <?php
                        }elseif($id===$user_data['id']){?>
                            <form class="change-avt" action="change_avatar.php?id=<?php echo $id;?>" method="post">
                                <label>Your avatar:</label><br />
                                <input type="text" name="usr_avt"><br />
                                <input type="submit" value="change">
                            </form>
                        <?php
                        }?>
                    </div>
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