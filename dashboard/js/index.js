$(document).ready(function () {
  ShowMenu();
  ShowMenuHover();
  Access();
  SelectCategory();
  ReloadPage();
});
function ReloadPage() {
  setTimeout(function () {
    window.location.reload();
  }, 900000);
}
$(document).mouseup(function (e) {
  var $menu = $(".div-menu-list");
  if (!$menu.is(e.target) && $menu.has(e.target).length === 0) {
    $menu.hide();
  }
});
function ShowMenuHover() {
  $(".span-text-menu").on("mouseenter", function () {
    $(".div-menu-list").css("background-color", "#F1F1F1");
    $(".div-menu-list").css("opacity", "1");
  });
  $(".span-text-menu").on("mouseleave", function () {
    $(".div-menu-list").css("background-color", "");
  });
}
function ShowMenu() {
  $(".button-menu").on("click", function () {
    $(".div-menu-list").toggle();
  });
}
function Access() {
  $(".img-icon").on("click", function () {
    var allowed = $(this).attr("active");
    var folder = $(this).attr("folder");
    if (allowed === "1") {
      if (folder === "formsetting") {
        $(".div-system-bg").show();
        $(".div-load-data").html("");
        $(".tbl-setting-td").css("background-Color", "");
      } else {
        //window.location.href = "/" + folder;
        window.location.href = "/f325.ramosco.net/" + folder;
      }
    } else {
      $(".div-notify-bg").show();
    }
  });
}
function LoadCompanyList() {
  $.ajax({
    url: "company/companylist.php",
    success: function (response) {
      $(".select-list-company").html(response);
      SelectCompany();
    },
  });
}
function SelectCategory() {
  $(document).on("click", ".tbl-button-menu-td", function () {
    $(".tbl-button-menu-td").css("background-Color", "");
    $(this).css("background-Color", "#cce5ff");
    var category = $(this).attr("category");
    if (category === "company") {
      $(".div-load-data").load("company/index.php");
      LoadCompanyList();
    } else if (category === "user") {
      $(".div-load-data").load("user/index.php");
    } else if (category === "location") {
      $(".div-load-data").load("location/index.php");
    } else if (category === "maintenance") {
      $(".div-load-data").load("maintenance/index.php");
      CurrentSetting();
    }
  });
}
function UnloadCompany() {
  $(".div-load-data").html("");
  $(".tbl-setting-td1").css("background-color", "");
  $(".div-system-bg").hide();
}

function SelectCompany() {
  var companyId = $(".select-list-company").val();
  $.ajax({
    type: "POST",
    url: "company/loaddetail.php",
    data: { id: companyId },
    success: function (response) {
      var obj = JSON.parse(response);
      $(".input-companyname").val(obj.name);
      $(".input-nickname").val(obj.nickname);
      $(".input-referencecode").val(obj.refcode);
      $(".input-vendorcode").val(obj.vendorcode);
      $(".textarea-address").val(obj.address);
      $(".input-bypass").prop("checked", obj.bypass == "1");
      $(".input-active").prop("checked", obj.active == "1");
    },
  });
}

function UpdateCompany() {
  var id = $(".select-list-company").val();
  var companyname = $(".input-companyname").val();
  var nickname = $(".input-nickname").val();
  var vendorcode = $(".input-vendorcode").val();
  var referencecode = $(".input-referencecode").val();
  var address = $(".textarea-address").val();
  var bypass = $(".input-bypass:checked").val();
  var isActive = $(".input-active:checked").val();

  $.ajax({
    type: "POST",
    url: "company/updatecompany.php",
    data: {
      id:  id, 
      name: companyname,
      nickname: nickname,
      vendorcode: vendorcode,
      referencecode: referencecode,
      address: address,
      bypass: bypass,
      active: isActive,
    },
    success: function () {
      $("#updateMessage").text("Company updated successfully!");
      $("#updateMessage").show();
      $("#companyForm input").val("");
      $("#companyForm").css("background-Color", "");
      setTimeout(function () {
        $("#updateMessage").hide();
      }, 2000);
    },
  });

  return false;
}

function CheckAdmin() {
  $.ajax({
    url: "users/checkadmin.php",
    success: function (response) {
      if (response == "admin") {
        $(".input-form-field").prop("disabled", false);
      } else {
        $(".input-admin").prop("disabled", true);

        if ($(".input-admin").is(":checked")) {
          $(".input-form-field").prop("disabled", true);
        } else {
          $(".input-form-field").prop("disabled", false);
        }
      }
    },
  });
}

function UnloadUser() {
  $("#userDetails").html("");
  $("#userPanel").css("background-Color", "");
  $(".div-system-bg").hide();
}

