<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header('location:index.php');
}
include_once "header.php"; 
?>
<body>
    <div class="main-container">
        <?php
        if (isset($_SESSION['emaildone']) or isset($_SESSION['useremail'])) {
            if (isset($_SESSION['user_image'])) {
                $userimage = $_SESSION['user_image'];
            } else {
                $userimage = 'demouser.jpg';
            }
        ?>
            <div class="login-area">
                <div class="logo"><img src="assets/images/icons/logo.svg" alt=""></div>
                <div class="c-name">friends zone</div>
                <div class="user-login-profile" style="background-image : url(./assets/images/users/<?= $userimage ?>)"></div>
                <div class="login-header"><?= $_SESSION['fullname']?></div>
                <div class="error"></div>
                <form class="login-form" method="post">
                    <input type="password" name="password" placeholder="Password" autofocus>
                    <input type="submit" class="loginbutton" value="Continue">
                </form>

                <a href="/logout.php" class="loginanother">Logoin Another Account !</a>
                <a href="/forgetpass.php" class="forgetpass">Forgot password?</a>
            </div>
        <?php
        } else {
        ?>
            <div class="login-area">
                <div class="logo"><img src="assets/images/icons/logo.svg" alt=""></div>
                <div class="c-name">friends zone</div>
                <div class="login-header">Sign in</div>
                <div class="error"></div>
                <form class="login-form" method="post">
                    <input type="text" name="email" placeholder="Email" autofocus>
                    <input type="submit" class="loginbutton" value="next">
                </form>

                <div class="createlink">
                New to FriendsZone?
                    <a href="/signup.php">Create an account.</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>