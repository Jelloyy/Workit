<?php 

session_start();

include("head.php");
include("connection.php");
include("functions.php");

if(!$_SESSION['user_id']){
    header("Location: login_page.php");
    die;
}

$user_data = userData($con);

$onlyLogged = 1;
$resultPerPage = 5;
include("splitter.php");
$taskLength = findLatestTaskID($con);
$firstTaskID = findFirstTaskID($con);

$mailLength = findLatestMailID($con);
$firstMailID = findFirstMailID($con);

$stats_tasks = tasksToDoCount($con, $user_data['groups']);
$stats_mails = newMailsCount($con, $user_data['email']);

if($taskLength!=NULL){
$latestTask = $taskLength['id'];
}else{
    $latestTask = 0;
}
if($firstTaskID!=NULL){
$firstTask = $firstTaskID['id'];
}else{
    $firstTask = 0;
}

if($mailLength!=NULL){
$latestMail = $mailLength['id'];
}else{
    $latestMail = 0;
}
if($firstMailID!=NULL){
    $firstMail = $firstMailID['id'];
}else{
    $firstMail = 0;
}
$showed = 0;
$showed2 = 0;
?>
<body>
    <div class="wrapper">
        <?php include("header.php"); ?>
        <div class="front-page">
            <div class="left-sidebar">
                <?php include("menu.php"); ?>
            </div>
            <div class="section">
                <div class="top-section">
                    <section class="data">
                        <p class="data-title">Online workers</p>
                        <ul>
                        <?php
                        while($user = mysqli_fetch_assoc($result)){?>
                            <a href="user.php?id=<?php echo $user['id']; ?>">
                                <li>
                                    <p class="user-name">
                                        <?php echo $user['name']." ". $user['surename']; ?>
                                    </p>
                                    <p class="class it"><?php echo $user['groups']; ?></p>
                                    <i class="fa-solid fa-earth-europe"></i>
                                    <p class="time">
                                        <?php echo $user['last_seen']; ?>
                                    </p>
                                </li>
                            </a>
                        <?php
                        }?>
                        </ul>
                        
                        <?php
                        for($i=1; $i<$total_pages; $i++){?>
                            <a class="pages" href="index.php?page=<?php echo $i; ?>">
                            <?php echo $i; ?></a>
                        <?php
                        }?>

                    </section>
                    <section class="data">
                        <p class="data-title">Today is:</p>
                        <p class="td-date"><?php echo date("Y-m-d"); ?></p>
                        <p class="td-hour">You logged at <?php echo $user_data['last_seen']; ?></p>
                        <p class="td-hour stats">You have <?php echo $stats_tasks; ?> tasks to do.</p>
                        <p class="td-hour stats">You have <?php echo $stats_mails; ?> new messages.</p>
                    </section>
                </div>
                <div class="bottom-section">
                    <section class="data">
                        <p class="data-title">Your tasks</p>
                        <?php
                        for($i=$latestTask; $i>=$firstTask; $i--){
                            $task_data = taskData($con, $i);
                            if($task_data!=NULL){
                            if(($task_data['groups']===$user_data['groups']) && $showed<2){?>
                            <a class="task-hlink" href="task.php?id=<?php echo $i;?>"><div class="tasks">
                                <p class="task-date"><?php echo $task_data['date']; ?></p>
                                <p class="task-title"><?php echo $task_data['title']; ?></p>
                                <p class="task-title"><?php $task_data['description']; ?></p>
                            </div></a>
                            <?php
                            $showed++;
                            }else{
                                continue;
                            }
                            }
                        }?>
                    </section>
                    <section class="data">
                        <p class="data-title">Latest messages</p>
                        <?php
                        for($i=$latestMail; $i>=$firstMail; $i--){
                            $mailData = mailData($con, $i);
                            if($mailData!=NULL){
                                if(($mailData['send_to'] === $user_data['email']) && $showed2<2){?>
                                    <a class="task-hlink" href="message.php?id=<?php echo $i;?>">
                                    <div class="latest-messages">
                                        <p class="latest-message-date"><?php echo $mailData['sent_date'];?></p>
                                        <p class="latest-message-title">From <?php echo $mailData['send_from']; ?></p>
                                        <p class="latest-message"><?php echo $mailData['title']; ?></p>
                                    </div></a>
                                <?php
                                $showed2++;
                                }else{
                                    continue;
                                }
                            }
                        }?>
                    </section>
                </div>
            </div>
        </div>
        <footer>
            <p>Work.it 2022</p>
        </footer>
    </div>
</body>
</html>