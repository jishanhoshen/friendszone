<?php
    session_start();
    include_once "config.php";
    $returnData = [];
    if(!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['birthdate']) && !empty($_POST['gender']) && !empty( $_POST['email']) && !empty($_POST['password'])){
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password =  mysqli_real_escape_string($conn, $_POST['password']);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                $returnData['error'] = $email . "<br> This email already exist!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $ran_id = rand(time(), 100000000);
                            $new_img_name = $fname.$lname.$ran_id.".".$img_ext;
                            $returnData['test'] = $new_img_name;
                            if(move_uploaded_file($tmp_name,"../assets/images/users/".$new_img_name)){
                                $status = "Active now";
                                $encrypt_pass = md5($password);
                                $sql = "INSERT INTO users (unique_id, fname, lname, email, password, img, gender, birthdate, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$gender}', '{$birthdate}', '{$status}')";
                                $result = $conn->query($sql);
                                if($result){
                                    $_SESSION['unique_id'] = $ran_id;
                                    $returnData['success'] = "success";
                                }else{
                                    $returnData['error'] = "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            $returnData['error'] = "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        $returnData['error'] = "Please upload an image file - jpeg, png, jpg";
                    }
                }else{
                    $returnData['error'] = "All input fields are required!2";
                }
            }
        }else{
            $returnData['error'] = $email . "is not a valid email!";
        }
    }else{
        $returnData['error'] = "All input fields are required!1";
    }
    $returnData['files'] = $_FILES;
    $returnData['post'] = $_POST;
echo json_encode($returnData);