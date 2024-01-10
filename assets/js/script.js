(function ($) {
  "use strict";
  $(".mobile-toggle").click(function () {
    $(".nav-menus").toggleClass("open");
  });
  $(".mobile-search").click(function () {
    $("#demo-input").toggleClass("open");
  });
  $(".bookmark-search").click(function () {
    $(".form-control-search").toggleClass("open");
  });
})(jQuery);

$(".loader-wrapper").slideUp("slow", function () {
  $(this).remove();
});

$(window).on("scroll", function () {
  if ($(this).scrollTop() > 600) {
    $(".tap-top").fadeIn();
  } else {
    $(".tap-top").fadeOut();
  }
});
$(".tap-top").click(function () {
  $("html, body").animate(
    {
      scrollTop: 0,
    },
    600
  );
  return false;
});

function toggleFullScreen() {
  if (
    (document.fullScreenElement && document.fullScreenElement !== null) ||
    (!document.mozFullScreen && !document.webkitIsFullScreen)
  ) {
    if (document.documentElement.requestFullScreen) {
      document.documentElement.requestFullScreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullScreen) {
      document.documentElement.webkitRequestFullScreen(
        Element.ALLOW_KEYBOARD_INPUT
      );
    }
  } else {
    if (document.cancelFullScreen) {
      document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
      document.webkitCancelFullScreen();
    }
  }
}
(function ($, window, document, undefined) {
  "use strict";
  var $ripple = $(".js-ripple");
  $ripple.on("click.ui.ripple", function (e) {
    var $this = $(this);
    var $offset = $this.parent().offset();
    var $circle = $this.find(".c-ripple__circle");
    var x = e.pageX - $offset.left;
    var y = e.pageY - $offset.top;
    $circle.css({
      top: y + "px",
      left: x + "px",
    });
    $this.addClass("is-active");
  });
  $ripple.on(
    "animationend webkitAnimationEnd oanimationend MSAnimationEnd",
    function (e) {
      $(this).removeClass("is-active");
    }
  );
})(jQuery, window, document);

$(".chat-menu-icons .toogle-bar").click(function () {
  $(".chat-menu").toggleClass("show");
});

$("#flip-btn").click(function () {
  $(".flip-card-inner").addClass("flipped");
});

$("#flip-back").click(function () {
  $(".flip-card-inner").removeClass("flipped");
});

$("#document-toggle").click(function () {
  $("#myScrollspy").toggleClass("close");
  $(".document-header").toggleClass("close-header");
});
$(document).ready(function () {
  $("#form-password").hide();

  $("input[name='private']").change(function () {
    console.log("Selected value: ", $(this).val()); // Debug

    if ($(this).val() === "1") {
      $("#form-password").show();
    } else {
      $("#form-password").hide();
    }
  });

  $("input[name='private']:checked").change();
});

$(document).ready(function () {
  $("#edit-form").click(function () {
    var hashId = $(this).attr("hash-id");
    if (hashId !== undefined) {
      var redirectURL = "index.php?page=edit&hash_id=" + hashId;
      window.location.href = redirectURL;
    } else {
      console.error("hash-id attribute is not defined on the button.");
    }
  });
});

$(document).ready(function () {
  $("#delete-file").click(function (e) {
    e.preventDefault();
    let hash_id = $(this).attr("hash-id");
    if (confirm("Are you sure you want to delete this file?")) {
      $.ajax({
        url: "api/delete.php?hash_id=" + hash_id,
        type: "DELETE",
        success: function (response) {
          swal({
            title: "Record Deleted",
            text: "Record Sucessfully Deleted!",
            icon: "success",
          }).then(function () {
            location.reload();
          });
        },
        error: function (xhr, status, error) {
          swal({
            title: "Failed to Delete",
            text: "Delete Record Failed!",
            icon: "danger",
          }).then(function () {
            location.reload();
          });
          console.log(error);
        },
      });
    }
  });
});

$(document).ready(function () {
  $("#edit-file").click(function (e) {
    // window.location.reload();

    e.preventDefault();
    var formData = new FormData($("form")[0]);
    $.ajax({
      url: "/api/edit.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        swal({
          title: "Record Updated",
          text: "Record Sucessfully Updated!",
          icon: "success",
        }).then(function () {
          location.reload();
        });
      },
      error: function (error) {
        swal("Failed to Update!", "Record Failed Updated", "danger");
      },
    });
  });
});
