<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);
$id = $_GET['id'];
$task = findTask($con, $id);

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
                    <p class="data2-title">manage <?php echo $task['title']; ?></p>
                    <form class="edit-usr2" action="edit_task_script.php?id=<?php echo $id; ?>" method="POST">
                        <label>Title:</label>
                        <input type="text" name="title" value=<?php echo $task['title']; ?>><br />
                        <label>Description:</label>
                        <input type="text" name="desc" value=<?php echo $task['description']; ?>><br />
                        <label>Content:</label>
                        <textarea rows="20" cols="52" type="text" name="content"><?php echo $task['content']; ?></textarea><br />
                        <label>Groups:</label>
                        <input type="text" name="group" value="<?php echo $task['groups']; ?>"><br />
                        <input class="save-btn" type="submit" value="Save">
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