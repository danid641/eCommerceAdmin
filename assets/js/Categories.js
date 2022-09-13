$(document).ready(function () {
  $("#AddCategory").click(function (e) {
    e.preventDefault();
    CategoryName = $("#CategoryName");
    Description = $("#Description");
    MetaTagKeywords = $("#MetaTagKeywords");
    MetaTagDescription = $("#MetaTagDescription");

    if (
      CategoryName.val() &&
      Description.val() &&
      MetaTagKeywords.val() &&
      MetaTagDescription.val()
    ) {
      $("#ErrorCategoryName").hide();
      $("#ErrorDescription").hide();
      $("#ErrorMetaTagKeywords").hide();
      $("#ErrorMetaTagDescription").hide();
      $("#ErrorCategoryNameText").text("");
      $("#ErrorDescriptionText").text("");
      $("#ErrorMetaTagKeywordsText").text("");
      $("#ErrorMetaTagDescriptionText").text("");

      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data:
          "CategoryName=" +
          CategoryName.val() +
          "&Description=" +
          Description.val() +
          "&MetaTagKeywords=" +
          MetaTagKeywords.val() +
          "&MetaTagDescription=" +
          MetaTagDescription.val() +
          "&action=AddCategory",
        success: function (response) {
          switch (response) {
            case "success":
              window.location.replace("../Categories.php")
              break;
          }
        },
      });
    } else {
      $("#ErrorCategoryName").show();
      $("#ErrorDescription").show();
      $("#ErrorMetaTagKeywords").show();
      $("#ErrorMetaTagDescription").show();
      $("#ErrorCategoryNameText").text("* This Field Require");
      $("#ErrorDescriptionText").text("* This Field Require");
      $("#ErrorMetaTagKeywordsText").text("* This Field Require");
      $("#ErrorMetaTagDescriptionText").text("* This Field Require");
    }
  });

  $("#UpdateCategory").click(function (e) {
    e.preventDefault();

    InitialCategoryName = $("#InitialCategoryName");
    CategoryName = $("#CategoryName");
    Description = $("#Description");
    MetaTagKeywords = $("#MetaTagKeywords");
    MetaTagDescription = $("#MetaTagDescription");

    if (
      CategoryName.val() &&
      Description.val() &&
      MetaTagKeywords.val() &&
      MetaTagDescription.val()
    ) {
      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data:
          "InitialCategoryName=" +
          InitialCategoryName.val() +
          "&CategoryName=" +
          CategoryName.val() +
          "&Description=" +
          Description.val() +
          "&MetaTagKeywords=" +
          MetaTagKeywords.val() +
          "&MetaTagDescription=" +
          MetaTagDescription.val() +
          "&action=UpdateCategory",
        success: function (response) {
          console.log(response);
        },
      });
    }
  });

  $("[id=DeleteCategory]").click(function (e) {
    e.preventDefault();
    CategoryId = $(this).attr("data-CategoryId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "CategoryId=" + CategoryId + "&action=DeleteCategory",
      success: function (response) {
        console.log(response);
        $("[data-CategoryColumnId=" + CategoryId + "]").remove();
      },
    });
  });
});
