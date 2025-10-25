$(document).ready(function () {
  PlaceHolder();
  ShowMenu();
  ShowMenuHover();
  LoadList();
  HistoryPosition();
  CloseFormFunction();
  AddPrdFunction();
  ReSchedule();
  ReOpen();
  DisposedF325();
  CheckFileUpload();
  ViewPhoto();
  CloseViewPhoto();
  NavigateTable();
  KeyUpSearch();
  ClickSearch();
  KeyUpQty();
  KeyUpRcvdQty();
  KeyUpVariance();
  KeyUpUnitCost();
  AddProduct();
  OnInputQty();
  OnInputRcvdQty();
  OnInputUnitCostQty();
  ScanBarCode();
  DeleteRow();
  ReloadPage();
});
function ReloadPage() {
  setTimeout(function () {
    window.location.reload();
  }, 0xdbba0);
}
$(document).on("keypress", 'form', function (_0x494aa4) {
  var _0x5c6b6c = _0x494aa4.keyCode || _0x494aa4.which;
  if (_0x5c6b6c == 0xd) {
    _0x494aa4.preventDefault();
    return false;
  }
});
function addCommas(_0x222c96) {
  var _0x2b8020 = _0x222c96.toString().split('.');
  if (_0x2b8020[0x0].length >= 0x4) {
    _0x2b8020[0x0] = _0x2b8020[0x0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
  }
  return _0x2b8020.join('.');
}
$(document).mouseup(function (_0x47c04b) {
  var _0x31986c = $(".div-menu-list,.div-history,.div-prd-scroll");
  if (!_0x31986c.is(_0x47c04b.target) && _0x31986c.has(_0x47c04b.target).length === 0x0) {
    _0x31986c.hide();
  }
});
function CloseFormFunction() {
  $(window).keydown(function (_0x153fb8) {
    if (_0x153fb8.keyCode === 0x1b) {
      _0x153fb8.preventDefault();
      $(".button-style-form").click();
    }
  });
}
function AddPrdFunction() {
  $(window).keydown(function (_0x20ff67) {
    if (_0x20ff67.keyCode === 0x6b) {
      _0x20ff67.preventDefault();
      $('.button-add-prd').click();
    }
  });
}
function PlaceHolder() {
  $(".select-search").on("change", function () {
    var _0x37680a = $("option:selected", this).attr('placeholder');
    $(".input-search").attr("placeholder", _0x37680a);
  });
}
function HistoryPosition() {
  $(".button-history").on("click", function () {
    var _0x214d77 = $(this).position();
    $(".div-history").css("top", _0x214d77.bottom);
    $(".div-history").css("left", _0x214d77.left);
    var _0x385098 = $('.input-ordernumber').val();
    $.ajax({
      'type': "POST",
      'url': "history.php",
      'data': {
        'processnumber': _0x385098
      },
      'success': function (_0x4c9334) {
        $(".tbody-history-list").html(_0x4c9334);
        $(".div-history").show();
      }
    });
  });
}
function ShowMenuHover() {
  $(".span-text-menu").on("mouseover", function () {
    $(".button-menu").css('background-Color', '#5a5a5a');
    $(".button-menu").css("opacity", "0.5");
  });
  $(".span-text-menu").on("mouseleave", function () {
    $(".button-menu").css("background-Color", '');
  });
}
function ShowMenu() {
  $(".button-menu,.span-text-menu").on("click", function () {
    $(".div-menu-list").toggle();
  });
}
function LoadList() {
  var selectsearch = $(".select-search").val();
  var search = $(".input-search").val();
  var status = $(".select-status").val();
  var processed = $(".select-status").find("option:selected").attr("process");
  var company = $(".select-company").val();
  $.ajax({
    'type': 'POST',
    'url': "loadlist.php",
    'data': {
      'selectsearch': selectsearch,
      'search': search,
      'status': status,
      'processed': processed,
      'company': company
    },
    'success': function (data) {
      $(".tbody-list-order").html(data);
      LoadDetail();
    }
  });
}
function CloseForm() {
  $('.button-form-menu').hide();
  $(".tbl-order-detail-tr[rowid=\"0\"]").remove();
  $('.button-add-prd,.button-received').prop("disabled", false);
  $('.form-order-detail')[0x0].reset();
  $(".div-bg").hide();
}
function CheckStatus() {
  if ($('.input-status').val() == "SCHEDULED") {
    $('.button-reopen').hide();
    $('.button-reschedule').show();
    $(".button-disposed").show();
    $(".button-disposed").prop("disabled", true);
    $(".button-received").show();
    $(".button-history").show();
    $(".button-add-prd").show();
    $(".input-remarks").prop("disabled", false);
    $(".select-arreason").prop('disabled', false);
    $('.input-arnumber').prop("disabled", false);
    $(".button-row-delete").prop("disabled", false);
    $('.file-upload').show();
    $('.button-view-f325-doc').hide();
    RequireARnumber();
    $(".input-mdccode,.input-bbd-date,.input-reason-code,.input-quantity,.input-rcvdqty,.input-unitcost,.input-scanner").prop("disabled", false);
  } else {
    if ($(".input-status").val() == "OPEN" || $(".input-status").val() == "PRINTED") {
      $(".button-reopen").hide();
      $(".button-reschedule").show();
      $('.button-disposed').show();
      $(".button-disposed").prop('disabled', true);
      $(".button-received").show();
      $('.button-history').show();
      $('.button-add-prd').show();
      $(".input-remarks").prop("disabled", false);
      $(".select-arreason").prop("disabled", false);
      $(".input-arnumber").prop('disabled', false);
      $(".button-row-delete").prop("disabled", false);
      $(".file-upload").show();
      $(".button-view-f325-doc").hide();
      RequireARnumber();
      $('.input-mdccode,.input-bbd-date,.input-reason-code,.input-quantity,.input-rcvdqty,.input-unitcost,.input-scanner').prop("disabled", false);
    } else {
      if ($('.input-status').val() == "FOR PAYMENT") {
        $('.button-reopen').show();
        $(".button-reschedule").hide();
        $(".button-disposed").hide();
        $(".button-received").show();
        $('.button-history').show();
        $(".button-add-prd").hide();
        $('.input-remarks').prop("disabled", false);
        $('.select-arreason').prop("disabled", true);
        $('.input-arnumber').prop("disabled", true);
        $('.button-row-delete').prop("disabled", true);
        $(".file-upload").hide();
        $(".button-view-f325-doc").hide();
        $(".input-mdccode,.input-bbd-date,.input-reason-code,.input-quantity,.input-rcvdqty,.input-unitcost,.input-scanner").prop("disabled", true);
      } else {
        if ($(".input-status").val() == 'SETTLED') {
          $('.button-reopen').hide();
          $('.button-reschedule').hide();
          $(".button-disposed").hide();
          $(".button-received").show();
          $(".button-history").show();
          $(".button-add-prd").hide();
          $('.input-remarks').prop('disabled', false);
          $(".select-arreason").prop("disabled", true);
          $(".input-arnumber").prop("disabled", true);
          $(".button-row-delete").prop("disabled", true);
          $(".file-upload").hide();
          $(".button-view-f325-doc").hide();
          $('.input-mdccode,.input-bbd-date,.input-reason-code,.input-quantity,.input-rcvdqty,.input-unitcost,.input-scanner').prop('disabled', true);
        } else if ($(".input-status").val() == "DISPOSED") {
          $(".button-reopen").show();
          $(".button-reschedule").hide();
          $(".button-disposed").hide();
          $(".button-received").hide();
          $(".button-history").show();
          $(".button-add-prd").hide();
          $(".input-remarks").prop('disabled', true);
          $(".select-arreason").prop("disabled", true);
          $(".input-arnumber").prop("disabled", true);
          $(".button-row-delete").prop("disabled", true);
          $(".file-upload").show();
          $(".input-f325file").hide();
          $('.button-view-f325-doc').show();
          $('.input-mdccode,.input-bbd-date,.input-reason-code,.input-quantity,.input-rcvdqty,.input-unitcost,.input-scanner').prop("disabled", true);
        } else {
          $(".button-reopen").show();
          $(".button-reschedule").hide();
          $(".button-disposed").hide();
          $(".button-received").hide();
          $('.button-history').show();
          $('.button-add-prd').hide();
          $(".input-remarks").prop('disabled', true);
          $(".select-arreason").prop("disabled", true);
          $(".input-arnumber").prop('disabled', true);
          $(".button-row-delete").prop("disabled", true);
          $('.input-f325file').hide();
          $('.button-view-f325-doc').hide();
          $(".input-mdccode,.input-bbd-date,.input-reason-code,.input-quantity,.input-rcvdqty,.input-unitcost,.input-scanner").prop("disabled", true);
        }
      }
    }
  }
}
function LoadDetail() {
  $(".tbl-list-order-tr").click(function () {
    var id = $(this).attr("f325id");
    $('.tbl-list-order-tr').css("background-Color", '');
    $(this).css("background-Color", "#b2beb5");
    $.ajax({
      'type': 'POST',
      'url': 'loaddetail.php',
      'data': {
        'id': id
      },
      'success': function (_0x4bc0c9) {
        $(".div-bg").show();
        obj = JSON.parse(_0x4bc0c9);
        $(".input-customer").val(obj.branchname);
        $('.input-customer').attr("brcode", obj.brcode);
        $(".input-company").val(obj.vendorname);
        $(".input-company").attr('vcode', obj.vcode);
        $(".input-issued").val(obj.issuedby);
        $(".input-emaildate").val(obj.emaildate);
        $(".input-prepared").val(obj.preparedby);
        $(".input-ordernumber").val(obj.f325number);
        $(".input-orderdate").val(obj.f325date);
        $(".input-tmnumber").val(obj.tmnumber);
        $(".input-driver").val(obj.driver);
        $('.input-platenumber').val(obj.platenumber);
        $(".input-remarks").val(obj.remarks);
        $(".input-location").val(obj.location);
        $('.input-location').attr("deducttype", obj.deducttype);
        $('.input-arnumber').val(obj.arnumber);
        $(".input-status").val(obj.status);
        LoadSKU();
      }
    });
  });
}
function GetVariance() {
  var _0x5b38de = $(".input-status").val();
  if (_0x5b38de == "CLEARED" || _0x5b38de == "FOR PAYMENT" || _0x5b38de == "SETTLED" || _0x5b38de == "DISPOSED") {
    $('.tbl-order-detail-tr').each(function () {
      var _0x227113 = $(this).find('.input-quantity').attr("quantity");
      var _0x3e6ba5 = $(this).find('.input-rcvdqty').val();
      $(this).find('.input-variance').val(addCommas(_0x3e6ba5 - _0x227113));
      var _0x111e45 = $(this).closest('tr').find(".input-variance").val();
      if (_0x111e45 == 0x0) {
        $(this).closest('tr').find(".input-variance").css("background-Color", '');
      } else {
        if (_0x111e45 <= 0x0) {
          $(this).closest('tr').find(".input-variance").css('background-Color', "#ffbac9");
        } else if (_0x111e45 >= 0x0) {
          $(this).closest('tr').find('.input-variance').css('background-Color', '#d2f8d2');
        }
      }
    });
  } else {
    $(".tbl-order-detail-tr").each(function () {
      var _0x39c782 = $(this).find(".input-quantity").attr('quantity');
      var _0xb5c6c8 = $(this).find('.input-rcvdqty').val();
      $(this).find(".input-variance").val(addCommas(_0xb5c6c8 - _0x39c782));
      var _0x21fd36 = $(this).find(".input-variance").val();
      if (_0x21fd36 == 0x0) {
        $(this).find(".input-variance").css('background-Color', '');
        $(this).find(".select-arreason").prop("disabled", true);
      } else {
        $(this).find(".select-arreason").prop('disabled', false);
        if (_0x21fd36 <= 0x0) {
          ResonShort();
          $(this).find('.input-variance').css("background-Color", '#ffbac9');
          RequireARnumber();
        } else if (_0x21fd36 >= 0x0) {
          ReasonOver();
          $(this).find(".input-variance").css("background-Color", '#d2f8d2');
          RequireARnumber();
        }
      }
    });
  }
}
function LoadSKU() {
  var _0x34b8a3 = $(".input-ordernumber").val();
  var _0x228cfe = $(".input-company").attr('vcode');
  $.ajax({
    'type': "POST",
    'url': "loadsku.php",
    'data': {
      'f325number': _0x34b8a3,
      'vcode': _0x228cfe
    },
    'success': function (_0x34cd75) {
      $(".tbl-order-list").html(_0x34cd75);
      $('.input-scanner').click().select();
      CheckStatus();
      EachCost();
      GetVariance();
    }
  });
}
function EachCost() {
  $(".tbl-order-detail-tr").each(function () {
    var _0x5abbd7 = parseFloat($(this).find('.input-quantity').attr("quantity"));
    var _0x42204c = parseFloat($(this).find(".input-unitcost").attr("unitcost"));
    var _0x578039 = parseFloat(_0x5abbd7 * _0x42204c).toFixed(0x2);
    $(this).find('.input-costextended').val(addCommas(_0x578039));
    $(this).find(".input-costextended").attr("costextended", _0x578039);
    Subtotal();
  });
}
function Subtotal() {
  var _0x584d13 = 0x0;
  $(".input-quantity").each(function () {
    _0x584d13 += parseFloat($(this).attr("quantity"));
  });
  var _0x395c66 = 0x0;
  $(".input-rcvdqty").each(function () {
    _0x395c66 += parseFloat($(this).val());
  });
  var _0x421ef6 = 0x0;
  $(".input-costextended").each(function () {
    _0x421ef6 += parseFloat($(this).attr('costextended'));
  });
  $('.input-costextended-subtotal').val(addCommas(_0x421ef6.toFixed(0x2)));
  $(".input-totalrcvdqty").val(addCommas(_0x395c66.toFixed(0x2)));
  $(".input-totalqty").val(addCommas(_0x584d13.toFixed(0x2)));
}
function ReOpen() {
  $(document).on("click", ".button-reopen", function () {
    var _0x3b3636 = $(".input-ordernumber").val();
    $.ajax({
      'type': "POST",
      'url': "reopen.php",
      'data': {
        'f325number': _0x3b3636
      },
      'success': function (_0x203428) {
        $(".span-notify-alert").html(_0x203428);
        $(".span-notify-alert").show();
        CloseForm();
        LoadList();
        setTimeout(function () {
          $('.span-notify-alert').hide();
        }, 0x7d0);
      }
    });
  });
}
function ReSchedule() {
  $(document).on("click", ".button-reschedule", function () {
    var _0xe13189 = $(".input-ordernumber").val();
    $.ajax({
      'type': "POST",
      'url': "reschedule.php",
      'data': {
        'f325number': _0xe13189
      },
      'success': function (_0x59a78d) {
        $(".span-notify-alert").html(_0x59a78d);
        $(".span-notify-alert").show();
        CloseForm();
        LoadList();
        setTimeout(function () {
          $(".span-notify-alert").hide();
        }, 0x7d0);
      }
    });
  });
}
function CheckFileUpload() {
  $(document).on("change", ".input-f325file", function () {
    var _0x1fb1a1 = $(this)[0x0].files.length;
    if (_0x1fb1a1 == 0x1) {
      $(".button-disposed").prop("disabled", false);
      ;
    } else {
      $(".button-disposed").prop("disabled", true);
    }
  });
}
function DisposedF325() {
  $(document).on("click", '.button-disposed', function () {
    var _0x43e358 = new FormData();
    var _0x36bf37 = $('.input-ordernumber').val();
    var _0x44389f = $('.input-f325file')[0x0].files[0x0];
    _0x43e358.append('files', _0x44389f);
    _0x43e358.append("f325number", _0x36bf37);
    $.ajax({
      'type': "POST",
      'url': "disposed.php",
      'data': _0x43e358,
      'contentType': false,
      'cache': false,
      'processData': false,
      'success': function (_0x4d31d2) {
        $(".span-notify-alert").html(_0x4d31d2);
        $(".span-notify-alert").show();
        CloseForm();
        LoadList();
        setTimeout(function () {
          $('.span-notify-alert').hide();
        }, 0x7d0);
      }
    });
  });
}
function ViewPhoto() {
  $(document).on("click", ".button-view-f325-doc", function () {
    var _0x2a790c = $(".input-ordernumber").val();
    var _0xee2a66 = $(location).attr("hostname");
    var _0x3acfbe = "https://" + _0xee2a66 + "/filepicture/dbfile/" + _0x2a790c + '.jpg';
    $(".image-view").attr("src", _0x3acfbe);
    $(".div-photo-bg").show();
  });
}
function CloseViewPhoto() {
  $(document).on('click', '.button-photo-close', function () {
    $('.image-view').attr("src", '');
    $(".div-photo-bg").hide();
  });
}
function RawForPayment() {
  var _0x227076 = $('.input-arnumber').val();
  $(".tbl-order-detail-tr").each(function () {
    var _0x49161d = $(this).attr("rowid");
    var _0x1eb2a9 = $(this).find(".input-bbd-date").val();
    var _0x3249bc = $(this).find('.select-dmpireason').val();
    var _0x2c84c7 = $(this).find(".input-reason-code").val();
    var _0x135383 = $(this).find(".input-rcvdqty").val();
    var _0x10db57 = $(this).find(".select-arreason").val();
    $.ajax({
      'type': 'POST',
      'url': "rawforpayment.php",
      'data': {
        'id': _0x49161d,
        'expiration': _0x1eb2a9,
        'dmpireason': _0x3249bc,
        'reasoncode': _0x2c84c7,
        'rcvdqty': _0x135383,
        'arnumber': _0x227076,
        'arreason': _0x10db57
      },
      'success': function () {}
    });
  });
}
function ForPayment() {
  var _0x154adf = $(".input-ordernumber").val();
  var _0x83557a = $(".input-arnumber").val();
  $.ajax({
    'type': "POST",
    'beforeSend': function () {
      RawForPayment();
    },
    'url': 'forpayment.php',
    'data': {
      'f325number': _0x154adf,
      'arnumber': _0x83557a
    },
    'success': function (_0x37d55b) {
      $('.span-notify-alert').html(_0x37d55b);
      $(".span-notify-alert").show();
      CloseForm();
      LoadList();
      setTimeout(function () {
        $(".span-notify-alert").hide();
      }, 0x7d0);
    }
  });
  return false;
}
function UpdateEachLines() {
  var _0x29a300 = $(".input-customer").attr("brcode");
  var _0x2115b2 = $('.input-company').attr('vcode');
  var _0x1cd9f5 = $(".input-ordernumber").val();
  var _0x3fd026 = $(".input-arnumber").val();
  var _0x59e7e2 = $(".input-location").val();
  $('.tbl-order-detail-tr').each(function () {
    var _0x29e464 = $(this).attr("rowid");
    var _0x2581d0 = $(this).attr("del");
    var _0x17a361 = $(this).find(".input-mdccode").val();
    var _0x420c70 = $(this).find('.input-bbd-date').val();
    var _0x3ec980 = $(this).find(".select-dmpireason").val();
    var _0x46067d = $(this).find(".input-reason-code").val();
    var _0x478df6 = $(this).find(".input-quantity").val();
    var _0x3ad1a5 = $(this).find(".input-rcvdqty").val();
    var _0x118619 = $(this).find(".input-unitcost").attr('unitcost');
    var _0x5320f1 = $(this).find(".input-costextended").attr("costextended");
    var _0x51b48f = $(this).find(".select-arreason").val();
    $.ajax({
      'type': "POST",
      'url': 'updateline.php',
      'data': {
        'id': _0x29e464,
        'del': _0x2581d0,
        'brcode': _0x29a300,
        'vcode': _0x2115b2,
        'arnumber': _0x3fd026,
        'loc': _0x59e7e2,
        'f325number': _0x1cd9f5,
        'mdccode': _0x17a361,
        'expiration': _0x420c70,
        'dmpireason': _0x3ec980,
        'reasoncode': _0x46067d,
        'quantity': _0x478df6,
        'rcvdqty': _0x3ad1a5,
        'unitcost': _0x118619,
        'costextended': _0x5320f1,
        'arreason': _0x51b48f
      },
      'success': function () {}
    });
  });
}
function UpdateStatus() {
  var _0x56c29d = $(".input-ordernumber").val();
  var _0x4131d7 = $(".input-arnumber").val();
  var _0x27f93c = $('.input-remarks').val();
  $.ajax({
    'type': 'POST',
    'beforeSend': function () {
      UpdateEachLines();
    },
    'url': "update.php",
    'data': {
      'f325number': _0x56c29d,
      'arnumber': _0x4131d7,
      'remarks': _0x27f93c
    },
    'success': function (_0x3407a4) {
      $(".span-notify-alert").html(_0x3407a4);
      $(".span-notify-alert").show();
      CloseForm();
      LoadList();
      setTimeout(function () {
        $('.span-notify-alert').hide();
      }, 0x7d0);
    }
  });
  return false;
}
function RequireARnumber() {
  var _0x3171e2 = $(".input-variance[style=\"background-color: rgb(255, 186, 201);\"]").length;
  if (_0x3171e2 >= 0x1) {
    $('.input-arnumber').prop("disabled", false);
    $(".input-arnumber").prop("required", true);
  } else {
    $(".input-arnumber").prop("disabled", true);
    $(".input-arnumber").prop("required", false);
  }
}
function ShowForPayment() {
  var _0x20b6b2 = $(".input-arnumber").val().length;
  if (_0x20b6b2 >= 0x1) {
    $('.button-forpayment').show();
    $(".button-reschedule").hide();
    $('.button-received').hide();
    $('.form-order-detail').attr("onsubmit", "return ForPayment();");
  } else {
    $(".button-forpayment").hide();
    $(".button-reschedule").show();
    $(".button-received").show();
    $('.form-order-detail').attr("onsubmit", "return UpdateStatus();");
  }
}
function ResonShort() {
  $(".select-arreason").html("<option value=\"\"></option><option value=\"MISSING Pay by Cash\">MISSING Pay by Cash</option><option value=\"DAMAGE Pay by Cash\">DAMAGE Pay by Cash</option><option value=\"GOOD STOCK DAMAGE Pay by Cash\">GOOD STOCK DAMAGE Pay by Cash</option>");
}
function ReasonOver() {
  $(".select-arreason").html("<option value=\"\"></option><option value=\"Over\">Over</option>");
}
function KeyUpVariance() {
  $(document).on('keyup', ".input-rcvdqty", function () {
    var _0x27cfa7 = $(this).closest('tr').find(".input-quantity").attr("quantity");
    var _0x49546c = $(this).val();
    $(this).attr("originalqty", _0x49546c);
    if (_0x49546c.length == '0') {
      $(this).val('0');
      $(this).attr("originalqty", '0');
      $(this).select();
    }
    $(this).closest('tr').find('.input-variance').val(addCommas(_0x49546c - _0x27cfa7));
    var _0x192468 = $(this).closest('tr').find(".input-variance").val();
    if (_0x192468 == 0x0) {
      $(this).closest('tr').find(".input-variance").css('background-Color', '');
      $(this).closest('tr').find('.select-arreason').prop('disabled', true);
      $(this).closest('tr').find(".select-arreason").val('');
      RequireARnumber();
    } else {
      $(this).closest('tr').find(".select-arreason").prop("disabled", false);
      if (_0x192468 <= 0x0) {
        ResonShort();
        $(this).closest('tr').find(".input-variance").css('background-Color', "#ffbac9");
        RequireARnumber();
      } else if (_0x192468 >= 0x0) {
        ReasonOver();
        $(this).closest('tr').find('.input-variance').css("background-Color", "#d2f8d2");
        RequireARnumber();
      }
    }
  });
}
function ScanBarCode() {
  $(document).on("change", '.input-scanner', function () {
    var _0x428339 = parseFloat($(this).val());
    var _0x1d913f = $('.tbl-order-list').find('.barcode' + _0x428339);
    var _0x4c0365 = parseFloat(_0x1d913f.find(".input-rcvdqty").attr('originalqty'));
    var _0x196a15 = _0x4c0365 + 0x1;
    _0x1d913f.find('.input-rcvdqty').val(_0x196a15);
    _0x1d913f.find(".input-rcvdqty").attr("originalqty", _0x196a15);
    $(this).val('');
    $(this).select();
    var _0x4fed02 = parseFloat(_0x1d913f.find(".input-quantity").attr("quantity"));
    var _0x3e2626 = parseFloat(_0x1d913f.find(".input-rcvdqty").val());
    _0x1d913f.find(".input-variance").val(addCommas(_0x3e2626 - _0x4fed02));
    var _0x5461a1 = _0x1d913f.find(".input-variance").val();
    if (_0x5461a1 == 0x0) {
      _0x1d913f.find(".input-variance").css("background-Color", '');
    } else {
      if (_0x5461a1 <= 0x0) {
        _0x1d913f.find(".input-variance").css("background-Color", '#ffbac9');
      } else if (_0x5461a1 >= 0x0) {
        _0x1d913f.find(".input-variance").css("background-Color", "#d2f8d2");
      }
    }
  });
}
function KeyUpQty() {
  $(document).on("keyup", '.input-quantity', function () {
    if ($(this).val().length === 0x0) {
      $(this).val('0');
      $(this).select();
    }
    var _0x507ea8 = 0x0;
    $(".input-quantity").each(function () {
      _0x507ea8 += parseFloat($(this).val());
    });
    $(".input-totalqty").val(addCommas(_0x507ea8.toFixed(0x2)));
    var _0x113e30 = $(this).val();
    var _0x356ee7 = $(this).closest('tr');
    _0x356ee7.find(".input-quantity").attr('quantity', _0x113e30);
    var _0x50748a = _0x356ee7.find(".input-rcvdqty").val();
    _0x356ee7.find(".input-variance").val(addCommas(_0x50748a - _0x113e30));
    EachCost();
    var _0x2471ef = _0x356ee7.find('.input-variance').val();
    if (_0x2471ef == 0x0) {
      _0x356ee7.find('.input-variance').css("background-Color", '');
      _0x356ee7.find('.select-arreason').prop("disabled", true);
    } else {
      _0x356ee7.find('.select-arreason').prop("disabled", false);
      if (_0x2471ef <= 0x0) {
        ResonShort();
        _0x356ee7.find(".input-variance").css("background-Color", "#ffbac9");
        RequireARnumber();
      } else if (_0x2471ef >= 0x0) {
        ReasonOver();
        _0x356ee7.find(".input-variance").css("background-Color", "#d2f8d2");
        RequireARnumber();
      }
    }
  });
}
function KeyUpRcvdQty() {
  $(document).on("keyup", '.input-rcvdqty', function () {
    if ($(this).val().length === 0x0) {
      $(this).val('0');
      $(this).select();
    }
    var _0x3d4f68 = 0x0;
    $(".input-rcvdqty").each(function () {
      _0x3d4f68 += parseFloat($(this).val());
    });
    $('.input-totalrcvdqty').val(addCommas(_0x3d4f68.toFixed(0x2)));
  });
}
function KeyUpUnitCost() {
  $(document).on("keyup", ".input-unitcost", function () {
    if ($(this).val().length === 0x0) {
      $(this).val('0.00');
      $(this).select();
    }
    var _0x5b9130 = $(this).val();
    $(this).attr("unitcost", _0x5b9130);
    EachCost();
    var _0x2820e0 = 0x0;
    $(".input-costextended").each(function () {
      _0x2820e0 += parseFloat($(this).attr("costextended"));
    });
    $(".input-costextended-subtotal").val(addCommas(_0x2820e0.toFixed(0x2)));
  });
}
function GetDetail(_0x20e694) {
  $(".tbl-prd-tr").click(function () {
    var _0x5ea760 = $(this).attr("mdccode");
    var _0x74dcb3 = $(this).attr("itemcode");
    var _0x18acd4 = $(this).attr("description");
    var _0x21d546 = $(this).attr("category");
    var _0x57933d = $(".tbl-order-detail").closest('tr').find(".add-search-mdccode[numbercount=\"" + _0x20e694 + "\"]").closest('tr');
    if (_0x21d546 == 'DMPI') {
      var _0x5850ea = $(this).attr("dmpipack");
      $.ajax({
        'type': "POST",
        'url': "dmpireason.php",
        'data': {
          'dmpipack': _0x5850ea
        },
        'success': function (_0x11d3ca) {
          $('.select-dmpireason').prop("disabled", false);
          _0x57933d.find('.select-dmpireason').html(_0x11d3ca);
        }
      });
    } else {
      $(".select-dmpireason").prop("disabled", true);
    }
    _0x57933d.find(".add-search-mdccode").val(_0x5ea760);
    _0x57933d.find(".input-itemcode").val(_0x74dcb3);
    _0x57933d.find(".input-description").val(_0x18acd4);
    _0x57933d.find('.input-quantity').val('1');
    _0x57933d.find('.input-quantity').attr("quantity", '1');
    _0x57933d.find(".input-unitcost").val("0.00");
    _0x57933d.find(".input-costextended").val("0.00");
    GetVariance();
    if (_0x5ea760.length == 0x0 && quantity == 0x0) {
      $('.button-addprd').prop("disabled", true);
      $('.button-save').prop("disabled", true);
    } else {
      $(".button-addprd").prop("disabled", false);
      $(".button-save").prop("disabled", false);
      setTimeout(function () {
        var _0x285c69 = $('.tbl-order-detail-tr').length;
        var _0x61e9de = _0x57933d.find(".add-search-mdccode").attr("numbercount");
        if (_0x285c69 == _0x61e9de) {
          $('.button-add-prd').click();
        }
      }, 0xc8);
      $(".div-prd-scroll").hide();
    }
  });
}
function KeyUpSearch() {
  $(document).on("input", '.add-search-mdccode', function () {
    var _0x4f85b0 = $(this);
    var _0x5cc2ea = _0x4f85b0.attr("numbercount");
    var _0x347c7c = $(this).val();
    var _0x343cf9 = $(".input-company").attr("vcode");
    $.ajax({
      'type': 'POST',
      'url': "loadprd.php",
      'data': {
        'search': _0x347c7c,
        'vcode': _0x343cf9
      },
      'success': function (_0x64132b) {
        $(".tbody-list-prd").html(_0x64132b);
        var _0x2073a7 = _0x4f85b0.position();
        var _0x51b7ee = _0x4f85b0.height();
        $('.div-prd-scroll').css("top", _0x2073a7.top + _0x51b7ee);
        $(".div-prd-scroll").css("left", _0x2073a7.left);
        $(".div-prd-scroll").show();
        $('.tbl-prd-tr:first').css('background-Color', "#b2beb5");
        GetDetail(_0x5cc2ea);
      }
    });
  });
}
function ClickSearch() {
  $(document).on("click", '.add-search-mdccode', function () {
    $(this).select();
    var _0x16d703 = $(this);
    _0x16d703.closest('td').css('background-Color', '');
    var _0x2ff2a6 = _0x16d703.attr("numbercount");
    var _0x5b275d = $(this).val();
    var _0x574453 = $(".input-company").attr("vcode");
    $.ajax({
      'type': 'POST',
      'url': "loadprd.php",
      'data': {
        'search': _0x5b275d,
        'vcode': _0x574453
      },
      'success': function (_0x4c100d) {
        $(".tbody-list-prd").html(_0x4c100d);
        var _0x48f343 = _0x16d703.position();
        var _0x154c1c = _0x16d703.height();
        $(".div-prd-scroll").css("top", _0x48f343.top + _0x154c1c);
        $(".div-prd-scroll").css("left", _0x48f343.left);
        $(".div-prd-scroll").show();
        $(".tbl-prd-tr:first").css("background-Color", "#b2beb5");
        GetDetail(_0x2ff2a6);
      }
    });
  });
}
function NavigateTable() {
  $(document).on('keydown', '.add-search-mdccode', function (_0x4e9490) {
    if (_0x4e9490.keyCode === 0xd) {
      _0x4e9490.preventDefault();
      var _0x1a47d7 = $(".tbl-prd-tr[style=\"background-color: rgb(178, 190, 181);\"]").length;
      if (_0x1a47d7 >= 0x1) {
        $(".tbl-prd-tr[style=\"background-color: rgb(178, 190, 181);\"]").click();
      }
    } else {
      if (_0x4e9490.keyCode === 0x28) {
        _0x4e9490.preventDefault();
        var _0x3ad001 = $(".tbl-prd-tr");
        var _0x4fdc45 = _0x3ad001.filter("[style=\"background-color: rgb(178, 190, 181);\"]").index();
        if (_0x4fdc45 >= _0x3ad001.length - 0x1) {} else {
          _0x3ad001.css('background-Color', '');
          _0x3ad001.eq(_0x4fdc45 + 0x1).css("background-Color", "#b2beb5");
        }
      } else {
        if (_0x4e9490.keyCode === 0x26) {
          _0x4e9490.preventDefault();
          var _0x3ad001 = $(".tbl-prd-tr");
          var _0x4fdc45 = _0x3ad001.filter("[style=\"background-color: rgb(178, 190, 181);\"]").index();
          if (_0x4fdc45 <= 0x0) {} else {
            _0x3ad001.css('background-Color', '');
            _0x3ad001.eq(_0x4fdc45 - 0x1).css("background-Color", "#b2beb5");
          }
        }
      }
    }
  });
}
function OnInputQty() {
  $(document).on("input", ".input-quantity", function () {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
  });
}
function OnInputRcvdQty() {
  $(document).on("input", '.input-rcvdqty', function () {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
  });
}
function OnInputUnitCostQty() {
  $(document).on("input", '.input-unitcost', function () {
    this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
  });
}
function DisabledButtonAdd() {
  $(".tbl-order-detail-tr[rowid=\"0\"]").on("keyup", function () {
    var _0x834ace = $(this).find('.input-mdccode').val();
    var _0x1bfed7 = $(this).find('.input-quantity').val();
    if (_0x834ace.length == 0x0 && _0x1bfed7 == 0x0) {
      $(".button-add-prd").prop("disabled", true);
      $('.button-received').prop("disabled", true);
    } else {
      $('.button-add-prd').prop("disabled", false);
      $('.button-received').prop("disabled", false);
    }
  });
}
function AddProduct() {
  $(document).on("click", '.button-add-prd', function () {
    if (isNaN(parseFloat($(".tbl-order-detail-tr:last").find(".add-search-mdccode").attr('numbercount')))) {
      var _0x47bcc1 = '1';
    } else {
      var _0x47bcc1 = parseFloat($(".tbl-order-detail-tr:last").find(".add-search-mdccode").attr('numbercount')) + 0x1;
    }
    $(".tbl-order-detail-tr-button").before("<tr class=\"tbl-order-detail-tr\" rowid=\"0\" del=\"0\"><td class=\"tbl-order-detail-td12\"><button type=\"button\" class=\"button-row-delete\">X</button></td><td class=\"tbl-order-detail-td1\"><input type=\"text\" class=\"input-withNoborder add-search-mdccode input-mdccode\" numbercount=\"" + _0x47bcc1 + "\" required=\"required\">" + "</td>" + "<td class=\"tbl-order-detail-td2\">" + "<input type=\"text\" class=\"input-withNoborder input-itemcode\" disabled=\"disabled\">" + '</td>' + "<td class=\"tbl-order-detail-td3\">" + "<input type=\"text\" class=\"input-withNoborder input-description\" disabled=\"disabled\">" + "</td>" + "<td class=\"tbl-order-detail-td9\">" + "<input type=\"text\" class=\"input-withNoborder input-bbd-date\" onclick=\"this.select();\">" + "</td>" + "<td class=\"tbl-order-detail-td8\">" + "<select class=\"select-style-withNoBorder select-dmpireason\" disabled=\"disabled\"></select>" + '</td>' + "<td class=\"tbl-order-detail-td4\">" + "<input type=\"text\" class=\"input-withNoborder input-reason-code\" onkeypress=\"return /[a-z]/i.test(event.key);\" maxlength=\"1\">" + "</td>" + "<td class=\"tbl-order-detail-td5\">" + "<input type=\"text\" class=\"input-withNoborder input-quantity\" quantity=\"0\" onclick=\"this.select();\" value=\"0\">" + "</td>" + "<td class=\"tbl-order-detail-td6\">" + "<input type=\"text\" class=\"input-withNoborder input-rcvdqty\" onclick=\"this.select();\" originalqty=\"0\" value=\"0\">" + "</td>" + "<td class=\"tbl-order-detail-td7\">" + "<input type=\"text\" class=\"input-withNoborder input-variance\" disabled=\"disabled\">" + '</td>' + "<td class=\"tbl-order-detail-td13\">" + "<input type=\"text\" class=\"input-withNoborder input-unitcost\" onclick=\"this.select();\" unitcost=\"0\" value=\"0.00\">" + "</td>" + "<td class=\"tbl-order-detail-td14\">" + "<input type=\"text\" class=\"input-withNoborder input-costextended\" costextended=\"0\" value=\"0.00\">" + "</td>" + "<td class=\"tbl-order-detail-td10\">" + "<select class=\"select-style-withNoBorder select-arreason\" disabled=\"disabled\"></select>" + "</td>" + "<td class=\"tbl-order-detail-td11\"></td>" + "</tr>");
    $('.button-add-prd').prop('disabled', true);
    $(".button-received").prop("disabled", true);
    $('.add-search-mdccode').select();
    GetVariance();
    DisabledButtonAdd();
    ScrollBottom();
  });
}
function ScrollBottom() {
  $(".div-scroll-raw").scrollTop(0x3e8);
}
function DeleteRow() {
  $(document).on("click", ".button-row-delete", function () {
    var _0x3d663d = $(this).closest(".tbl-order-detail-tr").attr("rowid");
    if (_0x3d663d == 0x0) {
      $(".button-add-prd").prop("disabled", false);
      $(".button-received").prop("disabled", false);
      $(this).closest(".tbl-order-detail-tr").fadeOut('slow', function () {
        $(this).closest(".tbl-order-detail-tr").remove();
      });
    } else {
      $(this).closest('.tbl-order-detail-tr').fadeOut("slow", function () {
        $(this).closest('.tbl-order-detail-tr').attr("del", '1');
        $(this).closest(".tbl-order-detail-tr").find('.input-mdccode').prop("required", false);
        $(this).closest(".tbl-order-detail-tr").find(".input-bbd-date").prop("required", false);
        $(this).closest(".tbl-order-detail-tr").find(".input-variance").attr("style", '');
        RequireARnumber();
      });
    }
  });
}