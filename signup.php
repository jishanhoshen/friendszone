<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header('location:index.php');
}
include_once "header.php";
?>

<body>
    <div class="main-container">
        <div class="login-area">
            <div class="logo"><img src="public/images/icons/logo.svg" alt=""></div>
            <div class="c-name">friends zone</div>
            <div class="login-header">Sign Up</div>
            <div class="error"></div>
            <form class="login-form" method="post" enctype="multipart/form-data">
                <input type="text" name="fname" placeholder="First Name">
                <input type="text" name="lname" placeholder="Last Name">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <select name="gender">
                    <option value="" selected disabled>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
                <input type="date" name="birthdate">
                <div class="fileupload">
                    <label for="photo"><span id="photoname">Choose Photo</span><i class="fas fa-upload"></i></label>
                    <input type="file" name="image" id="photo">
                </div>
                <button class="loginbutton">Next</button>
            </form>
            <div class="createlink">Already have an account? <a href="/login.php">Sign in →</a></div>
        </div>
    </div>
    <script src="public/js/jquery-3.6.0.min.js"></script>
    <script src="public/js/signup.js"></script>
    <script>
        $('input#photo').change(function() {
            var vidFileLength = $(this)[0].files.length;
            if (vidFileLength === 1) {
                $('#photoname').html($(this)[0].files[0].name);
            }
        });
    </script>
</body>

</html>