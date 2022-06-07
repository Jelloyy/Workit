<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$onlyLogged = 0;
$resultPerPage = 10;
include("splitter.php");

?>

<body>
<?php if(isset($_SESSION['user_id'])){
    if($user_data['acces']==='2'){?>
    <div class="wrapper">
        <?php include("header.php"); ?>
        <div class="front-page">
            <div class="left-sidebar">
                <?php include("menu.php"); ?>
            </div>
            <div class="section">
                <section class="data2">
                    <p class="data2-title">Manage workers</p>
                    <?php if(isset($_SESSION['user_id']) && $user_data['acces']>='1'){?>
                        <a href="add_user.php" class="mng-add"><i class="fa-solid fa-plus"></i></a>
                    <?php
                    }?>
                    <div class="legend2">
                        <p>id</p>
                        <p>name</p>
                        <p>surename</p>
                        <p>group</p>
                        <p>e-mail</p>
                        <p>action</p>
                    </div>
                    <?php
                    while($user = mysqli_fetch_assoc($result)){?>
                    <div class="legend2">
                        <p><?php echo $user['id']; ?></p>
                        <p><?php echo $user['name']; ?></p>
                        <p><?php echo $user['surename']; ?></p>
                        <p><?php echo $user['groups']; ?></p>
                        <p><?php echo $user['email']; ?></p>
                        <p><a href="#"></a>
                            <a href="user.php?id=<?php echo $user['id']; ?>"><i class="fa-solid fa-user"></i></a>
                            <a href="edit.php?id=<?php echo $user['id']; ?>"><i class="fa-solid fa-gear"></i></a>
                        </p>
                    </div>
                    <?php
                    }
                    for($i=1; $i<$total_pages; $i++){?>
                        <a class="pages" href="workers.php?page=<?php echo $i; ?>">
                        <?php echo $i; ?></a>
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
            header("Location: index.php");
        }
    }else{
        header("Location: login_page.php");
    }?>
</body>
</html>