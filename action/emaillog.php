<?php
session_start();
include_once "config.php";
$returnData = [];
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if (!empty($email)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "SELECT * FROM users Where email = '{$email}'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['useremail'] = $email;
                $_SESSION['user_image'] = $row['img'];
                $_SESSION['fullname'] = $row['fname']." ".$row['lname'];
                // echo "emaildone";
                $returnData['user'] = [
                    'user_image' => $row['img']
                ];
                $_SESSION['emaildone'] = "emaildone";
                $returnData['success'] = "emaildone";
            } else {
                $returnData['error'] = ['emailerror' => $email . "<br> Couldn't find your Account"];
            }
        } else {
            $returnData['error'] = ['emailerror' => $email . "<br> This is not a valid email"];
        }
    } else {
        $returnData['error'] = ['emailerror' => "Email Required!"];
    }
}

if (isset($_POST['password'])) {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if (!empty($password)) {
        $sql = "SELECT * FROM users Where email = '{$_SESSION['useremail']}'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (md5($password) == $row['password']) {
                $status = "Active now";
                $activesql = "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}";
                $conn->query($activesql);
                $_SESSION['unique_id'] = $row['unique_id'];
                $returnData['success'] = "passdone";
            } else {
                $returnData['error'] = ['passerror' => "Password Incorrect!"];
            }
        }
    } else {
        $returnData['error'] = ['passerror' => "Password Required!"];
    }
}
echo json_encode($returnData);
