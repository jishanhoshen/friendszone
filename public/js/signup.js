$(document).ready(function () {
    $("form").submit(function (e) {
        e.preventDefault();
        var fname = $('input[name="fname"]');
        var lname = $('input[name="lname"]');
        var email = $('input[name="email"]');
        var password = $('input[name="password"]');
        var photo = $('#photo');
        var gender = $('input[name="gender"]');
        var birthdate = $('input[name="birthdate"]');
        if(fname.empty() && lname.empty() && email.empty() && password.empty() && photo.empty() && gender.empty() && birthdate.empty()){
            $(".error").html("All input fields are required!3");
        }
        // console.log(fname, lname, email, password, photo, gender, birthdate);
        var data = {
            fname: fname,
            lname: lname,
            email: email,
            password: password,
            photo: photo,
            gender: gender,
            birthdate: birthdate
        };

        const form = document.querySelector(".login-area form");
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "action/signup.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.response);
                    let data = JSON.parse(xhr.response);
                    console.log(data);
                    if (data.error != undefined) {
                        $(".error").html(data.error);
                    }
                    if(data.success != undefined){
                        window.location.href = 'index.php';
                    }
                }
            }
        }
        var vidFileLength = $("#photo")[0].files.length;
        if (vidFileLength === 1) {
            // console.log($("#photo").get(0).files[0].size);
            if ($("#photo").get(0).files[0].size > 25000000) {
                $('.error').html("your selected file is too much larger. <br> Please select the photo below 25 MB");
            }else{
                let formData = new FormData(form);
                xhr.send(formData);
            }
        }

    });
});