function _0xe4fd(_0x26e8d2, _0x5bdf16) {
  var _0x514bbe = _0x514b();
  return (
    (_0xe4fd = function (_0xe4fdc9, _0x1452b0) {
      _0xe4fdc9 = _0xe4fdc9 - 0xb9;
      var _0x555c30 = _0x514bbe[_0xe4fdc9];
      return _0x555c30;
    }),
    _0xe4fd(_0x26e8d2, _0x5bdf16)
  );
}
function _0x514b() {
  var _0x57939c = [
    "prop",
    "location",
    "Login\x20successfully",
    "true",
    "1OTtrVp",
    ".span-notify-alert",
    "dashboard/",
    "7437672XaLrtu",
    "48ICEsOy",
    "1135269EeRKEL",
    "hide",
    "5593049flFUCD",
    "POST",
    ".input-username",
    "loginprocess.php",
    "show",
    "disabled",
    "2820245fmvTOP",
    "10745SmSzDd",
    "val",
    ".button-login",
    "2363798lZsQCG",
    "html",
    ".input-password",
    "4mOqtkh",
    "ajax",
    "3846921wCcgvR",
    "10PETkKE",
  ];
  _0x514b = function () {
    return _0x57939c;
  };
  return _0x514b();
}
(function (_0x53c917, _0x1f3355) {
  var _0x51d35b = _0xe4fd,
    _0x270216 = _0x53c917();
  while (!![]) {
    try {
      var _0x1a4f8b =
        (-parseInt(_0x51d35b(0xc8)) / 0x1) * (parseInt(_0x51d35b(0xbd)) / 0x2) +
        (-parseInt(_0x51d35b(0xc2)) / 0x3) *
          (-parseInt(_0x51d35b(0xc0)) / 0x4) +
        parseInt(_0x51d35b(0xb9)) / 0x5 +
        -parseInt(_0x51d35b(0xcb)) / 0x6 +
        parseInt(_0x51d35b(0xba)) / 0x7 +
        (-parseInt(_0x51d35b(0xcc)) / 0x8) *
          (-parseInt(_0x51d35b(0xcd)) / 0x9) +
        (parseInt(_0x51d35b(0xc3)) / 0xa) * (parseInt(_0x51d35b(0xcf)) / 0xb);
      if (_0x1a4f8b === _0x1f3355) break;
      else _0x270216["push"](_0x270216["shift"]());
    } catch (_0x280400) {
      _0x270216["push"](_0x270216["shift"]());
    }
  }
})(_0x514b, 0xa8de5);
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

