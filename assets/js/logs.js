$(document).ready(function () {
  $("#ClearLogs").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "action=ClearLogs",
      success: function (response) {$("#ListError li").remove();
      },
    });
  });
});
