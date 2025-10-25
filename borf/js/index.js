var _0x91905d = _0x1645;
(function (_0x418795, _0x25cf03) {
  var _0x4ab97d = _0x1645,
    _0x12d41c = _0x418795();
  while (!![]) {
    try {
      var _0x48e50a =
        (parseInt(_0x4ab97d(0xef)) / 0x1) *
          (-parseInt(_0x4ab97d(0x105)) / 0x2) +
        -parseInt(_0x4ab97d(0x115)) / 0x3 +
        -parseInt(_0x4ab97d(0xee)) / 0x4 +
        -parseInt(_0x4ab97d(0xf8)) / 0x5 +
        parseInt(_0x4ab97d(0x116)) / 0x6 +
        parseInt(_0x4ab97d(0x100)) / 0x7 +
        parseInt(_0x4ab97d(0x131)) / 0x8;
      if (_0x48e50a === _0x25cf03) break;
      else _0x12d41c["push"](_0x12d41c["shift"]());
    } catch (_0x12d2ab) {
      _0x12d41c["push"](_0x12d41c["shift"]());
    }
  }
})(_0x5812, 0x49db5),
  $(document)[_0x91905d(0x125)](function () {
    PlaceHolder(),
      ShowMenu(),
      ShowMenuHover(),
      LoadList(),
      HistoryPosition(),
      OnClickPrintFile(),
      OnClickDeleteF325(),
      ReloadPage();
  });
