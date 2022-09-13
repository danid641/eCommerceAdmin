$(document).ready(function (e) {
  // Add Users
  $("#AddUser").click(function (e) {
    e.preventDefault();

    Username = $("#Username");
    Password = $("#Password");
    Cpassword = $("#CPassword");
    UserGroup = $("#UserGroup");
    EMail = $("#EMail");

    if (
      Username.val() &&
      Password.val() &&
      Cpassword.val() &&
      UserGroup.val() &&
      EMail.val()
    ) {
      // If not empty: Unset Error
      $("#ErrorUsername").hide();
      $("#ErrorUsernameText").text();
      $("#ErrorLastName").hide();
      $("#ErrorLastNameText").text();
      $("#ErrorPassword").hide();
      $("#ErrorPasswordText").text();
      $("#ErrorEmail").hide();
      $("#ErrorEmailText").text();
      if (Password.val() == Cpassword.val()) {
        $.ajax({
          url: "../assets/php/action.php",
          method: "POST",
          data:
            "Username=" +
            Username.val() +
            "&Password=" +
            Password.val() +
            "&UserGroup=" +
            UserGroup.val() +
            "&EMail=" +
            EMail.val() +
            "&action=AddUsers",
          success: function (response) {
            console.log(response);
            switch (response) {
              case "success":
                window.location.replace("../users.php");

                break;

              case "EmailExist":
                // Email Exist Error
                $("#ErrorEmail").show();
                $("#ErrorEmailText").text("That email is taken. Try another.");
                break;
            }
          },
        });
      } else {
        // Password Not Match
        $("#ErrorPassword").show();
        $("#ErrorPasswordText").text("password not match");
      }
    } else {
      // Field Empty
      $("#ErrorUsername").show();
      $("#ErrorUsernameText").text("* This Field Require");
      $("#ErrorFirstName").show();
      $("#ErrorFirstNameText").text("* This Field Require");
      $("#ErrorLastName").show();
      $("#ErrorLastNameText").text("* This Field Require");
      $("#ErrorPassword").show();
      $("#ErrorPasswordText").text("* This Field Require");
      $("#ErrorEmail").show();
      $("#ErrorEmailText").text("* This Field Require");
    }
  });

  // Add Group
  $("#AddGroup").click(function (e) {
    e.preventDefault();

    UserGroupName = $("#GroupName");
    if (UserGroupName.val()) {
      $("#ErrorGroupName").hide();
      $("#ErrorGroupNameText").text("");
      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data: "GroupName=" + UserGroupName.val() + "&action=AddGroup",
        success: function (response) {
          switch (response) {
            case "success":
              window.location.replace("../UserGroups.php");
              $("#ErrorGroupName").hide();
              $("#ErrorGroupNameText").text();
              break;

            case "UserGroupNameExist":
              $("#ErrorGroupName").show();
              $("#ErrorGroupNameText").text("That Name is taken. Try another.");
              break;
          }
        },
      });
    } else {
      // User Group Name Field Empty Error
      $("#ErrorGroupName").show();
      $("#ErrorGroupNameText").text("* This Field Require");
    }
  });

  // Update

  $("#UpdateUser").click(function (e) {
    e.preventDefault();

    Username = $("#Username");
    Password = $("#Password");
    Cpassword = $("#CPassword");
    UserGroup = $("#UserGroup");
    EMail = $("#EMail");

    if (
      Username.val() &&
      Password.val() &&
      Cpassword.val() &&
      UserGroup.val() &&
      EMail.val()
    ) {
      $("#ErrorUsernameName").hide();
      $("#ErrorUsernameNameText").text();
      $("#ErrorPassword").hide();
      $("#ErrorPasswordText").text();
      $("#ErrorEMail").hide();
      $("#ErrorEMailText").text();
      if (Password.val() == Cpassword.val()) {
        $.ajax({
          url: "../assets/php/action.php",
          method: "POST",
          data:
            "Username=" +
            Username.val() +
            "&Password=" +
            Password.val() +
            "&UserGroup=" +
            UserGroup.val() +
            "&EMail=" +
            EMail.val() +
            "&action=UpdateUser",
          success: function (response) {
            switch (response) {
            }
          },
        });
      } else {
        // Password Not Match Error
        $("#ErrorPassword").show();
        $("#ErrorPasswordText").text("Password Not Match");
      }
    } else {
      // Empty Field Error
      $("#ErrorUsernameName").show();
      $("#ErrorUsernameNameText").text("* This Field Require");
      $("#ErrorPassword").show();
      $("#ErrorPasswordText").text("* This Field Require");
      $("#ErrorEMail").show();
      $("#ErrorEMailText").text("* This Field Require");
    }
  });

  $("#UpdateGroup").click(function (e) {
    e.preventDefault();

    UserGroupName = $("#GroupName");
    InitialGroupName = $("#InitialGroupName");
    if (UserGroupName.val()) {
      $("#ErrorGroupName").hide();
      $("#ErrorGroupNameText").text("");
      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data:
          "InitialGroupName=" +
          InitialGroupName.val() +
          "&GroupName=" +
          UserGroupName.val() +
          "&action=UpdateGroup",
        success: function (response) {
          console.log(response);
          switch (response) {
            case "success":
              window.location.replace("../UserGroups.php");
              $("#ErrorGroupName").hide();
              $("#ErrorGroupNameText").text();
              break;

            case "GroupNameExist":
              $("#ErrorGroupName").show();
              $("#ErrorGroupNameText").text("That Name is taken. Try another.");
              break;
          }
        },
      });
    } else {
      // User Group Name Field Empty Error
      $("#ErrorGroupName").show();
      $("#ErrorGroupNameText").text("* This Field Require");
    }
  });

  // Delte User
  $("[id=DeleteUser]").click(function (e) {
    e.preventDefault();
    UserId = $(this).attr("data-UserId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "UserId=" + UserId + "&action=DeleteUser",
      success: function (response) {
        console.log(response);
        $("[data-UserColumnId=" + UserId + "]").remove();
      },
    });
  });

  // Delte Group
  $("[id=DeleteGroup]").click(function (e) {
    e.preventDefault();
    GroupId = $(this).attr("data-GroupId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "GroupId=" + GroupId + "&action=DeleteGroup",
      success: function (response) {
        console.log(response);
        $("[data-GroupColumnId=" + GroupId + "]").remove();
      },
    });
  });
});
