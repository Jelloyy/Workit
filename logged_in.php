<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);

$onlyLogged = 1;
$resultPerPage = 10;
include("splitter.php");

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
                    <p class="data2-title">Online workers</p>
                    <div class="legend2">
                        <p>id</p>
                        <p>name</p>
                        <p>surename</p>
                        <p>group</p>
                        <p>e-mail</p>
                        <p>last seen</p>
                    </div>
                    <?php
                    while($user = mysqli_fetch_assoc($result)){?>
                    <div class="legend2">
                        <p><?php echo $user['id']; ?></p>
                        <p><?php echo $user['name']; ?></p>
                        <p><?php echo $user['surename']; ?></p>
                        <p><?php echo $user['groups']; ?></p>
                        <p><?php echo $user['email']; ?></p>
                        <p><?php echo $user['last_seen']; ?><i class="fa-solid fa-earth-europe"></i>
                        </p>
                    </div>
                    <?php
                    }
                    for($i=1; $i<$total_pages; $i++){?>
                        <a class="pages" href="logged_in.php?page=<?php echo $i; ?>">
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
        header("Location: login_page.php");
    }?>
</body>
</html>