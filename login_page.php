<?php
session_start();
include("connection.php");
include("head.php");

if(!isset($_SESSION['user_id'])){
?>
<body class="login-pg">
    <div class="login-pg-wrapper">
        <div class="login-window">
            <div class="left">
                <p class="window-title">Work.it - Login panel</p>
                <form action="login.php" method="POST">
                    <label>Login</label><br />
                    <input class="login-input" type="text" name="login" required><br /><br />
                    <label>Password</label><br />
                    <input class="login-input" type="password" name="pass"><br />
                    <input class="login-submit" type="submit" value="login">
                </form>
            </div>
            <div class="right">
                <section>
                    <p class="window-title">Today information</p>
                    <p class="window-date"><?php echo date("Y-m-d"); ?></p><br />
                    <p class="window-info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos quasi dolorem facere eum animi ipsum cupiditate laudantium nisi deserunt recusandae, debitis culpa tempora aliquid unde minima inventore distinctio omnis qui!</p>
                </section>
            </div>
        </div>
    </div>
</body>
<?php
}else{
    echo "You are already logged in";
}?>