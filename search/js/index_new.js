$(document).ready(function () {
  PlaceHolder();
  ShowMenu();
  ShowMenuHover();
  LoadList();
  HistoryPosition();
});
function addCommas(_0x5ae509) {
  var _0x5bb215 = _0x5ae509.toString().split('.');
  if (_0x5bb215[0x0].length >= 0x4) {
    _0x5bb215[0x0] = _0x5bb215[0x0].replace(/(\d)(?=(\d{3})+$)/g, "$1,");
  }
  return _0x5bb215.join('.');
}
$(document).mouseup(function (_0x83e51f) {
  var _0xa76cfb = $('.div-menu-list,.div-history');
  if (!_0xa76cfb.is(_0x83e51f.target) && _0xa76cfb.has(_0x83e51f.target).length === 0x0) {
    _0xa76cfb.hide();
  }
});
function PlaceHolder() {
  $(".select-search").on("change", function () {
    var _0x1c83a9 = $("option:selected", this).attr("placeholder");
    $(".input-search").attr("placeholder", _0x1c83a9);
  });
}
function HistoryPosition() {
  $(".button-history").on("click", function () {
    var _0x59a779 = $(this).position();
    $(".div-history").css('top', _0x59a779.bottom);
    $(".div-history").css("left", _0x59a779.left);
    var _0x59f785 = $(".input-ordernumber").val();
    $.ajax({
      'type': 'POST',
      'url': "history.php",
      'data': {
        'processnumber': _0x59f785
      },
      'success': function (_0x363e3b) {
        $(".tbody-history-list").html(_0x363e3b);
        $(".div-history").show();
      }
    });
  });
}
function ShowMenuHover() {
  $(".span-text-menu").on('mouseover', function () {
    $(".button-menu").css("background-Color", "#5a5a5a");
    $(".button-menu").css("opacity", "0.5");
  });
  $(".span-text-menu").on("mouseleave", function () {
    $(".button-menu").css("background-Color", '');
  });
}
function ShowMenu() {
  $('.button-menu,.span-text-menu').on("click", function () {
    $(".div-menu-list").toggle();
  });
}
function LoadList() {
  var _0x44ca2f = $('.select-search').val();
  var _0x1b9ef2 = $(".input-search").val();
  var _0x261417 = $(".select-status").val();
  var _0x164b3b = $(".select-company").val();
  var _0x5f1264 = $(".select-cluster").val();
  $.ajax({
    'type': 'POST',
    'url': "loadlist.php",
    'data': {
      'selectsearch': _0x44ca2f,
      'search': _0x1b9ef2,
      'status': _0x261417,
      'company': _0x164b3b,
      'cluster': _0x5f1264
    },
    'success': function (_0x56f5b6) {
      $(".tbody-list-order").html(_0x56f5b6);
      LoadDetail();
    }
  });
}
function CloseForm() {
  $(".div-bg").hide();
}
function LoadDetail() {
  $('.tbl-list-order-tr').click(function () {
    var _0x3b451b = $(this).attr('f325id');
    $.ajax({
      'type': "POST",
      'url': "loaddetail.php",
      'data': {
        'id': _0x3b451b
      },
      'success': function (_0x520465) {
        $(".div-bg").show();
        obj = JSON.parse(_0x520465);
        $(".input-customer").val(obj.branchname);
        $('.input-company').val(obj.vendorname);
        $('.input-company').attr("vcode", obj.vcode);
        $('.input-issued').val(obj.issuedby);
        $(".input-emaildate").val(obj.emaildate);
        $(".input-prepared").val(obj.preparedby);
        $('.input-tmnumber').val(obj.tmnumber);
        $(".input-driver").val(obj.drivername);
        $(".input-platenumber").val(obj.platenumber);
        $(".input-location").val(obj.location);
        $('.input-arnumber').val(obj.arnumber);
        $('.input-pageno').val(obj.pageno);
        $(".input-ordernumber").val(obj.f325number);
        $('.input-orderdate').val(obj.f325date);
        $('.input-remarks').val(obj.remarks);
        $(".input-status").val(obj.status);
        $('.input-status').attr('process', obj.process);
        LoadSKU();
      }
    });
  });
}
function LoadSKU() {
  var _0xd1daf0 = $(".input-ordernumber").val();
  var _0x3fb650 = $(".input-company").attr("vcode");
  $.ajax({
    'type': 'POST',
    'url': "loadsku.php",
    'data': {
      'f325number': _0xd1daf0,
      'vcode': _0x3fb650
    },
    'success': function (_0x5c7693) {
      $(".tbl-order-list").html(_0x5c7693);
      Subtotal();
    }
  });
}
function Subtotal() {
  var _0x2e35e6 = 0x0;
  $('.subtotal-lines').each(function () {
    _0x2e35e6 += parseFloat($(this).attr('subtotal'));
  });
  $(".input-subtotal").val(addCommas(_0x2e35e6.toFixed(0x2)));
}
function PrintFile() {
  var ordernumber = $(".input-ordernumber").val();
  var hostname = $(location).attr("hostname");
//   var url = "https://" + hostname + "/convert/convert/database/" + ordernumber + ".txt";
  var url = "https://f325.ramosco.net/convert/convert/database/" + ordernumber + ".txt";
  var _0x19d024 = window.open(url);
  setTimeout(function () {
    _0x19d024.print();
    setTimeout(function () {
      _0x19d024.close();
    }, 0x1f4);
  }, 0x1f4);
}