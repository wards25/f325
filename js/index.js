function Login() {
  var username = $(".input-username").val();
  var password = $(".input-password").val();

  $.ajax({
    type: "POST",
    beforeSend: function () {
      $(".input-username").prop("disabled", true);
      $(".input-password").prop("disabled", true);
      $(".button-login").prop("disabled", true);
    },
    url: "loginprocess.php",
    data: { username: username, password: password },
    success: function (response) {
      if (response == "true") {
        setTimeout(function () {
          $(".span-notify-alert").html("Login successfully");
          $(".span-notify-alert").show();
          setTimeout(function () {
            $(".span-notify-alert").hide();
            window.location.href = "dashboard/";
          }, 3000);
        }, 1000);
      } else {
        setTimeout(function () {
          $(".span-notify-alert").html(response);
          $(".span-notify-alert").show();

          $(".input-username").prop("disabled", false);
          $(".input-password").prop("disabled", false);
          $(".button-login").prop("disabled", false);

          setTimeout(function () {
            $(".span-notify-alert").hide();
          }, 3000);
        }, 1000);
      }
    },
  });

  return false;
}

