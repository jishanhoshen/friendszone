<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once "action/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="main-container">
        <section class="users">
            <header>
                <div class="content">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    }
                    ?>
                    <img src="public/images/users/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>
                <a href="logout.php?session=true" class="logout">Logout</a>
            </header>
            <div class="search">
                <label class="text" for="searchbtn">Search Friend to start hang out</label>
                <input type="text" placeholder="Enter name to search...">
                <button id="searchbtn"><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list"></div>
        </section>
    </div>
    <script src="public/js/jquery-3.6.0.min.js"></script>
    <script src="public/js/users.js"></script>
</body>

</html>