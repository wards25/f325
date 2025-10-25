$(document).ready(function () {
  PlaceHolder();
  ShowMenu();
  ShowMenuHover();
  LoadList();
  HistoryPosition();
  ReloadPage();
});
function ReloadPage() {
  setTimeout(function () {
    window.location.reload();
  }, 0xdbba0);
}
function addCommas(_0x5af0c2) {
  var _0x255248 = _0x5af0c2.toString().split('.');
  if (_0x255248[0x0].length >= 0x4) {
    _0x255248[0x0] = _0x255248[0x0].replace(/(\d)(?=(\d{3})+$)/g, "$1,");
  }
  return _0x255248.join('.');
}
$(document).mouseup(function (_0x16d325) {
  var _0x20a577 = $(".div-menu-list,.div-history");
  if (!_0x20a577.is(_0x16d325.target) && _0x20a577.has(_0x16d325.target).length === 0x0) {
    _0x20a577.hide();
  }
});
function PlaceHolder() {
  $(".select-search").on("change", function () {
    var _0x1d859a = $("option:selected", this).attr("placeholder");
    $(".input-search").attr('placeholder', _0x1d859a);
  });
}
function HistoryPosition() {
  $('.button-history').on("click", function () {
    var _0x2eef1e = $(this).position();
    $(".div-history").css("top", _0x2eef1e.bottom);
    $('.div-history').css("left", _0x2eef1e.left);
    var _0x59b6e1 = $(".input-ordernumber").val();
    $.ajax({
      'type': "POST",
      'url': "history.php",
      'data': {
        'processnumber': _0x59b6e1
      },
      'success': function (_0x37c076) {
        $(".tbody-history-list").html(_0x37c076);
        $(".div-history").show();
      }
    });
  });
}
function ShowMenuHover() {
  $(".span-text-menu").on("mouseover", function () {
    $(".button-menu").css("background-Color", "#5a5a5a");
    $(".button-menu").css('opacity', '0.5');
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
  var _0x3bc40f = $(".select-search").val();
  var _0x2c4f1b = $(".input-search").val();
  var _0xc491bc = $('.select-status').val();
  var _0x33331d = $(".select-company").val();
  $.ajax({
    'type': 'POST',
    'url': 'loadlist.php',
    'data': {
      'selectsearch': _0x3bc40f,
      'search': _0x2c4f1b,
      'status': _0xc491bc,
      'company': _0x33331d
    },
    'success': function (_0x2e111a) {
      $('.tbody-list-order').html(_0x2e111a);
      LoadDetail();
    }
  });
}
function CloseForm() {
  $(".div-bg").hide();
}
function LoadDetail() {
  $(".tbl-list-order-tr").click(function () {
    var _0x460cf7 = $(this).attr('f325id');
    $.ajax({
      'type': "POST",
      'url': "loaddetail.php",
      'data': {
        'id': _0x460cf7
      },
      'success': function (_0x3fc222) {
        $(".div-bg").show();
        obj = JSON.parse(_0x3fc222);
        $(".input-customer").val(obj.branchname);
        $(".input-company").val(obj.vendorname);
        $(".input-company").attr("vcode", obj.vcode);
        $('.input-issued').val(obj.issuedby);
        $(".input-emaildate").val(obj.emaildate);
        $(".input-prepared").val(obj.preparedby);
        $(".input-ordernumber").val(obj.f325number);
        $(".input-orderdate").val(obj.f325date);
        $(".input-remarks").val(obj.remarks);
        $('.input-status').val(obj.status);
        LoadSKU();
        if ($(".input-status").val() == "OPEN") {
          $(".button-print").html("Print");
          $('.button-reopen').hide();
          $(".input-remarks").prop("disabled", false);
        } else {
          $(".button-print").html('Re-Print');
          $(".button-reopen").show();
          $(".input-remarks").prop('disabled', true);
        }
      }
    });
  });
}
function LoadSKU() {
  var _0x131090 = $(".input-ordernumber").val();
  var _0xd3102d = $(".input-company").attr("vcode");
  $.ajax({
    'type': 'POST',
    'url': 'loadsku.php',
    'data': {
      'f325number': _0x131090,
      'vcode': _0xd3102d
    },
    'success': function (_0x35d7db) {
      $('.tbl-order-list').html(_0x35d7db);
      Subtotal();
    }
  });
}
function Subtotal() {
  var _0x728b92 = 0x0;
  $(".subtotal-lines").each(function () {
    _0x728b92 += parseFloat($(this).attr("subtotal"));
  });
  $(".input-subtotal").val(addCommas(_0x728b92.toFixed(0x2)));
}
function ReOpen() {
  var _0x37ab0e = $('.input-ordernumber').val();
  $.ajax({
    'type': "POST",
    'url': "reopen.php",
    'data': {
      'f325number': _0x37ab0e
    },
    'success': function (_0x40ddf4) {
      $(".span-notify-alert").html(_0x40ddf4);
      $(".span-notify-alert").show();
      CloseForm();
      LoadList();
      setTimeout(function () {
        $('.span-notify-alert').hide();
      }, 0x7d0);
    }
  });
}
function UpdateStatus() {
  var f325number = $(".input-ordernumber").val();
  var remarks = $(".input-remarks").val();
  $.ajax({
    'type': "POST",
    'url': "update.php",
    'data': {
      'f325number': f325number,
      'remarks': remarks
    },
    'success': function (data) {
      $(".span-notify-alert").html(data);
      $(".span-notify-alert").show();
      CloseForm();
      LoadList();
      setTimeout(function () {
        $(".span-notify-alert").hide();
      }, 0x7d0);
    }
  });
}
function PrintFile() {
  var ordernumber = $(".input-ordernumber").val();
  var status = $(".input-status").val();
  var host = $(location).attr('hostname');
//   var file = "https://" + host + "/convert/convert/database/" + ordernumber + '.txt';
  var file = "https://f325.ramosco.net/convert/convert/database/" + ordernumber + '.txt';
  var print = window.open(file);
  setTimeout(function () {
    print.print();
    setTimeout(function () {
      print.close();
    }, 0x1f4);
    if (status == "OPEN") {
      UpdateStatus();
    }
  }, 0x1f4);
}