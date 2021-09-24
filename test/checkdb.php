<?php
session_start();
include_once 'conf.php';
if (isset($_SESSION['olddata'])) {
    $sql = "SELECT * FROM instent_data ORDER BY id DESC LIMIT 1";
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            if($_SESSION['olddata'] < $row['id']){
                $_SESSION['olddata'] =  $row['id'];
            }
        }
    }
} else {
    $sql = "SELECT * FROM instent_data ORDER BY id DESC LIMIT 1";
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $_SESSION['olddata'] = $row['id'];
        }
    }
}
echo $_SESSION['olddata'];