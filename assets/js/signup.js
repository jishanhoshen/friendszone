$(document).ready(function () {
  $("form").on("submit", function (e) {
    e.preventDefault();
    var formdata = new FormData(this);
    console.log(formdata);
    $.ajax({
      url: "action/signup.php",
      type: "post",
      data: formdata,
      dataType: "json",
      contentType: false,
      processData: false,
      cache: false,
      success: function (data) {
        console.log(data);
          if (data.error != undefined) {
            $(".error").html(data.error);
          }
          if (data.success != undefined) {
            window.location.href = "index.php";
          }
      },
    });
    // const form = document.querySelector("form");
    // let xhr = new XMLHttpRequest();
    // xhr.open("POST", "action/signup.php", true);
    // xhr.onload = () => {
    //   if (xhr.readyState === XMLHttpRequest.DONE) {
    //     if (xhr.status === 200) {
    //       console.log(xhr.response);
    //       let data = JSON.parse(xhr.response);
    //       console.log(data);
    //       if (data.error != undefined) {
    //         $(".error").html(data.error);
    //       }
    //       if (data.success != undefined) {
    //         window.location.href = "index.php";
    //       }
    //     }
    //   }
    // };
    // var vidFileLength = $("#photo")[0].files.length;
    // if (vidFileLength === 1) {
    //   // console.log($("#photo").get(0).files[0].size);
    //   if ($("#photo").get(0).files[0].size > 25000000) {
    //     $(".error").html(
    //       "your selected file is too much larger. <br> Please select the photo below 25 MB"
    //     );
    //   } else {
    //     let formData = new FormData(form);
    //     xhr.send(formData);
    //   }
    // }
  });
});
