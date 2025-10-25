$(document).ready(function () {
    ShowMenu();
    ShowMenuHover();
    Redirecting();
    FileDelete();
    ConvertFileDelete();
    DuplicateDelete();
    DragEnter();
    DragLeave();
    OpenFile();
    Drop();
    FileSelected();
    POnumberCount();
  });
  $(document).mouseup(function (e) {
    var menubg = $('.div-menu-list');
    if (!menubg.is(e.target) && menubg.has(e.target).length === 0x0) {
      menubg.hide();
    }
  });
  function ShowMenuHover() {
    $(".span-text-menu").on("mouseover", function () {
      $(".button-menu").css('background-Color', '#5a5a5a');
      $(".button-menu").css('opacity', '0.5');
    });
    $(".span-text-menu").on("mouseleave", function () {
      $('.button-menu').css("background-Color", '');
    });
  }
  function ShowMenu() {
    $(".button-menu,.span-text-menu").on("click", function () {
      $(".div-menu-list").toggle();
    });
  }
  function FileDelete() {
    $.ajax({
      'url': "upload/filedelete.php",
      'success': function () {
        ScanFile();
        $('.check-file').prop("disabled", true);
        $('.clear-file').prop("disabled", true);
        $(".convert-file").prop("disabled", true);
      }
    });
  }
  function ConvertFileDelete() {
    $.ajax({
      'url': "convert/filedelete.php",
      'success': function () {}
    });
  }
  function DuplicateDelete() {
    $.ajax({
      'url': 'upload/duplicatedelete.php',
      'success': function () {
        ScanVerify();
      }
    });
  }
  function Redirecting() {
    $('html').on("dragover", function (_0xe188ae) {
      _0xe188ae.preventDefault();
      _0xe188ae.stopPropagation();
    });
    $('html').on("drop", function (_0x12c651) {
      _0x12c651.preventDefault();
      _0x12c651.stopPropagation();
    });
  }
  function DragEnter() {
    $('.upload-area').on("dragenter", function (_0x545596) {
      _0x545596.stopPropagation();
      _0x545596.preventDefault();
    });
  }
  function DragLeave() {
    $(".upload-area").on("dragleave", function (_0x4959c6) {
      _0x4959c6.stopPropagation();
      _0x4959c6.preventDefault();
    });
  }
  function Drop() {
    $(".upload-area").on('drop', function (e) {
      DuplicateDelete();
      e.stopPropagation();
      e.preventDefault();
      ConvertFileDelete();
      var datatransfer = e.originalEvent.dataTransfer.files;
      var formdata = new FormData();
      for (var _0x200ecb = 0x0; _0x200ecb <= datatransfer.length; _0x200ecb++) {
        formdata.append("files", datatransfer[_0x200ecb]);
        $.ajax({
          'type': "POST",
          'beforeSend': function () {
            $(".span-loadingmessage").html("Add File...");
            $(".loaderscreen").show();
          },
          'url': 'upload/uploadfile.php',
          'data': formdata,
          'cache': false,
          'processData': false,
          'contentType': false,
          'success': function (data) {
            $(".file").val('');
            ScanFile();
            setTimeout(function () {
              $('.loaderscreen').hide();
              setTimeout(function () {
                $(".span-notify-alert").html("Add successfully!");
                $(".span-notify-alert").show();
                setTimeout(function () {
                  $('.span-notify-alert').hide();
                }, 0x7d0);
              }, 0x1f4);
            }, 0x3e8);
          }
        });
      }
      $('.clear-file').prop("disabled", false);
      $(".check-file").prop('disabled', false);
    });
  }
  function FileSelected() {
    $(".file").on("change", function () {
      var formdata = new FormData();
      var lenght = $(".file")[0x0].files.length;
      for (var file = 0x0; file <= lenght; file++) {
        formdata.append("files", $('.file')[0x0].files[file]);
        $.ajax({
          'type': "POST",
          'beforeSend': function () {
            $('.span-loadingmessage').html("Add File...");
            $('.loaderscreen').show();
          },
          'url': "upload/uploadfile.php",
          'data': formdata,
          'cache': false,
          'processData': false,
          'contentType': false,
          'success': function (_0x445ad3) {
            $(".file").val('');
            ScanFile();
            setTimeout(function () {
              $('.span-notify-alert').html("Add successfully!");
              $(".span-notify-alert").show();
              setTimeout(function () {
                $(".loaderscreen").hide();
                setTimeout(function () {
                  $(".span-notify-alert").hide();
                }, 0x1f4);
              }, 0x7d0);
            }, 0x3e8);
          }
        });
      }
      $('.clear-file').prop("disabled", false);
      $(".check-file").prop("disabled", false);
    });
  }
  function ScanFile() {
    $.ajax({
      'url': "upload/scanfile.php",
      'success': function (_0x2d1847) {
        $(".tbody-list").html(_0x2d1847);
        CountFile();
        ConvertFileDelete();
      }
    });
  }
  function ScanVerify() {
    $.ajax({
      'url': "upload/scanverify.php",
      'success': function (data) {
        $(".tbody-duplicate").html(data);
      }
    });
  }
  function CountFile() {
    $.ajax({
      'url': "upload/countfile.php",
      'success': function (data) {
        $(".span-total-upload").html(data + " / 300");
        if (data >= 0x12d) {
          $(".check-file").prop("disabled", true);
        }
      }
    });
  }
  function OpenFile() {
    $(".add-file").click(function () {
      $(".file").click();
      $(".tbl-button-td3").hide();
      DuplicateDelete();
    });
  }
  function ConvertFile() {
    var emaildate = $(".input-emaildate").val();
    $.ajax({
      'type': "POST",
      'beforeSend': function () {
        $(".convert-file").prop('disabled', true);
        $(".clear-file").prop("disabled", true);
        $(".span-loadingmessage").html("Convert and Importing document...");
        $(".loaderscreen").show();
      },
      'url': "convert/convertfile.php",
      'data': {
        'emaildate': emaildate
      },
      'success': function (data) {
        InsertData();
      }
    });
  }
  function InsertData() {
    $.ajax({
      'url': "convert/insertdata.php",
      'success': function () {
        setTimeout(function () {
          $('.span-notify-alert').html("Import successfully!");
          $(".span-notify-alert").show();
          setTimeout(function () {
            $(".loaderscreen").hide();
            setTimeout(function () {
              $(".span-notify-alert").hide();
            }, 0x1f4);
          }, 0x7d0);
        }, 0x3e8);
        FileDelete();
        DuplicateDelete();
      }
    });
  }
  function EnabledConvert() {
    if ($(".tbl-list-tr").length >= 0x1) {
      $(".convert-file").prop("disabled", false);
      $(".clear-file").prop('disabled', false);
    } else {
      $('.convert-file').prop("disabled", true);
      $(".clear-file").prop("disabled", true);
    }
  }
  function VerrifyPO() {
    $.ajax({
      'beforeSend': function () {
        $(".span-loadingmessage").html("Verifying document...");
        $('.loaderscreen').show();
      },
      'url': "upload/verify.php",
      'success': function () {
        $(".check-file").prop("disabled", true);
        ScanVerify();
        ScanFile();
        setTimeout(function () {
          EnabledConvert();
          $('.span-notify-alert').html("Verified successfully!");
          $(".span-notify-alert").show();
          setTimeout(function () {
            $(".loaderscreen").hide();
            setTimeout(function () {
              $(".span-notify-alert").hide();
            }, 0x1f4);
          }, 0x7d0);
        }, 0x3e8);
      }
    });
  }
  function POnumberCount() {
    $(".input-ponumber").on("keyup", function () {
      if ($(this).val().length == '12') {
        $('.button-add').prop('disabled', false);
      } else {
        $(".button-add").prop("disabled", true);
      }
    });
  }