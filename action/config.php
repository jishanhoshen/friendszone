<?php
$conn = new mysqli("localhost","jishan2","12345","friendszone");
if($conn->connect_error){
    die("connection Error" . $conn->connect_error);
}