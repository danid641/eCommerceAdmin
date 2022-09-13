$(document).ready(function () {
  $("[id=DelteOrder]").click(function (e) {
    e.preventDefault();
    OrderId = $(this).attr("data-OrderId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "OrderId=" + OrderId + "&action=DelteOrder",
      success: function (response) {
        $("[data-OrderColumnId=" + OrderId + "]").remove();
      },
    });
  });

  /*
  $("[id=DelteOrder]").click(function (e) {
    e.preventDefault();
    ProductId = $(this).attr("data-OrderId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "ProductId=" + ProductId + "&action=DelteOrder",
      success: function (response) {
        $("[data-OrderColumnId=" + ProductId + "]").remove();
      },
    });
  });
  */
});
