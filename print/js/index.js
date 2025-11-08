var _0x543131 = _0x3e9c;
(function (_0x3a09aa, _0x3dfd8b) {
  var _0x45b6cd = _0x3e9c,
    _0x285938 = _0x3a09aa();
  while (!![]) {
    try {
      var _0x3889dd =
        parseInt(_0x45b6cd(0xb4)) / 0x1 +
        (-parseInt(_0x45b6cd(0x101)) / 0x2) *
          (-parseInt(_0x45b6cd(0xc7)) / 0x3) +
        (-parseInt(_0x45b6cd(0xe6)) / 0x4) *
          (parseInt(_0x45b6cd(0x103)) / 0x5) +
        -parseInt(_0x45b6cd(0x106)) / 0x6 +
        (parseInt(_0x45b6cd(0xbe)) / 0x7) * (-parseInt(_0x45b6cd(0xc5)) / 0x8) +
        (parseInt(_0x45b6cd(0xff)) / 0x9) *
          (-parseInt(_0x45b6cd(0x104)) / 0xa) +
        (-parseInt(_0x45b6cd(0xf7)) / 0xb) * (-parseInt(_0x45b6cd(0xf8)) / 0xc);
      if (_0x3889dd === _0x3dfd8b) break;
      else _0x285938["push"](_0x285938["shift"]());
    } catch (_0x790c7f) {
      _0x285938["push"](_0x285938["shift"]());
    }
  }
})(_0x3eee, 0x853d6),
  $(document)[_0x543131(0xed)](function () {
    PlaceHolder(),
      ShowMenu(),
      ShowMenuHover(),
      LoadList(),
      HistoryPosition(),
      ReloadPage();
  });
function ReloadPage() {
  setTimeout(function() {
    window.location.reload();
  }, 900000);
}

function addCommas(number) {
  var dig = number.toString().split(".");
  if (dig[0].length >= 4) {
    dig[0] = dig[0].replace(/(\d)(?=(\d{3})+$)/g, "$1,");
  }
  return dig.join(".");
}
function PlaceHolder() {
  $("select").on("change", function() {
    var r20 = $("option:selected", this).attr("value");
    $("input").attr("placeholder", r20);
  });
}

function HistoryPosition() {
  $(".button-history").on("click", function() {
    var paddingBox = $(this).position();
    $(".box-history").css("bottom", paddingBox.bottom);
    $(".div-history").css("left", paddingBox.left);
    var processnumber = $("#processnumber").val();
    $.ajax({
      type: "POST",
      url: "history.php",
      data: { processnumber: processnumber },
      success: function(response) {
        $(".div-history").html(response);
        $(".box-history").show();
      }
    });
  });
}

