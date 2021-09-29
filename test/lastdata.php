<?php
include_once 'conf.php';
$lastdata = [];
$sql = "SELECT * FROM instent_data ORDER BY id DESC LIMIT 1";
$query = $conn->query($sql);
if ($query->num_rows > 0) {
    for ($i=0; $i < $query->num_rows; $i++) {
        $row = $query->fetch_assoc();
        $lastdata[$i]['id'] = $row['id'];  
        $lastdata[$i]['msg'] = $row['msg'];
        $lastdata[$i]['created_at'] = $row['created_at'];
    }
} 
echo json_encode($lastdata);