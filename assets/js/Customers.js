$(document).ready(function () {
  $("#AddCustomer").click(function (e) {
    e.preventDefault();

    Username = $("#Username");
    FirstName = $("#FirstName");
    LastName = $("#LastName");
    EMail = $("#EMail");
    Telephone = $("#Telephone");
    Fax = $("#Fax");
    Password = $("#Password");
    Cpassword = $("#Cpassword");
    Newsletter = $("#Newsletter");

    if (
      Username.val() &&
      FirstName.val() &&
      LastName.val() &&
      EMail.val() &&
      Telephone.val() &&
      Fax.val() &&
      Password.val() &&
      Cpassword.val() &&
      Newsletter.val()
    ) {
      $("#ErrorUsername").hide();
      $("#ErrorUsernameText").text("");
      $("#ErrorFirstName").hide();
      $("#ErrorFirstNameText").text("");
      $("#ErrorLastName").hide();
      $("#ErrorLastNameText").text("");
      $("#ErrorEMail").hide();
      $("#ErrorEMailText").text("");
      $("#ErrorTelephone").hide();
      $("#ErrorTelephoneText").text("");
      $("#ErrorFax").hide();
      $("#ErrorFaxText").text("");
      $("#ErrorPassword").hide();
      $("#ErrorPasswordText").text("");

      if (Password.val() == Cpassword.val()) {
        $("#ErrorPassword").hide();
        $("#ErrorPasswordText").text("");

        $.ajax({
          url: "../assets/php/action.php",
          method: "POST",
          data:
            "Username=" +
            Username.val() +
            "&FirstName=" +
            FirstName.val() +
            "&LastName=" +
            LastName.val() +
            "&EMail=" +
            EMail.val() +
            "&Telephone=" +
            Telephone.val() +
            "&Fax=" +
            Fax.val() +
            "&Password=" +
            Password.val() +
            "&Cpassword=" +
            Cpassword.val() +
            "&Newsletter=" +
            Newsletter.val() +
            "&action=AddCustomer",
          success: function (response) {
            console.log(response);
            switch (response) {
              case "success":
                window.location.replace("../Customers.php");
                break;
            }
          },
        });
      } else {
        $("#ErrorPassword").show();
        $("#ErrorPasswordText").text("Password Not Match");
      }
    } else {
      $("#ErrorUsername").show();
      $("#ErrorUsernameText").text("* This Field Require");
      $("#ErrorFirstName").show();
      $("#ErrorFirstNameText").text("* This Field Require");
      $("#ErrorLastName").show();
      $("#ErrorLastNameText").text("* This Field Require");
      $("#ErrorEMail").show();
      $("#ErrorEMailText").text("* This Field Require");
      $("#ErrorTelephone").show();
      $("#ErrorTelephoneText").text("* This Field Require");
      $("#ErrorFax").show();
      $("#ErrorFaxText").text("* This Field Require");
      $("#ErrorPassword").show();
      $("#ErrorPasswordText").text("* This Field Require");
    }
  });

  $("#UpdateCustomer").click(function (e) {
    e.preventDefault();

    Username = $("#Username");
    FirstName = $("#FirstName");
    LastName = $("#LastName");
    EMail = $("#EMail");
    Telephone = $("#Telephone");
    Fax = $("#Fax");
    Password = $("#Password");
    Cpassword = $("#Cpassword");
    Newsletter = $("#Newsletter");

    if (
      Username.val() &&
      FirstName.val() &&
      LastName.val() &&
      EMail.val() &&
      Telephone.val() &&
      Fax.val() &&
      Password.val() &&
      Cpassword.val() &&
      Newsletter.val()
    ) {
      if (Password.val() == Cpassword.val()) {
        $.ajax({
          url: "../assets/php/action.php",
          method: "POST",
          data:
            "InitialUsername=" +
            $("#InitialUsername").val() +
            "&Username=" +
            Username.val() +
            "&FirstName=" +
            FirstName.val() +
            "&LastName=" +
            LastName.val() +
            "&EMail=" +
            EMail.val() +
            "&Telephone=" +
            Telephone.val() +
            "&Fax=" +
            Fax.val() +
            "&Password=" +
            Password.val() +
            "&Cpassword=" +
            Cpassword.val() +
            "&Newsletter=" +
            Newsletter.val() +
            "&action=UpdateCustomer",
          success: function (response) {
            console.log(response);
          },
        });
      }
    }
  });

  $("[id=DeleteCustomer]").click(function (e) {
    e.preventDefault();
    CustomersId = $(this).attr("data-CustomerId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "CustomerId=" + CustomersId + "&action=DeleteCustomer",
      success: function (response) {
        console.log(response);
        $("[data-CustomerColumnId=" + CustomersId + "]").remove();
      },
    });
  });
});