function ReloadPage() {
  setTimeout(function () {
    var _0x553fc2 = _0x1645;
    window[_0x553fc2(0x12e)][_0x553fc2(0x11d)]();
  }, 0xdbba0);
}
function addCommas(_0xcdc61c) {
  var _0x854c2a = _0x91905d,
    _0x450987 = _0xcdc61c["toString"]()[_0x854c2a(0x12f)](".");
  return (
    _0x450987[0x0][_0x854c2a(0x13a)] >= 0x4 &&
      (_0x450987[0x0] = _0x450987[0x0]["replace"](/(\d)(?=(\d{3})+$)/g, "$1,")),
    _0x450987[_0x854c2a(0x12c)](".")
  );
}
function _0x5812() {
  var _0x1bc108 = [
    "vcode",
    "open",
    "placeholder",
    "loadlist.php",
    ".tbody-history-list",
    "position",
    "2088704nlIwFW",
    "536006erODKS",
    "ajax",
    "print",
    "update.php",
    ".button-discard",
    "css",
    "show",
    "background-Color",
    ".input-borfnumber",
    "1729075cuuRAF",
    ".tbl-order-list",
    "http://",
    ".select-company",
    "dbstatus",
    "hostname",
    ".div-history",
    "vendorname",
    "565586dpHCGp",
    "deletef325.php",
    ".input-search",
    "bottom",
    "loaddetail.php",
    "2JxmMHV",
    ".select-status",
    "POST",
    "click",
    "f325date",
    "prop",
    "history.php",
    "opacity",
    "mouseup",
    ".input-dbstatus",
    "subtotal",
    "preparedby",
    "val",
    "toFixed",
    ".div-bg",
    ".button-menu,.span-text-menu",
    "890493GVtcvo",
    "2320296gsvzPA",
    ".tbody-list-order",
    "branchname",
    ".input-issued",
    "left",
    "DRAFT",
    "loadsku.php",
    "reload",
    "attr",
    "f325id",
    ".input-bms",
    ".span-notify-alert",
    "f325number",
    ".button-print",
    ".input-orderdate",
    "ready",
    "toggle",
    ".span-text-menu",
    "html",
    "#5a5a5a",
    ".input-company",
    "0.5",
    "join",
    ".button-reopen",
    "location",
    "split",
    ".input-remarks",
    "12286648ZNbwBo",
    ".select-search",
    ".input-status",
    ".tbl-list-order-tr",
    "each",
    ".input-customer",
    ".input-subtotal",
    "top",
    "parse",
    "length",
    "emaildate",
    ".input-ordernumber",
    ".input-prepared",
    "change",
    ".input-emaildate",
    "Print",
    "disabled",
    "NONE",
    ".button-menu",
    "mouseleave",
    ".jpg",
    ".subtotal-lines",
    ".div-menu-list",
    "hide",
  ];
  _0x5812 = function () {
    return _0x1bc108;
  };
  return _0x5812();
}
$(document)[_0x91905d(0x10d)](function (_0x460817) {
  var _0x35f4ab = _0x91905d,
    _0x30bb53 = $(".div-menu-list,.div-history");
  !_0x30bb53["is"](_0x460817["target"]) &&
    _0x30bb53["has"](_0x460817["target"])[_0x35f4ab(0x13a)] === 0x0 &&
    _0x30bb53[_0x35f4ab(0xe7)]();
});
function PlaceHolder() {
  var _0x48f4b4 = _0x91905d;
  $(_0x48f4b4(0x132))["on"](_0x48f4b4(0x13e), function () {
    var _0x33499e = _0x48f4b4,
      _0x924ae1 = $("option:selected", this)["attr"](_0x33499e(0xea));
    $(_0x33499e(0x102))[_0x33499e(0x11e)](_0x33499e(0xea), _0x924ae1);
  });
}
function _0x1645(_0x47e6bf, _0x2b1f79) {
  var _0x581287 = _0x5812();
  return (
    (_0x1645 = function (_0x164579, _0x329f33) {
      _0x164579 = _0x164579 - 0xe1;
      var _0x4c2efe = _0x581287[_0x164579];
      return _0x4c2efe;
    }),
    _0x1645(_0x47e6bf, _0x2b1f79)
  );
}
function HistoryPosition() {
  $(".button-history")["on"]("click", function () {
    var _0x362c1f = _0x1645,
      _0x44535d = $(this)[_0x362c1f(0xed)]();
    $(_0x362c1f(0xfe))[_0x362c1f(0xf4)](
      _0x362c1f(0x138),
      _0x44535d[_0x362c1f(0x103)]
    ),
      $(_0x362c1f(0xfe))[_0x362c1f(0xf4)]("left", _0x44535d[_0x362c1f(0x11a)]);
    var _0x1ff606 = $(_0x362c1f(0x13c))[_0x362c1f(0x111)]();
    $["ajax"]({
      type: _0x362c1f(0x107),
      url: _0x362c1f(0x10b),
      data: { processnumber: _0x1ff606 },
      success: function (_0x3b1364) {
        var _0x20932d = _0x362c1f;
        $(_0x20932d(0xec))[_0x20932d(0x128)](_0x3b1364),
          $(".div-history")["show"]();
      },
    });
  });
}
function ShowMenuHover() {
  var _0x3acb3c = _0x91905d;
  $(_0x3acb3c(0x127))["on"]("mouseover", function () {
    var _0x1e8c3b = _0x3acb3c;
    $(_0x1e8c3b(0xe2))[_0x1e8c3b(0xf4)]("background-Color", _0x1e8c3b(0x129)),
      $(".button-menu")[_0x1e8c3b(0xf4)](_0x1e8c3b(0x10c), _0x1e8c3b(0x12b));
  }),
    $(_0x3acb3c(0x127))["on"](_0x3acb3c(0xe3), function () {
      var _0x365cab = _0x3acb3c;
      $(_0x365cab(0xe2))["css"](_0x365cab(0xf6), "");
    });
}
function ShowMenu() {
  var _0x5e87a4 = _0x91905d;
  $(_0x5e87a4(0x114))["on"](_0x5e87a4(0x108), function () {
    var _0x2c7a76 = _0x5e87a4;
    $(_0x2c7a76(0xe6))[_0x2c7a76(0x126)]();
  });
}
function LoadList() {
  var _0x4b2abd = _0x91905d,
    _0x223445 = $(".select-search")[_0x4b2abd(0x111)](),
    _0x1290b7 = $(".input-search")[_0x4b2abd(0x111)](),
    _0x4349da = $(_0x4b2abd(0x106))[_0x4b2abd(0x111)](),
    _0x5b5536 = $(_0x4b2abd(0xfb))[_0x4b2abd(0x111)]();
  $[_0x4b2abd(0xf0)]({
    type: _0x4b2abd(0x107),
    url: _0x4b2abd(0xeb),
    data: {
      selectsearch: _0x223445,
      search: _0x1290b7,
      status: _0x4349da,
      company: _0x5b5536,
    },
    success: function (_0x4bfb5c) {
      var _0x3f1014 = _0x4b2abd;
      $(_0x3f1014(0x117))["html"](_0x4bfb5c), LoadDetail();
    },
  });
}
function CloseForm() {
  var _0x1db895 = _0x91905d;
  $(_0x1db895(0x113))["hide"]();
}
function LoadDetail() {
  var _0x4688b6 = _0x91905d;
  $(_0x4688b6(0x134))["click"](function () {
    var _0xc5648d = _0x4688b6,
      _0x48aa8e = $(this)["attr"](_0xc5648d(0x11f));
    $[_0xc5648d(0xf0)]({
      type: "POST",
      url: _0xc5648d(0x104),
      data: { id: _0x48aa8e },
      success: function (_0x3f9eea) {
        var _0x359eaf = _0xc5648d;
        $(_0x359eaf(0x113))[_0x359eaf(0xf5)](),
          (obj = JSON[_0x359eaf(0x139)](_0x3f9eea)),
          $(_0x359eaf(0x136))[_0x359eaf(0x111)](obj[_0x359eaf(0x118)]),
          $(".input-company")[_0x359eaf(0x111)](obj[_0x359eaf(0xff)]),
          $(_0x359eaf(0x12a))[_0x359eaf(0x11e)](_0x359eaf(0xe8), obj["vcode"]),
          $(_0x359eaf(0x119))[_0x359eaf(0x111)](obj["issuedby"]),
          $(_0x359eaf(0x13f))[_0x359eaf(0x111)](obj[_0x359eaf(0x13b)]),
          $(_0x359eaf(0x13d))["val"](obj[_0x359eaf(0x110)]),
          $(_0x359eaf(0x13c))[_0x359eaf(0x111)](obj[_0x359eaf(0x122)]),
          $(_0x359eaf(0x124))["val"](obj[_0x359eaf(0x109)]),
          $(_0x359eaf(0x130))["val"](obj["remarks"]),
          $(_0x359eaf(0x133))[_0x359eaf(0x111)](obj["status"]),
          $(_0x359eaf(0x10e))["val"](obj[_0x359eaf(0xfc)]),
          $(_0x359eaf(0xf7))[_0x359eaf(0x111)](obj["borfnumber"]),
          $(".input-bms")[_0x359eaf(0x111)](obj["bms"]),
          LoadSKU(),
          CheckStatus();
      },
    });
  });
}
function CheckStatus() {
  var _0x1ae03c = _0x91905d;
  $(".input-status")[_0x1ae03c(0x111)]() == "DRAFT"
    ? ($(".button-print")[_0x1ae03c(0x128)](_0x1ae03c(0x140)),
      $(".button-reopen")["hide"](),
      $(_0x1ae03c(0x130))[_0x1ae03c(0x10a)](_0x1ae03c(0x141), ![]),
      $(_0x1ae03c(0x10e))[_0x1ae03c(0x111)]() == _0x1ae03c(0xe1)
        ? ($(_0x1ae03c(0x123))[_0x1ae03c(0xf5)](),
          $(_0x1ae03c(0xf3))[_0x1ae03c(0xe7)]())
        : ($(_0x1ae03c(0x123))[_0x1ae03c(0xe7)](),
          $(_0x1ae03c(0xf3))[_0x1ae03c(0xf5)]()))
    : ($(_0x1ae03c(0x123))["html"]("Re-Print"),
      $(_0x1ae03c(0x12d))[_0x1ae03c(0xf5)](),
      $(_0x1ae03c(0xf3))[_0x1ae03c(0xe7)](),
      $(_0x1ae03c(0x130))["prop"](_0x1ae03c(0x141), !![]));
}
function LoadSKU() {
  var _0x4f16f9 = _0x91905d,
    _0x253926 = $(_0x4f16f9(0x13c))["val"](),
    _0x54104f = $(_0x4f16f9(0x12a))[_0x4f16f9(0x11e)]("vcode");
  $[_0x4f16f9(0xf0)]({
    type: _0x4f16f9(0x107),
    url: _0x4f16f9(0x11c),
    data: { f325number: _0x253926, vcode: _0x54104f },
    success: function (_0x47c5c3) {
      var _0x866a24 = _0x4f16f9;
      $(_0x866a24(0xf9))[_0x866a24(0x128)](_0x47c5c3), Subtotal();
    },
  });
}
function Subtotal() {
  var _0x3ba7fb = _0x91905d,
    _0x45c8f8 = 0x0;
  $(_0x3ba7fb(0xe5))[_0x3ba7fb(0x135)](function () {
    var _0x156322 = _0x3ba7fb;
    _0x45c8f8 += parseFloat($(this)[_0x156322(0x11e)](_0x156322(0x10f)));
  }),
    $(_0x3ba7fb(0x137))["val"](addCommas(_0x45c8f8[_0x3ba7fb(0x112)](0x2)));
}
function UpdateStatus() {
  var _0x562185 = _0x91905d,
    _0x519a5b = $(_0x562185(0x13c))[_0x562185(0x111)](),
    _0x5ef66d = $(_0x562185(0x130))[_0x562185(0x111)]();
  $[_0x562185(0xf0)]({
    type: "POST",
    url: _0x562185(0xf2),
    data: { f325number: _0x519a5b, remarks: _0x5ef66d },
    success: function (_0x2991d8) {
      var _0x4dcc3e = _0x562185;
      $(_0x4dcc3e(0x121))["html"](_0x2991d8),
        $(_0x4dcc3e(0x121))[_0x4dcc3e(0xf5)](),
        CloseForm(),
        LoadList(),
        setTimeout(function () {
          var _0x5ecfec = _0x4dcc3e;
          $(_0x5ecfec(0x121))["hide"]();
        }, 0x7d0);
    },
  });
}
function OnClickPrintFile() {
  $(document)["on"]("click", ".button-print", function () {
    var _0x175a46 = _0x1645,
      _0x409177 = $(_0x175a46(0x13c))[_0x175a46(0x111)](),
      _0x1b6057 = $(".input-status")[_0x175a46(0x111)](),
      _0x40ba13 = $(location)[_0x175a46(0x11e)](_0x175a46(0xfd)),
      _0x336935 =
        _0x175a46(0xfa) +
        _0x40ba13 +
        "/filepicture/dbapps/" +
        _0x409177 +
        _0x175a46(0xe4),
      _0x52878a = window[_0x175a46(0xe9)](_0x336935);
    setTimeout(function () {
      var _0x3f0b82 = _0x175a46;
      _0x52878a[_0x3f0b82(0xf1)](),
        _0x1b6057 == _0x3f0b82(0x11b) && UpdateStatus();
    }, 0x190);
  });
}
function OnClickDeleteF325() {
  var _0x11e8c0 = _0x91905d;
  $(document)["on"]("click", _0x11e8c0(0xf3), function () {
    var _0x193b22 = _0x11e8c0,
      _0x23ce66 = $(_0x193b22(0x13c))[_0x193b22(0x111)](),
      _0x21d1f9 = $(_0x193b22(0x120))[_0x193b22(0x111)]();
    $[_0x193b22(0xf0)]({
      type: "POST",
      url: _0x193b22(0x101),
      data: { f325number: _0x23ce66, bms: _0x21d1f9 },
      success: function (_0x275fac) {
        var _0x4fb789 = _0x193b22;
        $(_0x4fb789(0x121))[_0x4fb789(0x128)](_0x275fac),
          $(_0x4fb789(0x121))[_0x4fb789(0xf5)](),
          CloseForm(),
          LoadList(),
          setTimeout(function () {
            var _0x20e8d7 = _0x4fb789;
            $(_0x20e8d7(0x121))[_0x20e8d7(0xe7)]();
          }, 0x7d0);
      },
    });
  });
}
