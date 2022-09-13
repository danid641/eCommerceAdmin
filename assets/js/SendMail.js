$(document).ready(function () {
  $("#TypingCustomerName").hide();
  $("#TypingProductName").hide();

  $("#to").change(function () {
    switch ($("#to").val()) {
      case "ManualySelectedCustomers":
        $("#TypingCustomerName").show();
        $("#TypingProductName").hide();
        break;

      case "AllCustomers":
        $("#TypingCustomerName").hide();
        $("#TypingProductName").hide();
        break;

      case "ToCustomersSelectedProducts":
        $("#TypingCustomerName").hide();
        $("#TypingProductName").show();
        break;

      default:
        $("#TypingCustomerName").hide();
        $("#TypingProductName").hide();
        break;
    }
  });

  to = $("#to");
  subject = $("#Subject");
  MessageBody = $("#Body");

  $("#SendMail").click(function (e) {
    e.preventDefault();

    switch (to.val()) {
      case "AllCustomers":
        data =
          "to=" +
          to.val() +
          "&subject=" +
          subject.val() +
          "&MessageBody=" +
          MessageBody.val() +
          "&action=SendMail";
        break;
      case "ManualySelectedCustomers":
        data =
          "to=" +
          to.val() +
          "&customers=" +
          $("#SelectUser").val() +
          "&subject=" +
          subject.val() +
          "&MessageBody=" +
          MessageBody.val() +
          "&action=SendMail";
        break;
      case "ToCustomersSelectedProducts":
        break;
    }

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: data,
      success: function (resp) {
        console.log(resp);
      },
    });
  });
});
