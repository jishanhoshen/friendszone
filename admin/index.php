<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once '../action/config.php';
include_once 'header.php';

if ($_SESSION['unique_id'] == 1588659288) {
    $_SESSION['adminid'] = $_SESSION['unique_id'];
    $_SESSION['adminimage'] = $_SESSION['user_image'];
    $_SESSION['adminfullname'] = $_SESSION['fullname'];
    $_SESSION['adminemail'] = $_SESSION['useremail'];
} else {
    header('location:../index.php');
}
?>

<body>
    <div class="leftside">
        <div class="admin-profile">
            <img src="../public/images/users/<?= $_SESSION['adminimage'] ?>"  class="adminimage">
            <span class="adminname"><?= $_SESSION['adminfullname'] ?></span>
        </div>
        <div class="list-group list-group-flush adminmenu">
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fas fa-users"></i>
                All Users
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fa fa-address-card"></i>
                About
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fa fa-address-card"></i>
                About
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fa fa-address-card"></i>
                About
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fa fa-address-card"></i>
                About
            </a>
            <a href="#" class="list-group-item list-group-item-action">
                <i class="fa fa-address-card"></i>
                About
            </a>
        </div>
    </div>
    <div class="content-area">
        <?php
        $sql = "
            SELECT * FROM users
            WHERE NOT unique_id = {$_SESSION['adminid']}
            ORDER BY id DESC;
            ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        ?>
            <table id="allusers" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><img src="../public/images/users/<?= $row['img'] ?>"></td>
                            <td><?= $row['unique_id'] ?></td>
                            <td><?= $row['fname'] . " " . $row['lname'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['status'] ?></td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        <?php
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>