function SelectUser() {
  var pageId = $(".select-user").val();
  $.ajax({
    type: "POST",
    url: "user/loaddetail.php",
    data: { id: pageId },
    success: function (response) {
      var obj = JSON.parse(response);
      $(".input-username").val(obj.username);
      $(".input-password").val(obj.password);
      $(".input-email").val(obj.email);
      $(".input-fname").val(obj.fname);
      $.each(obj, function (key, value) {
        if (value == "1") {
          $(".input-" + key).prop("checked", true);
        } else {
          $(".input-" + key).prop("checked", false);
        }
      });
      CheckAdmin();
    },
  });
}

function OnsubmitUserValue() {
  var selectedUser = $(".select-user").val();

  if (selectedUser == "0") {
    $(".form-user").attr("onsubmit", "return SaveUser();");
    $(".btn-save").text("Save");
    $(".form-user")[0].reset();
  } else {
    $(".form-user").attr("onsubmit", "return UpdateUser();");
    $(".btn-save").text("Update");
  }
}

function NewUser() {
  var _0x3f3eda = _0x143b0a,
    _0x67d92f = $(_0x3f3eda(0x113))[_0x3f3eda(0x141)](),
    _0x2753ee = $(_0x3f3eda(0x14f))[_0x3f3eda(0x141)](),
    _0x53b296 = $(_0x3f3eda(0x119))[_0x3f3eda(0x141)](),
    _0x2fc36e = $(_0x3f3eda(0x1bc))[_0x3f3eda(0x141)](),
    _0x2b9a2d = $(_0x3f3eda(0x16c))[_0x3f3eda(0x141)](),
    _0x15fbdd = $(_0x3f3eda(0x11a))["val"](),
    _0x1f6b04 = $(_0x3f3eda(0x177))["val"](),
    _0x4bf836 = $(".input-comp3:checked")[_0x3f3eda(0x141)](),
    _0x245edf = $(_0x3f3eda(0x110))[_0x3f3eda(0x141)](),
    _0x34a717 = $(".input-comp5:checked")[_0x3f3eda(0x141)](),
    _0x1d7d71 = $(_0x3f3eda(0x17b))[_0x3f3eda(0x141)](),
    _0xae3741 = $(_0x3f3eda(0x136))["val"](),
    _0x877d03 = $(_0x3f3eda(0x161))["val"](),
    _0x352bea = $(_0x3f3eda(0x13f))[_0x3f3eda(0x141)](),
    _0x91110 = $(_0x3f3eda(0x14c))["val"](),
    _0x546c3b = $(_0x3f3eda(0x131))[_0x3f3eda(0x141)](),
    _0x14ee42 = $(_0x3f3eda(0x146))[_0x3f3eda(0x141)](),
    _0x348b81 = $(".input-loc3:checked")[_0x3f3eda(0x141)](),
    _0x2ed64c = $(".input-loc4:checked")[_0x3f3eda(0x141)](),
    _0x5d60cc = $(_0x3f3eda(0x17c))[_0x3f3eda(0x141)](),
    _0x214db9 = $(_0x3f3eda(0x18f))["val"](),
    _0x5c6467 = $(_0x3f3eda(0x117))[_0x3f3eda(0x141)](),
    _0x3d7852 = $(_0x3f3eda(0x10d))["val"](),
    _0x1da5c0 = $(".input-loc9:checked")[_0x3f3eda(0x141)](),
    _0x92b160 = $(_0x3f3eda(0x15b))[_0x3f3eda(0x141)](),
    _0x268b89 = $(_0x3f3eda(0x15f))[_0x3f3eda(0x141)](),
    _0x56c320 = $(_0x3f3eda(0x1ae))[_0x3f3eda(0x141)](),
    _0x191a2a = $(_0x3f3eda(0x14d))[_0x3f3eda(0x141)](),
    _0x3d893c = $(_0x3f3eda(0x19d))["val"](),
    _0x19ffb7 = $(_0x3f3eda(0x172))["val"](),
    _0x5d2705 = $(_0x3f3eda(0x1a0))[_0x3f3eda(0x141)](),
    _0x31f420 = $(_0x3f3eda(0x157))["val"](),
    _0xa8bac = $(_0x3f3eda(0x19b))["val"](),
    _0x30f390 = $(_0x3f3eda(0x19a))[_0x3f3eda(0x141)](),
    _0x28343c = $(_0x3f3eda(0x1c2))[_0x3f3eda(0x141)](),
    _0x605022 = $(_0x3f3eda(0x1a3))[_0x3f3eda(0x141)](),
    _0x5db172 = $(".input-deduction:checked")[_0x3f3eda(0x141)](),
    _0x4cf95b = $(_0x3f3eda(0x171))["val"](),
    _0x57d614 = $(_0x3f3eda(0x180))["val"](),
    _0x17a1e4 = $(_0x3f3eda(0x11c))[_0x3f3eda(0x141)](),
    _0x4803e5 = $(_0x3f3eda(0x147))[_0x3f3eda(0x141)](),
    _0x17fe20 = $(".input-pulloutdoc:checked")[_0x3f3eda(0x141)](),
    _0x1cc07b = $(_0x3f3eda(0x13a))[_0x3f3eda(0x141)](),
    _0xd1ac70 = $(".input-syssetting:checked")[_0x3f3eda(0x141)](),
    _0x565a9e = $(".input-active:checked")[_0x3f3eda(0x141)]();
  return (
    $[_0x3f3eda(0x168)]({
      type: "POST",
      beforeSend: function () {
        var _0x1e6ab = _0x3f3eda;
        $(_0x1e6ab(0x188))[_0x1e6ab(0x193)](_0x1e6ab(0x139), !![]),
          $(".input-username")[_0x1e6ab(0x193)](_0x1e6ab(0x139), !![]),
          $(".input-password")[_0x1e6ab(0x193)](_0x1e6ab(0x139), !![]),
          $(_0x1e6ab(0x150))[_0x1e6ab(0x193)]("disabled", !![]);
      },
      url: _0x3f3eda(0x170),
      data: {
        username: _0x67d92f,
        password: _0x2753ee,
        fname: _0x53b296,
        admin: _0x2fc36e,
        semiadmin: _0x2b9a2d,
        comp1: _0x15fbdd,
        comp2: _0x1f6b04,
        comp3: _0x4bf836,
        comp4: _0x245edf,
        comp5: _0x34a717,
        comp6: _0x1d7d71,
        comp7: _0xae3741,
        comp8: _0x877d03,
        comp9: _0x352bea,
        comp10: _0x91110,
        loc1: _0x546c3b,
        loc2: _0x14ee42,
        loc3: _0x348b81,
        loc4: _0x2ed64c,
        loc5: _0x5d60cc,
        loc6: _0x214db9,
        loc7: _0x5c6467,
        loc8: _0x3d7852,
        loc9: _0x1da5c0,
        loc10: _0x92b160,
        store: _0x268b89,
        inventory: _0x56c320,
        upload: _0x191a2a,
        importdop: _0x3d893c,
        print: _0x19ffb7,
        schedule: _0x5d2705,
        clearing: _0x31f420,
        manual: _0xa8bac,
        fordeduct: _0x30f390,
        borfapps: _0x28343c,
        dmpiraw: _0x605022,
        deduction: _0x5db172,
        deductdoc: _0x4cf95b,
        paiddeduction: _0x57d614,
        payment: _0x17a1e4,
        rts: _0x4803e5,
        pulloutdoc: _0x17fe20,
        report: _0x1cc07b,
        system: _0xd1ac70,
        active: _0x565a9e,
      },
      success: function () {
        var _0x75767d = _0x3f3eda;
        $(_0x75767d(0x179))[_0x75767d(0x149)](_0x75767d(0x142)),
          $(_0x75767d(0x179))[_0x75767d(0x156)](),
          setTimeout(function () {
            var _0x263d7a = _0x75767d;
            $(_0x263d7a(0x1b0))[_0x263d7a(0x1a4)](_0x263d7a(0x1c0)),
              $(_0x263d7a(0x179))[_0x263d7a(0x126)]();
          }, 0x7d0);
      },
    }),
    ![]
  );
}
function UpdateUser() {
  var _0x583f16 = _0x143b0a,
    _0x45a1f2 = $(_0x583f16(0x188))["val"](),
    _0x1f5ba7 = $(_0x583f16(0x113))[_0x583f16(0x141)](),
    _0x5aabf4 = $(_0x583f16(0x14f))["val"](),
    _0x37152e = $(_0x583f16(0x119))["val"](),
    _0x781872 = $(".input-admin:checked")[_0x583f16(0x141)](),
    _0x5ee540 = $(".input-semiadmin:checked")[_0x583f16(0x141)](),
    _0xc8d77f = $(_0x583f16(0x11a))[_0x583f16(0x141)](),
    _0x29e7f1 = $(".input-comp2:checked")["val"](),
    _0x121256 = $(".input-comp3:checked")["val"](),
    _0x424682 = $(_0x583f16(0x110))[_0x583f16(0x141)](),
    _0x3ef5c1 = $(_0x583f16(0x144))[_0x583f16(0x141)](),
    _0xb72af6 = $(".input-comp6:checked")[_0x583f16(0x141)](),
    _0x9afafc = $(_0x583f16(0x136))[_0x583f16(0x141)](),
    _0x32f9b0 = $(_0x583f16(0x161))[_0x583f16(0x141)](),
    _0x37af22 = $(_0x583f16(0x13f))[_0x583f16(0x141)](),
    _0x44d3f1 = $(_0x583f16(0x14c))[_0x583f16(0x141)](),
    _0x3e700a = $(_0x583f16(0x131))[_0x583f16(0x141)](),
    _0x3fc6ca = $(_0x583f16(0x146))[_0x583f16(0x141)](),
    _0xddae9c = $(_0x583f16(0x186))[_0x583f16(0x141)](),
    _0x53205e = $(_0x583f16(0x16b))[_0x583f16(0x141)](),
    _0x4a4600 = $(_0x583f16(0x17c))[_0x583f16(0x141)](),
    _0x15d9fe = $(_0x583f16(0x18f))["val"](),
    _0xf72460 = $(_0x583f16(0x117))[_0x583f16(0x141)](),
    _0x1a2185 = $(_0x583f16(0x10d))["val"](),
    _0x534e33 = $(_0x583f16(0x135))[_0x583f16(0x141)](),
    _0x179676 = $(".input-loc10:checked")[_0x583f16(0x141)](),
    _0x17e939 = $(".input-store:checked")[_0x583f16(0x141)](),
    _0x583f9e = $(_0x583f16(0x1ae))["val"](),
    _0x5d2066 = $(_0x583f16(0x14d))[_0x583f16(0x141)](),
    _0x158eae = $(_0x583f16(0x19d))["val"](),
    _0x561274 = $(_0x583f16(0x172))[_0x583f16(0x141)](),
    _0x1c9974 = $(_0x583f16(0x1a0))[_0x583f16(0x141)](),
    _0x6723c3 = $(".input-clearing:checked")[_0x583f16(0x141)](),
    _0x42457a = $(_0x583f16(0x19a))[_0x583f16(0x141)](),
    _0x3831b8 = $(_0x583f16(0x1c2))[_0x583f16(0x141)](),
    _0x6a3868 = $(_0x583f16(0x19b))[_0x583f16(0x141)](),
    _0x159f86 = $(_0x583f16(0x1a3))[_0x583f16(0x141)](),
    _0x507a0f = $(_0x583f16(0x1ba))[_0x583f16(0x141)](),
    _0x2007fe = $(_0x583f16(0x171))[_0x583f16(0x141)](),
    _0x41f3c3 = $(_0x583f16(0x180))["val"](),
    _0x515c27 = $(".input-payment:checked")[_0x583f16(0x141)](),
    _0x472424 = $(_0x583f16(0x147))[_0x583f16(0x141)](),
    _0x39e170 = $(_0x583f16(0x1a6))["val"](),
    _0x774f58 = $(_0x583f16(0x13a))[_0x583f16(0x141)](),
    _0x445800 = $(_0x583f16(0x191))[_0x583f16(0x141)](),
    _0x1e84b = $(_0x583f16(0x129))[_0x583f16(0x141)]();
  return (
    $["ajax"]({
      type: _0x583f16(0x114),
      url: 'user/newuser.php',
      data: {
        id: _0x45a1f2,
        username: _0x1f5ba7,
        password: _0x5aabf4,
        fname: _0x37152e,
        admin: _0x781872,
        semiadmin: _0x5ee540,
        comp1: _0xc8d77f,
        comp2: _0x29e7f1,
        comp3: _0x121256,
        comp4: _0x424682,
        comp5: _0x3ef5c1,
        comp6: _0xb72af6,
        comp7: _0x9afafc,
        comp8: _0x32f9b0,
        comp9: _0x37af22,
        comp10: _0x44d3f1,
        loc1: _0x3e700a,
        loc2: _0x3fc6ca,
        loc3: _0xddae9c,
        loc4: _0x53205e,
        loc5: _0x4a4600,
        loc6: _0x15d9fe,
        loc7: _0xf72460,
        loc8: _0x1a2185,
        loc9: _0x534e33,
        loc10: _0x179676,
        store: _0x17e939,
        inventory: _0x583f9e,
        upload: _0x5d2066,
        importdop: _0x158eae,
        print: _0x561274,
        schedule: _0x1c9974,
        clearing: _0x6723c3,
        manual: _0x6a3868,
        fordeduct: _0x42457a,
        borfapps: _0x3831b8,
        dmpiraw: _0x159f86,
        deduction: _0x507a0f,
        deductdoc: _0x2007fe,
        paiddeduction: _0x41f3c3,
        payment: _0x515c27,
        rts: _0x472424,
        pulloutdoc: _0x39e170,
        report: _0x774f58,
        system: _0x445800,
        active: _0x1e84b,
      },
      success: function () {
        var _0x38da39 = _0x583f16;
        $(_0x38da39(0x179))["html"](_0x38da39(0x148)),
          $(_0x38da39(0x179))[_0x38da39(0x156)](),
          $(".div-load-data")["html"](""),
          $(_0x38da39(0x1b2))[_0x38da39(0x1b7)]("background-Color", ""),
          setTimeout(function () {
            var _0x16f040 = _0x38da39;
            $(".span-notify-alert")[_0x16f040(0x126)]();
          }, 0x7d0);
      },
    }),
    ![]
  );
}
function _0x157f(_0x1eb003, _0x1e84c6) {
  var _0x3b6337 = _0x3b63();
  return (
    (_0x157f = function (_0x157f04, _0x580e42) {
      _0x157f04 = _0x157f04 - 0x109;
      var _0x1cf8a2 = _0x3b6337[_0x157f04];
      return _0x1cf8a2;
    }),
    _0x157f(_0x1eb003, _0x1e84c6)
  );
}
function LoadLocation() {
  $.ajax({
    url: "location/listlocation.php",
    success: function (response) {
      $(".tbody-list-location").html(response);
    },
  });
}

