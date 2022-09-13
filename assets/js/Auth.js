$(document).ready(function () {
  SignBtn = $("#SignUp");
  Username = $("#Username");
  Email = $("#Email");
  Pass = $("#Password");
  Cpass = $("#CPassword");

  $("#SignUp").click(function (e) {
    e.preventDefault();
    if (Username.val() && Email.val() && Pass.val() && Cpass.val()) {
      $("#ErrorUsername").hide();
      $("#ErrorUsernameText").text();
      $("#ErrorEmail").hide();
      $("#ErrorEmailText").text();
      $("#ErrorPassword").hide();
      $("#ErrorPasswordText").text();
      $("#ErrorCPassword").hide();
      $("#ErrorCPasswordText").text();
      if (Pass.val() == Cpass.val()) {
        $.ajax({
          url: "assets/php/action.php",
          method: "POST",
          data:
            "Username=" +
            Username.val() +
            "&Email=" +
            Email.val() +
            "&Password=" +
            Pass.val() +
            "&CPassword=" +
            Cpass.val() +
            "&action=SignUp",
          success: function (response) {
            console.log(response);
            switch (response) {
              case "success":
                window.location.replace("index.php");
                break;

              case "UserExist":
                $("#ErrorEmail").show();
                $("#ErrorEmailText").text("Email Aleready Exist");
                break;
            }
          },
        });
      } else {
        $("#ErrorCPassword").show();
        $("#ErrorCPasswordText").text("Password Not Match");
      }
    } else {
      $("#ErrorUsername").show();
      $("#ErrorUsernameText").text("* This Field Require");
      $("#ErrorEmail").show();
      $("#ErrorEmailText").text("* This Field Require");
      $("#ErrorPassword").show();
      $("#ErrorPasswordText").text("* This Field Require");
      $("#ErrorCPassword").show();
      $("#ErrorCPasswordText").text("* This Field Require");
    }
  });

  $("#SignIn").click(function (e) {
    e.preventDefault();

    if (Email.val() && Pass.val()) {
      $("#ErrorEmail").hide();
      $("#ErrorEmailText").text("");
      $("#ErrorPassword").hide();
      $("#ErrorPasswordText").text("");
      $.ajax({
        url: "assets/php/action.php",
        method: "POST",
        data:
          "Email=" + Email.val() + "&Password=" + Pass.val() + "&action=SignIn",
        success: function (response) {
          console.log(response);
          switch (response) {
            case "success":
              $("#ErrorPassword").hide();
              $("#ErrorPasswordText").text("");
              window.location.replace("index.php");
              break;

            case "IncPass":
              $("#ErrorPassword").show();
              $("#ErrorPasswordText").text("Email Or Password Is Incorect");
              break;

            case "UserNotExist":
              $("#ErrorPassword").show();
              $("#ErrorPasswordText").text("Email Or Password Is Incorect");
              break;
          }
        },
      });
    } else {
      $("#ErrorEmail").show();
      $("#ErrorEmailText").text("* This Field Require");
      $("#ErrorPassword").show();
      $("#ErrorPasswordText").text("* This Field Require");
    }
  });

  $("#RecoverPassword").click(function (e) {
    e.preventDefault();

    Email = $("#Email");

    if (Email.val()) {
      $("#ErrorEmail").hide();
      $("#ErrorEmailText").text("");

      $.ajax({
        url: "assets/php/action.php",
        method: "POST",
        data: "Email=" + Email.val() + "&action=RecoverAccount",
        success: function (response) {
          console.log(response);
          switch (response) {
            case "UserNotExist":
              $("#ErrorEmail").show();
              $("#ErrorEmailText").text("Email Not Found");
              break;
          }
        },
      });
    } else {
      $("#ErrorEmail").show();
      $("#ErrorEmailText").text("* This Field Require");
    }
  });

  $("#ResetPassword").click(function (e) {
    e.preventDefault();

    Email = $("#Email");
    Token = $("#Token");
    Password = $("#Password");
    Cpassword = $("#Cpassword");

    if (!Email.val() && !Token.val()) {
      $("#ErrorCpassword").show();
      $("#ErrorCpasswordText").text("Email or token is invalid");
    }
    if (Password.val() && Cpassword.val()) {
      $("#ErrorPassword").hide();
      $("#ErrorPasswordText").text("");
      $("#ErrorCpassword").hide();
      $("#ErrorCpasswordText").text("");
      if (Password.val() == Cpassword.val()) {
        $.ajax({
          url: "assets/php/action.php",
          method: "POST",
          data:
            "Email=" +
            Email.val() +
            "&Token=" +
            Token.val() +
            "&Password=" +
            Password.val() +
            "&action=ResetPassword",
          success: function (response) {
            console.log(response);
            switch (response) {
              case "success":
                window.location.replace("index.php");
                break;

              case "IncorectSession":
                $("#ErrorCpassword").show();
                $("#ErrorCpasswordText").text("Email or token is invalid");
                break;

              case "EmailNotFound":
                $("#ErrorCpassword").show();
                $("#ErrorCpasswordText").text("Email Not Found");
                break;
            }
          },
        });
      } else {
        $("#ErrorCpassword").show();
        $("#ErrorCpasswordText").text("Passwords do not match");
      }
    } else {
      $("#ErrorPassword").show();
      $("#ErrorPasswordText").text("* This Field Require");
      $("#ErrorCpassword").show();
      $("#ErrorCpasswordText").text("* This Field Require");
    }
  });
});
