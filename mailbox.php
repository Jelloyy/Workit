<?php
session_start();

include("head.php");
include("connection.php");
include("functions.php");

$user_data = userData($con);

$resultPerPage = 10;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$startFrom = ($page-1) * $resultPerPage;

$query = "SELECT * FROM mail ORDER BY ID DESC LIMIT $startFrom, ".$resultPerPage;
$result = mysqli_query($con, $query);

$query2 = "SELECT COUNT(ID) AS total FROM mail";
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
                    <p class="data2-title">Your mailbox</p>
                    <?php if(isset($_SESSION['user_id'])){?>
                        <a href="send_mail.php" class="snd">send -></a><br />
                    <?php
                    }?>
                    <div class="task-wrapper2">
                    <?php
                    while($mails = mysqli_fetch_assoc($result)){
                        if($mails['send_to']===$user_data['email']){?>
                    
                        <a style="
                        
                        <?php 
                        if($mails['seen']==0)
                        { echo 'background-color: rgb(208, 183, 248);';}
                        elseif($mails['seen']==1)
                        { echo'background-color: rgb(67, 58, 82);';}?>
                        " 
                        
                        class="msg" href="message.php?id=<?php echo $mails['id']; ?>">
                            <p><?php echo $mails['title']; ?></p>
                            <p>From: <?php echo $mails['send_from']; ?> </p>
                            <p>Date: <?php echo $mails['sent_date']; ?></p>
                        </a>
                        <?php
                        }
                    }?>
                        </ul>
                        
                    </div>
                </section>
                <div class="navigator">
                <?php
                        for($i=1; $i<=$total_pages; $i++){?>
                            <a class="pages" href="mailbox.php?page=<?php echo $i; ?>">
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