function UnloadLocation() {
  $(".div-load-data").html("");
  $(".tbl-button-menu-td").css("background-Color", "");
  $(".some-element").hide();
}

function UpdateLocation() {
  var _0x26b278 = _0x143b0a;
  return (
    $(_0x26b278(0x1bb))[_0x26b278(0x134)](function () {
      var _0x30b4fa = _0x26b278,
        _0x3cb0f9 = $(this)[_0x30b4fa(0x1b9)](_0x30b4fa(0x162)),
        _0x4ba5b7 = $(this)[_0x30b4fa(0x141)](),
        _0x3be2be = $(this)
          [_0x30b4fa(0x19e)]("tr")
          ["find"](_0x30b4fa(0x115))
          [_0x30b4fa(0x141)]();
      $[_0x30b4fa(0x168)]({
        type: _0x30b4fa(0x114),
        url: _0x30b4fa(0x1a5),
        data: { id: _0x3cb0f9, value: _0x4ba5b7, active: _0x3be2be },
        success: function () {},
      });
    }),
    $(_0x26b278(0x1b0))[_0x26b278(0x149)](""),
    $(_0x26b278(0x1b2))[_0x26b278(0x1b7)](_0x26b278(0x166), ""),
    ![]
  );
}
function ShowImport() {
  $(".div-import-bg").show();
  $(".div-import").show();
}

