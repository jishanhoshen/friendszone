<?php
session_start();
include_once 'conf.php';
$arraydata = [];
unset($_SESSION['arraydata']);
unset($_SESSION['olddata']);
unset($_SESSION['olddata']);

$sql = "SELECT * FROM instent_data ORDER BY id";
$query = $conn->query($sql);
if($query){
    if ($query->num_rows > 0) {
        for ($i = 0; $i < $query->num_rows; $i++) {
            $row = $query->fetch_assoc();
            $arraydata[$i]['id'] = $row['id'];
            $arraydata[$i]['msg'] = $row['msg'];
            $arraydata[$i]['created_at'] = $row['created_at'];
        }
        $_SESSION['arraydata'] = $arraydata;
        echo json_encode( $arraydata );
    } else {
        echo json_encode(0);
    }
}else{
    echo json_encode(0);
}
