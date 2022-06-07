<?php

session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);

if($_SERVER['REQUEST_METHOD']== "POST"){
    if(isset($_SESSION['user_id']) && $user_data['acces'] >= '1'){
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $content = $_POST['content'];
        $group = $_POST['group'];
        $date = date("Y-m-d H:i:s");

        if(!empty($title) && !empty($desc) && !empty($content) && !empty($group))
        {
            $query = "INSERT INTO tasks (groups,title,description,content,date,ended) VALUES ('$group','$title','$desc','$content','$date','0')";

            mysqli_query($con, $query);
            header("Location: tasks.php");
            die;
        }else{
            echo "Fill all required fields...<br />";
        }
    }
}
?>

<body>
<?php if(isset($_SESSION['user_id']) && $user_data['acces'] >= '1'){?>
    <div class="wrapper">
        <?php include("header.php"); ?>
        <div class="front-page">
            <div class="left-sidebar">
                <?php include("menu.php"); ?>
            </div>
            <div class="section">
                <section class="data2">
                    <p class="data2-title">Add new task</p>
                    <form class="edit-usr2" action="add_task.php" method="POST">
                        <label>Title:</label>
                        <input type="text" name="title"><br />
                        <label>Description:</label>
                        <input type="text" name="desc"><br />
                        <label>Content:</label>
                        <textarea type="text" name="content"></textarea><br />
                        <label>Groups:</label>
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