function ShowMenuHover() {
  var _0x5036ac = _0x543131;
  $(_0x5036ac(0xcf))["on"](_0x5036ac(0xcd), function () {
    var _0x5d1b63 = _0x5036ac;
    $(_0x5d1b63(0xc3))["css"](_0x5d1b63(0xfa), _0x5d1b63(0xec)),
      $(_0x5d1b63(0xc3))[_0x5d1b63(0xbd)]("opacity", "0.5");
  }),
    $(_0x5036ac(0xcf))["on"](_0x5036ac(0xf6), function () {
      var _0x2cf37f = _0x5036ac;
      $(_0x2cf37f(0xc3))[_0x2cf37f(0xbd)](_0x2cf37f(0xfa), "");
    });
}
function ShowMenu() {
  var _0x413afc = _0x543131;
  $(_0x413afc(0xee))["on"](_0x413afc(0xc2), function () {
    var _0x3576cc = _0x413afc;
    $(_0x3576cc(0xbb))[_0x3576cc(0xb9)]();
  });
}
function LoadList() {
  var _0x30ef55 = _0x543131,
    _0x3bc40f = $(_0x30ef55(0xb6))[_0x30ef55(0xc1)](),
    _0x2c4f1b = $(_0x30ef55(0xd7))[_0x30ef55(0xc1)](),
    _0xc491bc = $(".select-status")[_0x30ef55(0xc1)](),
    _0x33331d = $(_0x30ef55(0xd0))[_0x30ef55(0xc1)]();
  $[_0x30ef55(0xdf)]({
    type: "POST",
    url: "loadlist.php",
    data: {
      selectsearch: _0x3bc40f,
      search: _0x2c4f1b,
      status: _0xc491bc,
      company: _0x33331d,
    },
    success: function (_0x2e111a) {
      var _0x24cf6a = _0x30ef55;
      $(".tbody-list-order")[_0x24cf6a(0xc9)](_0x2e111a), LoadDetail();
    },
  });
}
function CloseForm() {
  var _0x2f33ea = _0x543131;
  $(_0x2f33ea(0xc4))[_0x2f33ea(0xb7)]();
}
function LoadDetail() {
  var _0x32c544 = _0x543131;
  $(_0x32c544(0xe2))["click"](function () {
    var _0x2d57a7 = _0x32c544,
      _0x460cf7 = $(this)[_0x2d57a7(0xe8)]("f325id");
    $["ajax"]({
      type: _0x2d57a7(0xdd),
      url: _0x2d57a7(0xd3),
      data: { id: _0x460cf7 },
      success: function (_0x3fc222) {
        var _0x53bc68 = _0x2d57a7;
        $(_0x53bc68(0xc4))[_0x53bc68(0xd6)](),
          (obj = JSON["parse"](_0x3fc222)),
          $(_0x53bc68(0xeb))[_0x53bc68(0xc1)](obj[_0x53bc68(0xba)]),
          $(_0x53bc68(0xbc))[_0x53bc68(0xc1)](obj["vendorname"]),
          $(_0x53bc68(0xbc))[_0x53bc68(0xe8)](
            _0x53bc68(0x102),
            obj[_0x53bc68(0x102)]
          ),
          $(".input-issued")[_0x53bc68(0xc1)](obj["issuedby"]),
          $(_0x53bc68(0xda))[_0x53bc68(0xc1)](obj[_0x53bc68(0x107)]),
          $(_0x53bc68(0xd5))[_0x53bc68(0xc1)](obj["preparedby"]),
          $(_0x53bc68(0xfd))["val"](obj[_0x53bc68(0xd4)]),
          $(_0x53bc68(0xe4))[_0x53bc68(0xc1)](obj[_0x53bc68(0xef)]),
          $(_0x53bc68(0xb5))[_0x53bc68(0xc1)](obj[_0x53bc68(0xdb)]),
          $(".input-status")["val"](obj[_0x53bc68(0x100)]),
          LoadSKU(),
          $(_0x53bc68(0xf9))[_0x53bc68(0xc1)]() == _0x53bc68(0xb8)
            ? ($(_0x53bc68(0xbf))[_0x53bc68(0xc9)](_0x53bc68(0xe9)),
              $(".button-reopen")["hide"](),
              $(_0x53bc68(0xb5))[_0x53bc68(0x105)](_0x53bc68(0xd1), ![]))
            : ($(_0x53bc68(0xbf))[_0x53bc68(0xc9)]("Re-Print"),
              $(_0x53bc68(0xdc))[_0x53bc68(0xd6)](),
              $(_0x53bc68(0xb5))[_0x53bc68(0x105)]("disabled", !![]));
      },
    });
  });
}
function LoadSKU() {
  var _0xf85e0a = _0x543131,
    _0x131090 = $(_0xf85e0a(0xfd))[_0xf85e0a(0xc1)](),
    _0xd3102d = $(_0xf85e0a(0xbc))[_0xf85e0a(0xe8)](_0xf85e0a(0x102));
  $[_0xf85e0a(0xdf)]({
    type: "POST",
    url: "loadsku.php",
    data: { f325number: _0x131090, vcode: _0xd3102d },
    success: function (_0x35d7db) {
      var _0x4b2d93 = _0xf85e0a;
      $(".tbl-order-list")[_0x4b2d93(0xc9)](_0x35d7db), Subtotal();
    },
  });
}
function Subtotal() {
  var _0x43bb7a = _0x543131,
    _0x728b92 = 0x0;
  $(_0x43bb7a(0xf3))["each"](function () {
    var _0x1493f0 = _0x43bb7a;
    _0x728b92 += parseFloat($(this)[_0x1493f0(0xe8)](_0x1493f0(0xde)));
  }),
    $(_0x43bb7a(0xd9))[_0x43bb7a(0xc1)](
      addCommas(_0x728b92[_0x43bb7a(0xf1)](0x2))
    );
}
function ReOpen() {
  var _0x3a8038 = _0x543131,
    _0x37ab0e = $(".input-ordernumber")[_0x3a8038(0xc1)]();
  $[_0x3a8038(0xdf)]({
    type: _0x3a8038(0xdd),
    url: _0x3a8038(0xc6),
    data: { f325number: _0x37ab0e },
    success: function (_0x40ddf4) {
      var _0x2a8690 = _0x3a8038;
      $(_0x2a8690(0xf4))[_0x2a8690(0xc9)](_0x40ddf4),
        $(_0x2a8690(0xf4))[_0x2a8690(0xd6)](),
        CloseForm(),
        LoadList(),
        setTimeout(function () {
          var _0x55f7a7 = _0x2a8690;
          $(".span-notify-alert")[_0x55f7a7(0xb7)]();
        }, 0x7d0);
    },
  });
}
function UpdateStatus() {
  var _0x1bfe63 = _0x543131,
    _0x596475 = $(_0x1bfe63(0xfd))[_0x1bfe63(0xc1)](),
    _0x2b7c37 = $(_0x1bfe63(0xb5))[_0x1bfe63(0xc1)]();
  $["ajax"]({
    type: _0x1bfe63(0xdd),
    url: _0x1bfe63(0xe0),
    data: { f325number: _0x596475, remarks: _0x2b7c37 },
    success: function (_0x1e4ad2) {
      var _0x4d8449 = _0x1bfe63;
      $(_0x4d8449(0xf4))[_0x4d8449(0xc9)](_0x1e4ad2),
        $(_0x4d8449(0xf4))["show"](),
        CloseForm(),
        LoadList(),
        setTimeout(function () {
          var _0x519036 = _0x4d8449;
          $(_0x519036(0xf4))[_0x519036(0xb7)]();
        }, 0x7d0);
    },
  });
}
function PrintFile() {
  var _0x104d42 = _0x543131,
    _0x4fc59d = $(_0x104d42(0xfd))[_0x104d42(0xc1)](),
    _0x3b857b = $(_0x104d42(0xf9))[_0x104d42(0xc1)](),
    _0x6187da = $(location)[_0x104d42(0xe8)]("hostname"),
    _0x550c20 =
      _0x104d42(0xe7) + _0x6187da + _0x104d42(0xce) + _0x4fc59d + ".txt",
    _0x1e0ca4 = window["open"](_0x550c20);
  setTimeout(function () {
    var _0x44d7c8 = _0x104d42;
    _0x1e0ca4["print"](),
      setTimeout(function () {
        var _0x40fdbf = _0x3e9c;
        _0x1e0ca4[_0x40fdbf(0xf2)]();
      }, 0x1f4),
      _0x3b857b == _0x44d7c8(0xb8) && UpdateStatus();
  }, 0x1f4);
}
