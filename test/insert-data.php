<?php
session_start();
include_once 'conf.php';
if (isset($_POST['msg'])) {
    $sql = "INSERT INTO instent_data (msg) VALUES('{$_POST['msg']}');";
    $query = $conn->query($sql);
    if ($query) {
        echo json_encode(true);
    }
}