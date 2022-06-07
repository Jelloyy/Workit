<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);

$resultPerPage = 2;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$startFrom = ($page-1) * $resultPerPage;

$query = "SELECT * FROM tasks ORDER BY ID DESC LIMIT $startFrom, ".$resultPerPage;
$result = mysqli_query($con, $query);

$query2 = "SELECT COUNT(ID) AS total FROM tasks";
$result2 = mysqli_query($con, $query2);
$site = mysqli_fetch_assoc($result2);
$total_pages = ceil($site['total'] / $resultPerPage);
    
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
                    <p class="data2-title">Your tasks</p>
                    <?php if(isset($_SESSION['user_id']) && $user_data['acces']>='1'){?>
                        <a href="add_task.php" class="mng-add"><i class="fa-solid fa-plus"></i></a>
                    <?php
                    }?>
                    <div class="task-wrapper2">
                    <?php
                    while($task = mysqli_fetch_assoc($result)){
                        if(($task['groups']===$user_data['groups']) || $user_data['acces']>='1'){?>
                    
                        <a style="
                        <?php if($task['ended']==='1'){
                            echo 'background-color: rgb(0, 141, 7);';
                        }else{
                            echo 'background-color: rgb(67, 58, 82);';
                        }?>"

                        class="task" href="task.php?id=<?php echo $task['id']; ?>">
                            <h1><?php echo $task['title']; ?></h1>
                            <h2><?php echo $task['description'];?></h2>
                            <p>Groups: <?php echo $task['groups']; ?> </p>
                            <p>Date: <?php echo $task['date']; ?></p>
                            <?php
                            if($task['ended']==='1'){?>
                            <p>Status: finished</p>
                            <?php
                            }?>
                        </a><br />
                        <?php
                        }
                    }?>
                        </ul>
                        
                    </div>
                </section>
                <div class="navigator">
                <?php
                        for($i=1; $i<=$total_pages; $i++){?>
                            <a class="pages" href="tasks.php?page=<?php echo $i; ?>">
                            <?php echo $i; ?></a>
                        <?php
                    }?>
                </div>
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