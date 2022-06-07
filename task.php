<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$id = $_GET['id'];

$task = findTask($con, $id);
$user_data = userData($con);
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
                    <div class="task-wrapper">
                        <h1 class="data2-title"><?php echo $task['title']; ?></h1>
                        <p><?php echo $task['description']; ?></p>
                        <p><?php echo $task['content']; ?></p>
                        <p>Groups: <?php echo $task['groups']; ?></p>
                        <p>Added: <?php echo $task['date']; ?></p>
                    </div>
                    <?php
                    if(isset($_SESSION['user_id']) && $user_data['acces'] >= '1'){?>
                    <a href="edit_task.php?id=<?php echo $id; ?>" class="tsk"><i class="fa-solid fa-gear"></i></a>
                    <a href="delete_task.php?id=<?php echo $id; ?>" class="tsk"><i class="fa-solid fa-circle-minus"></i></a>
                    <a href="task_end.php?id=<?php echo $id; ?>" class="tsk"><i class="fa-solid fa-circle-check"></i></a>
                    <?php
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