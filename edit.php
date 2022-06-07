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
            <?php if(isset($_SESSION['user_id']) && $user_data['acces'] === '2'){?>
                <section class="data2">
                    <p class="data2-title">manage <?php echo $user['name']." ".$user['surename']; ?></p>
                    <img class="usr-avatar" src="<?php echo $user['avatar']; ?>" alt=avatar>
                    <form class="edit-usr" action="edit_script.php?id=<?php echo $id;?>" method="POST">
                        <label>ID:</label>
                        <input type="text" name="id" value="<?php echo $id; ?>" disabled><br />
                        <label>Name:</label>
                        <input type="text" name="name" value="<?php echo $user['name']; ?>"><br />
                        <label>Surename:</label>
                        <input type="text" name="surename" value="<?php echo $user['surename']; ?>"><br />
                        <label>E-mail:</label>
                        <input type="text" name="email" value="<?php echo $user['email']; ?>"><br />
                        <label>Group:</label>
                        <input type="text" name="group" value="<?php echo $user['groups']; ?>"><br />
                        <label>Acces:</label>
                        <input type="text" name="acces" value="<?php echo $user['acces']; ?>"><br />
                        <label>Avatar:</label>
                        <input type="text" name="avatar"><br />
                        <input class="save-btn" type="submit" value="Save">
                    </form>
                    <p style="color: white; margin: 50px 50px;">Legend:<br /> Acces: 0 - user, 1 - Project manager, 2 - Administration</P>

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