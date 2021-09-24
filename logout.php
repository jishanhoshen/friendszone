<?php
session_start();
if (isset($_GET['session']) && $_GET['session'] == true) {
    include_once "action/config.php";
    $status = "Offline now";
    $sql = "UPDATE users SET status = '{$status}' WHERE unique_id={$_SESSION['unique_id']}";
    $result = $conn->query($sql);
    if ($result) {
        unset($_SESSION['unique_id']);
    }
} else {
    session_destroy();
}
header("location: ../login.php");