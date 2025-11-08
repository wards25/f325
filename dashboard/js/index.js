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
      id: id,
      name: companyname,
      nickname: nickname,
      vendorcode: vendorcode,
      referencecode: referencecode,
      address: address,
      bypass: bypass,
      active: isActive,
    },
    success: function () {
      $(".span-notify-alert").text("Company updated successfully!");
      $(".span-notify-alert").show();
      $(".form-company").css("background-Color", "");
      $(".div-load-data").html("");
      setTimeout(function () {
        $(".span-notify-alert").fadeOut();
      }, 2000);
    },
  });

  return false;
}

function CheckAdmin() {
  $.ajax({
    url: "user/checkadmin.php",
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
  var username = $(".input-username").val();
  var password = $(".input-password").val();
  var fname = $(".input-fname").val();
  var admin = $(".input-admin:checked").val();
  var semiadmin = $(".input-semiadmin:checked").val();
  var comp1 = $(".input-comp1:checked").val();
  var comp2 = $(".input-comp2:checked").val();
  var comp3 = $(".input-comp3:checked").val();
  var comp4 = $(".input-comp4:checked").val();
  var comp5 = $(".input-comp5:checked").val();
  var comp6 = $(".input-comp6:checked").val();
  var comp7 = $(".input-comp7:checked").val();
  var comp8 = $(".input-comp8:checked").val();
  var comp9 = $(".input-comp9:checked").val();
  var comp10 = $(".input-comp10:checked").val();
  var loc1 = $(".input-loc1:checked").val();
  var loc2 = $(".input-loc2:checked").val();
  var loc3 = $(".input-loc3:checked").val();
  var loc4 = $(".input-loc4:checked").val();
  var loc5 = $(".input-loc5:checked").val();
  var loc6 = $(".input-loc6:checked").val();
  var loc7 = $(".input-loc7:checked").val();
  var loc8 = $(".input-loc8:checked").val();
  var loc9 = $(".input-loc9:checked").val();
  var loc10 = $(".input-loc10:checked").val();
  var store = $(".input-store:checked").val();
  var inventory = $(".input-inventory:checked").val();
  var upload = $(".input-import:checked").val();
  var importdop = $(".input-importdop:checked").val();
  var print = $(".input-print:checked").val();
  var schedule = $(".input-schedule:checked").val();
  var clearing = $(".input-clearing:checked").val();
  var fordeduct = $(".input-fordeduct:checked").val();
  var borfapps = $(".input-borfapps:checked").val();
  var manual = $(".input-manual:checked").val();
  var dmpiraw = $(".input-dmpiraw:checked").val();
  var deduction = $(".input-deduction:checked").val();
  var deductdoc = $(".input-deductdoc:checked").val();
  var paiddeduction = $(".input-paiddeduction:checked").val();
  var payment = $(".input-payment:checked").val();
  var rts = $(".input-rts:checked").val();
  var pulloutdoc = $(".input-pulloutdoc:checked").val();
  var report = $(".input-report:checked").val();
  var system = $(".input-syssetting:checked").val();
  var isActive = $(".input-active:checked").val();
  $.ajax({
    type: "POST",
    url: "user/newuser.php",
    data: {
      username: username,
      password: password,
      fname: fname,
      admin: admin,
      semiadmin: semiadmin,
      comp1: comp1,
      comp2: comp2,
      comp3: comp3,
      comp4: comp4,
      comp5: comp5,
      comp6: comp6,
      comp7: comp7,
      comp8: comp8,
      comp9: comp9,
      comp10: comp10,
      loc1: loc1,
      loc2: loc2,
      loc3: loc3,
      loc4: loc4,
      loc5: loc5,
      loc6: loc6,
      loc7: loc7,
      loc8: loc8,
      loc9: loc9,
      loc10: loc10,
      store: store,
      inventory: inventory,
      upload: upload,
      importdop: importdop,
      print: print,
      schedule: schedule,
      clearing: clearing,
      manual: manual,
      fordeduct: fordeduct,
      borfapps: borfapps,
      dmpiraw: dmpiraw,
      deduction: deduction,
      deductdoc: deductdoc,
      paiddeduction: paiddeduction,
      payment: payment,
      rts: rts,
      pulloutdoc: pulloutdoc,
      report: report,
      system: system,
      active: isActive,
    },
    success: function () {
      $(".span-notify-alert").html("User successfully added!").show();
      $(".div-load-data").html("");
      $(".span-notify-alert").css("background-color", "");
      setTimeout(function () {
        $(".span-notify-alert").fadeOut();
      }, 2000);
    },
    error: function () {
      alert("Error: Failed to add user.");
    },
  });
  return false;
}

function UpdateUser() {
  var pageId = $(".select-user").val();
  var username = $(".input-username").val();
  var password = $(".input-password").val();
  var fname = $(".input-fname").val();
  var admin = $(".input-admin:checked").val();
  var semiadmin = $(".input-semiadmin:checked").val();
  var comp1 = $(".input-comp1:checked").val();
  var comp2 = $(".input-comp2:checked").val();
  var comp3 = $(".input-comp3:checked").val();
  var comp4 = $(".input-comp4:checked").val();
  var comp5 = $(".input-comp5:checked").val();
  var comp6 = $(".input-comp6:checked").val();
  var comp7 = $(".input-comp7:checked").val();
  var comp8 = $(".input-comp8:checked").val();
  var comp9 = $(".input-comp9:checked").val();
  var comp10 = $(".input-comp10:checked").val();
  var loc1 = $(".input-loc1:checked").val();
  var loc2 = $(".input-loc2:checked").val();
  var loc3 = $(".input-loc3:checked").val();
  var loc4 = $(".input-loc4:checked").val();
  var loc5 = $(".input-loc5:checked").val();
  var loc6 = $(".input-loc6:checked").val();
  var loc7 = $(".input-loc7:checked").val();
  var loc8 = $(".input-loc8:checked").val();
  var loc9 = $(".input-loc9:checked").val();
  var loc10 = $(".input-loc10:checked").val();
  var store = $(".input-store:checked").val();
  var inventory = $(".input-inventory:checked").val();
  var upload = $(".input-upload:checked").val();
  var imp = $(".input-import:checked").val();
  var importdop = $(".input-importdop:checked").val();
  var print = $(".input-print:checked").val();
  var schedule = $(".input-schedule:checked").val();
  var clearing = $(".input-clearing:checked").val();
  var fordeduct = $(".input-fordeduct:checked").val();
  var borfapps = $(".input-borfapps:checked").val();
  var manual = $(".input-manual:checked").val();
  var dmpiraw = $(".input-dmpiraw:checked").val();
  var deduction = $(".input-deduction:checked").val();
  var deductdoc = $(".input-deductdoc:checked").val();
  var paiddeduction = $(".input-paiddeduction:checked").val();
  var payment = $(".input-payment:checked").val();
  var rts = $(".input-rts:checked").val();
  var pulloutdoc = $(".input-pulloutdoc:checked").val();
  var report = $(".input-report:checked").val();
  var system = $(".input-system:checked").val();
  var isActive = $(".input-active:checked").val();
  $.ajax({
    type: "POST",
    url: "user/updateuser.php",
    data: {
      id: pageId,
      username: username,
      password: password,
      fname: fname,
      admin: admin,
      semiadmin: semiadmin,
      comp1: comp1,
      comp2: comp2,
      comp3: comp3,
      comp4: comp4,
      comp5: comp5,
      comp6: comp6,
      comp7: comp7,
      comp8: comp8,
      comp9: comp9,
      comp10: comp10,
      loc1: loc1,
      loc2: loc2,
      loc3: loc3,
      loc4: loc4,
      loc5: loc5,
      loc6: loc6,
      loc7: loc7,
      loc8: loc8,
      loc9: loc9,
      loc10: loc10,
      store: store,
      inventory: inventory,
      upload: upload,
      import: imp,
      importdop: importdop,
      print: print,
      schedule: schedule,
      clearing: clearing,
      manual: manual,
      fordeduct: fordeduct,
      borfapps: borfapps,
      dmpiraw: dmpiraw,
      deduction: deduction,
      deductdoc: deductdoc,
      paiddeduction: paiddeduction,
      payment: payment,
      rts: rts,
      pulloutdoc: pulloutdoc,
      report: report,
      system: system,
      active: isActive,
    },
    success: function () {
      $(".span-notify-alert").html("User updated successfully.").show();
      $(".div-load-data").html("");
      $(".span-notify-alert").css("background-color", "");
      setTimeout(function () {
        $(".span-notify-alert").fadeOut();
      }, 2000);
    },
    error: function () {
      alert("Error: Failed to update user.");
    },
  });

  return false;
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
  $(".div-system-bg").hide();
}

function UpdateLocation() {
  $(".input-location").each(function () {
    var id = $(this).attr("locid");
    var value = $(this).val();
    var active = $(this)
      .closest("tr")
      .find(".input-checkbox-active")
      .is(":checked")
      ? 1
      : 0;

    $.ajax({
      type: "POST",
      url: "location/updatelocation.php",
      data: {
        id: id,
        value: value,
        active: active,
      },
      success: function () {
        $(".span-notify-alert").html("Location updated successfully.").show();
        $(".div-load-data").html("");
        $(".span-notify-alert").css("background-color", "");
        setTimeout(function () {
          $(".span-notify-alert").fadeOut();
        }, 2000);
      },
      error: function () {
        alert("Error: Failed to update user.");
      },
    });
  });

  return false;
}

function ShowImport() {
  $(".div-import-bg").show();
  $(".div-import").show();
}

function CloseImport() {
  $(".div-import-bg").hide();
}

function SelectFile() {
  $(".UploadCsvFile").click();
}

function FileLocation() {
  var filePath = $(".UploadCsvFile").val();
  $(".input-path").val(filePath);
}

var clear_timer = 0;

function UploadCSV() {
  var postData = new FormData();
  var file = $(".UploadCsvFile")[0].files[0];
  postData.append("file", file);

  $.ajax({
    type: "POST",
    url: "upload/csvfile.php",
    data: postData,
    dataType: "json",
    contentType: false,
    cache: false,
    processData: false,

    beforeSend: function () {
      $(".select-datatype").prop("disabled", true);
      $(".select-process").prop("disabled", true);
      $(".UploadCsvFile").prop("disabled", true);
      $(".input-browse").prop("disabled", true);

      var selectedValue = $(".select-process").val();
      if (selectedValue === "1") {
        var type = $(".select-datatype").val();
        $.ajax({
          type: "POST",
          url: "upload/csvfile.php",
          data: { dataType: type },
          success: function () {
            console.log("Data type saved successfully.");
          },
        });
      }
    },

    success: function (status) {
      setTimeout(function () {
        if (status.success) {
          $(".input-path").attr("value", status.filename);
          window.totalLine = status.total_line;
          Start_Import();
          $(".div-loading-bar").show();
          clear_timer = setInterval(count_import_data, 1000);
        }

        if (status.error) {
          $(".error-message").text(status.error).show();
          setTimeout(function () {
            $(".error-message").hide();
          }, 2000);

          // Reset UI
          $(".input-path").val("");
          $(".UploadCsvFile").val("");
          $(".select-datatype").prop("disabled", false);
          $(".select-process").prop("disabled", false);
          $(".input-browse").prop("disabled", false);

          // Delete uploaded file if error occurred
          $.ajax({
            url: "upload/filedelete.php",
            success: function () {
              console.log("Temporary file deleted.");
            },
          });
        }
      }, 2000);
    },

    error: function (xhr, status, err) {
      console.error("UploadCSV AJAX error:", status, err);
    },
  });

  return false;
}

function Start_Import() {
  var selectedType = $(".select-datatype").val();

  $.ajax({
    url: "upload/" + selectedType + ".php",
    success: function () {
      console.log("Import started for:", selectedType);
    },
  });
}

function count_import_data() {
  var type = $(".select-datatype").val();

  $.ajax({
    type: "POST",
    url: "upload/count.php",
    data: { dataType: type },
    success: function (totalrow) {
      var totalLines = $("#total_line").val();
      var progress = Math.round((totalrow / totalLines) * 100);
      $(".div-loading-bar").css("width", progress + "%");
      $(".div-loading-bar").text(progress + "%");
      if (progress >= 100) {
        $.ajax({
          url: "upload/filedelete.php",
          success: function () {
            console.log("Temporary file deleted.");
          },
        });
        clearInterval(clear_timer);
        $(".span-notify-alert").text("Import Completed!").show();
        setTimeout(function () {
          $(".span-notify-alert").hide();
        }, 2000);

        // Reset input fields and buttons
        $("#total_line").val("");
        $(".select-datatype").val("");
        $(".select-datatype").prop("disabled", false);
        $(".input-browse").prop("disabled", false);
        $(".button-importdata").prop("disabled", false);
        $(".div-loading-bar").hide();
      }
    },
    error: function (xhr, status, error) {
      console.error("count_import_data AJAX error:", status, error);
      console.log(xhr.responseText);
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
