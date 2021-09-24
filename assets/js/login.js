$(document).ready(function () {
    $("form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'action/emaillog.php',
            dataType: 'JSON',
            data: $(this).serialize(),
            success: function (data) {
                console.log(data);
                if (data.success == "emaildone") {
                    window.location.href = 'login.php';
                }
                if (data.success == "passdone") {
                    window.location.href = 'index.php';
                }
                // console.log(data.error.emailerror);
                if (data.error != undefined) {
                    if (data.error.emailerror != undefined) {
                        $(".error").html(data.error.emailerror);
                    }
                    if (data.error.passerror != undefined) {
                        $(".error").html(data.error.passerror);
                    }
                    
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
});