<div class="menu">
    <ul>
        <a href="index.php"><li><i class="fa-solid fa-house"></i> home</li></a>
        <a href="workers.php"><li><i class="fa-solid fa-users-line"></i> all workers</li></a>
        <a href="logged_in.php"><li><i class="fa-solid fa-signal"></i> logged in</li></a>
        <a href="tasks.php"><li><i class="fa-solid fa-list-check"></i> tasks</li></a>
        <a href="mailbox.php"><li><i class="fa-solid fa-envelope"></i> mail box</li></a>
        <?php
        if($user_data['acces'] === '2'){?>
            <a href="manage.php"><li><i class="fa-solid fa-bars-progress"></i> manage workers</li></a>
        <?php
        }?>
        <a href="groups.php"><li><i class="fa-solid fa-users"></i> groups</li></a>
    </ul>
</div>