function CloseImport() {
  var _0x23c130 = _0x143b0a;
  $(_0x23c130(0x137))[_0x23c130(0x126)]();
}
function SelectFile() {
  var _0xa72d23 = _0x143b0a;
  $(".UploadCsvFile")[_0xa72d23(0x158)]();
}
function FileLocation() {
  var _0x1e0e58 = _0x143b0a,
    _0x136e32 = $(".UploadCsvFile")["val"]();
  $(_0x1e0e58(0x184))[_0x1e0e58(0x141)](_0x136e32);
}
var clear_timer;
function UploadCSV() {
  var _0x4d086e = _0x143b0a,
    _0x593b29 = new FormData(),
    _0x59405b = $(".UploadCsvFile")[0x0][_0x4d086e(0x182)][0x0];
  return (
    _0x593b29[_0x4d086e(0x176)](_0x4d086e(0x1bd), _0x59405b),
    $[_0x4d086e(0x168)]({
      type: _0x4d086e(0x114),
      beforeSend: function () {
        var _0x784e24 = _0x4d086e;
        $(".select-datatype")[_0x784e24(0x193)](_0x784e24(0x139), !![]),
          $(_0x784e24(0x122))[_0x784e24(0x193)](_0x784e24(0x139), !![]),
          $(_0x784e24(0x184))[_0x784e24(0x193)](_0x784e24(0x139), !![]),
          $(_0x784e24(0x13c))["prop"](_0x784e24(0x139), !![]),
          $(_0x784e24(0x13e))[_0x784e24(0x193)](_0x784e24(0x139), !![]);
        var _0x36854c = $(_0x784e24(0x122))[_0x784e24(0x141)]();
        if (_0x36854c == "1") {
          var _0x4af1b4 = $(_0x784e24(0x1c1))["val"]();
          $[_0x784e24(0x168)]({
            type: _0x784e24(0x114),
            url: _0x784e24(0x1c3),
            data: { dataType: _0x4af1b4 },
            success: function () {},
          });
        }
      },
      url: _0x4d086e(0x1ac),
      data: _0x593b29,
      dataType: _0x4d086e(0x10f),
      contentType: ![],
      cache: ![],
      processData: ![],
      success: function (_0x2b293b) {
        setTimeout(function () {
          var _0x33b8c6 = _0x157f;
          _0x2b293b["success"] &&
            ($(_0x33b8c6(0x184))[_0x33b8c6(0x1b9)](
              _0x33b8c6(0x18a),
              _0x2b293b[_0x33b8c6(0x1b3)]
            ),
            Start_Import(),
            $(_0x33b8c6(0x10e))["show"](),
            (clear_timer = setInterval(count_import_data, 0x3e8))),
            _0x2b293b[_0x33b8c6(0x16f)] &&
              ($(_0x33b8c6(0x179))[_0x33b8c6(0x149)](
                _0x2b293b[_0x33b8c6(0x16f)]
              ),
              $(_0x33b8c6(0x179))[_0x33b8c6(0x156)](),
              setTimeout(function () {
                var _0x3a4f5c = _0x33b8c6;
                $(_0x3a4f5c(0x179))[_0x3a4f5c(0x126)]();
              }, 0x7d0),
              $(_0x33b8c6(0x184))[_0x33b8c6(0x141)](""),
              $(_0x33b8c6(0x1be))["val"](""),
              $(_0x33b8c6(0x1c1))["prop"](_0x33b8c6(0x139), ![]),
              $(_0x33b8c6(0x122))[_0x33b8c6(0x193)](_0x33b8c6(0x139), ![]),
              $(".input-path")[_0x33b8c6(0x193)](_0x33b8c6(0x139), ![]),
              $(".input-browse")["prop"](_0x33b8c6(0x139), ![]),
              $(_0x33b8c6(0x13e))[_0x33b8c6(0x193)](_0x33b8c6(0x139), ![]),
              $[_0x33b8c6(0x168)]({
                url: "upload/filedelete.php",
                success: function () {},
              }));
        }, 0x7d0);
      },
    }),
    ![]
  );
}
function Start_Import() {
  var _0x5a1a9b = _0x143b0a,
    _0x325ec9 = $(_0x5a1a9b(0x1c1))["val"]();
  $["ajax"]({
    url: _0x5a1a9b(0x145) + _0x325ec9 + ".php",
    success: function () {},
  });
}
function _0x3b63() {
  var _0x4367cd = [
    ".input-maintenance-session",
    "attr",
    ".input-deduction:checked",
    ".input-location",
    ".input-admin:checked",
    "file",
    ".UploadCsvFile",
    ".button-menu,.span-text-menu",
    "user/index.php",
    ".select-datatype",
    ".input-borfapps:checked",
    "upload/resetdb.php",
    "maintenance/index.php",
    "ready",
    ".textarea-address",
    "addnew",
    ".input-loc8:checked",
    ".tbl-import-form-td4",
    "json",
    ".input-comp4:checked",
    "Change\x20successfully!",
    "href",
    ".input-username",
    "POST",
    ".input-checkbox-active:checked",
    "bypass",
    ".input-loc7:checked",
    "width",
    ".input-fname",
    ".input-comp1:checked",
    "user/updateuser.php",
    ".input-payment:checked",
    ".input-companyname",
    ".div-menu-list",
    ".img-icon",
    "password",
    "7PBHmWE",
    ".select-process",
    "344XAuTAv",
    "Imported\x20successfully!",
    "return\x20NewUser();",
    "hide",
    ".tbl-button-menu-td",
    "nickname",
    ".input-active:checked",
    "2355150EHHzXW",
    "company/loaddetail.php",
    "location",
    ".div-notify-bg",
    "1976VfAjUk",
    "session",
    "parse",
    ".input-loc1:checked",
    "length",
    ".input-",
    "each",
    ".input-loc9:checked",
    ".input-comp7:checked",
    ".div-import-bg",
    ".input-referencecode",
    "disabled",
    ".input-report:checked",
    ".textarea-msg",
    ".input-browse",
    ".select-company",
    ".button-tableBottom-Style",
    ".input-comp9:checked",
    "upload/filedelete.php",
    "val",
    "Added\x20successfully!",
    ".div-bg-change-password",
    ".input-comp5:checked",
    "upload/",
    ".input-loc2:checked",
    ".input-rts:checked",
    "Update\x20successfully!",
    "html",
    ".input-maintenance-announcement",
    "12148981VVCBgv",
    ".input-comp10:checked",
    ".input-import:checked",
    "5jBIBSa",
    ".input-password",
    ".input-checkbox",
    "maintenance/loadsetting.php",
    "1242zPBYTv",
    ".input-active",
    "user",
    ".input-form-field",
    "show",
    ".input-clearing:checked",
    "click",
    "3452hNFakF",
    ".input-newpassword",
    ".input-loc10:checked",
    "mouseleave",
    ".input-maintenance-session:checked",
    "8478173phDSNC",
    ".input-store:checked",
    "370oPqlEP",
    ".input-comp8:checked",
    "locid",
    "true",
    ":checked",
    "category",
    "background-Color",
    "company",
    "ajax",
    "lightgray",
    "refcode",
    ".input-loc4:checked",
    ".input-semiadmin:checked",
    "2817tfTBvO",
    ".button-user-save",
    "error",
    "user/newuser.php",
    ".input-deductdoc:checked",
    ".input-print:checked",
    "round",
    "#5a5a5a",
    "12gAjmdm",
    "append",
    ".input-comp2:checked",
    "announcement",
    ".span-notify-alert",
    "toggle",
    ".input-comp6:checked",
    ".input-loc5:checked",
    "upload/count.php",
    ".select-list-company",
    "user/changepassword.php",
    ".input-paiddeduction:checked",
    "fname",
    "files",
    "user/loaddetail.php",
    ".input-path",
    "checked",
    ".input-loc3:checked",
    ".tbody-list-location",
    ".select-user",
    "maintenance",
    "totalline",
    "user/checkadmin.php",
    ".input-maintenance-id",
    "mouseover",
    ".input-maintenance-announcement:checked",
    ".input-loc6:checked",
    ".button-menu",
    ".input-syssetting:checked",
    "location/listlocation.php",
    "prop",
    ".form-user",
    ".input-nickname",
    "11068344YqDdEI",
    "Update",
    ".input-admin",
    "maintenance/maintenanceupdate.php",
    ".input-fordeduct:checked",
    ".input-manual:checked",
    "reload",
    ".input-importdop:checked",
    "closest",
    "active",
    ".input-schedule:checked",
    ".span-text-menu",
    ".input-vendorcode",
    ".input-dmpiraw:checked",
    "load",
    "location/updatelocation.php",
    ".input-pulloutdoc:checked",
    "company/companylist.php",
    "location/index.php",
    "0.5",
    ".div-loading-bar",
    "target",
    "upload/csvfile.php",
    "onsubmit",
    ".input-inventory:checked",
    "formsetting",
    ".div-load-data",
    ".div-system-bg",
    ".tbl-setting-td",
    "total_line",
    "vendorcode",
    "mouseup",
    ".input-bypass",
    "css",
  ];
  _0x3b63 = function () {
    return _0x4367cd;
  };
  return _0x3b63();
}
function count_import_data() {
  var _0x16ad5e = _0x143b0a,
    _0x1975da = $(".select-datatype")["val"]();
  $[_0x16ad5e(0x168)]({
    type: "POST",
    url: _0x16ad5e(0x17d),
    data: { dataType: _0x1975da },
    success: function (_0x379e3f) {
      var _0x62196e = _0x16ad5e,
        _0x3a8d0f = $(_0x62196e(0x184))[_0x62196e(0x1b9)](_0x62196e(0x18a)),
        _0x352cf3 = Math[_0x62196e(0x173)]((_0x379e3f / _0x3a8d0f) * 0x64);
      $(_0x62196e(0x1aa))[_0x62196e(0x1b7)](_0x62196e(0x118), _0x352cf3 + "%"),
        $(_0x62196e(0x1aa))[_0x62196e(0x149)](_0x352cf3 + "%"),
        _0x352cf3 >= 0x64 &&
          ($[_0x62196e(0x168)]({
            url: _0x62196e(0x140),
            success: function () {},
          }),
          clearInterval(clear_timer),
          $(_0x62196e(0x179))[_0x62196e(0x149)](_0x62196e(0x124)),
          $(_0x62196e(0x179))[_0x62196e(0x156)](),
          setTimeout(function () {
            var _0x7f6678 = _0x62196e;
            $(".span-notify-alert")[_0x7f6678(0x126)]();
          }, 0x7d0),
          $(_0x62196e(0x184))["val"](""),
          $(_0x62196e(0x1be))[_0x62196e(0x141)](""),
          $(_0x62196e(0x1c1))[_0x62196e(0x193)]("disabled", ![]),
          $(_0x62196e(0x122))[_0x62196e(0x193)]("disabled", ![]),
          $(".input-path")[_0x62196e(0x193)]("disabled", ![]),
          $(".input-browse")[_0x62196e(0x193)]("disabled", ![]),
          $(_0x62196e(0x13e))[_0x62196e(0x193)](_0x62196e(0x139), ![]),
          $(_0x62196e(0x10e))[_0x62196e(0x126)]());
    },
  });
}
function ShowPassword() {
  var _0x5307ca = _0x143b0a;
  $(_0x5307ca(0x11e))["hide"](),
    $(_0x5307ca(0x143))["show"](),
    $(_0x5307ca(0x15a))[_0x5307ca(0x193)](_0x5307ca(0x139), ![]);
}
function HidePassword() {
  var _0x1c69a4 = _0x143b0a;
  $(_0x1c69a4(0x143))["hide"]();
}
function ChangePassword() {
  var _0xeaf5a0 = _0x143b0a,
    _0x162105 = $(".input-username")[_0xeaf5a0(0x141)](),
    _0x5952ea = $(_0xeaf5a0(0x15a))[_0xeaf5a0(0x141)]();
  return (
    $[_0xeaf5a0(0x168)]({
      type: _0xeaf5a0(0x114),
      beforeSend: function () {
        var _0x3391d6 = _0xeaf5a0;
        $(_0x3391d6(0x15a))[_0x3391d6(0x193)]("disabled", !![]);
      },
      url: _0xeaf5a0(0x17f),
      data: { username: _0x162105, newpassword: _0x5952ea },
      success: function () {
        var _0x1453cf = _0xeaf5a0;
        HidePassword(),
          $(_0x1453cf(0x179))[_0x1453cf(0x149)](_0x1453cf(0x111)),
          $(".span-notify-alert")[_0x1453cf(0x156)](),
          setTimeout(function () {
            var _0x42b47c = _0x1453cf;
            $(_0x42b47c(0x179))[_0x42b47c(0x126)]();
          }, 0x7d0);
      },
    }),
    ![]
  );
}
function CurrentSetting() {
  var _0x7a71f1 = _0x143b0a;
  $[_0x7a71f1(0x168)]({
    url: _0x7a71f1(0x151),
    success: function (_0x1ef958) {
      var _0x103b80 = _0x7a71f1;
      (obj = JSON["parse"](_0x1ef958)),
        $(".input-maintenance-id")[_0x103b80(0x141)](obj["id"]),
        $(_0x103b80(0x13b))[_0x103b80(0x141)](obj["msg"]),
        obj[_0x103b80(0x12f)] == 0x1
          ? $(_0x103b80(0x1b8))[_0x103b80(0x193)](_0x103b80(0x185), !![])
          : $(_0x103b80(0x1b8))[_0x103b80(0x193)](_0x103b80(0x185), ![]),
        obj[_0x103b80(0x178)] == "1"
          ? $(".input-maintenance-announcement")[_0x103b80(0x193)](
              "checked",
              !![]
            )
          : $(_0x103b80(0x14a))[_0x103b80(0x193)]("checked", ![]),
        AllowEditAnnouncement(),
        OnChangeAnnouncement();
    },
  });
}
function MaintenanceUpdate() {
  var _0x529887 = _0x143b0a,
    _0x7f46c7 = $(_0x529887(0x18c))["val"](),
    _0x98721d = $(_0x529887(0x15d))[_0x529887(0x141)](),
    _0x52c458 = $(_0x529887(0x18e))[_0x529887(0x141)](),
    _0x10f7b7 = $(_0x529887(0x13b))["val"]();
  return (
    $[_0x529887(0x168)]({
      type: _0x529887(0x114),
      url: _0x529887(0x199),
      data: {
        id: _0x7f46c7,
        session: _0x98721d,
        announcement: _0x52c458,
        msg: _0x10f7b7,
      },
      success: function (_0x103302) {
        var _0x543c1b = _0x529887;
        $(_0x543c1b(0x179))[_0x543c1b(0x149)](_0x103302),
          $(_0x543c1b(0x179))[_0x543c1b(0x156)](),
          setTimeout(function () {
            var _0x351a82 = _0x543c1b;
            $(_0x351a82(0x179))[_0x351a82(0x126)]();
          }, 0x7d0);
      },
    }),
    ![]
  );
}
function OnChangeAnnouncement() {
  var _0x2845c3 = _0x143b0a;
  $(document)["on"]("change", _0x2845c3(0x14a), function () {
    AllowEditAnnouncement();
  });
}
function AllowEditAnnouncement() {
  var _0x6c1cb3 = _0x143b0a;
  $(_0x6c1cb3(0x14a))["is"](":checked")
    ? $(_0x6c1cb3(0x13b))[_0x6c1cb3(0x193)](_0x6c1cb3(0x139), ![])
    : $(_0x6c1cb3(0x13b))["prop"]("disabled", !![]);
}
