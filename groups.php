<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);
$admin_count = groups($con, 'admin');
$IT_count = groups($con, 'IT');
$BK_count = groups($con, 'BK');
$PM_count = groups($con, 'PM');

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
                    <p class="data2-title">All groups</p>
                    <a href="group.php?grp=admin">
                        <div class="group">Administration<br /> users: <?php echo $admin_count; ?></div>
                    </a>
                    <a href="group.php?grp=IT">
                        <div class="group">IT<br /> users: <?php echo $IT_count; ?></div>
                    </a>
                    <a href="group.php?grp=BK">
                        <div class="group">Bookkeeping (BK)<br /> users: <?php echo $BK_count; ?></div>
                    </a>
                    <a href="group.php?grp=PM">
                        <div class="group">Project Managers (PM)<br /> users: <?php echo $PM_count; ?></div>
                    </a>
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