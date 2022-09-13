$(document).ready(function () {
  // Countries
  $("#AddCountry").click(function (e) {
    e.preventDefault();

    CountryName = $("#CountryName");
    ISOCode = $("#ISOCode");

    if (CountryName.val() && ISOCode.val()) {
      $("#ErrorCountryName").hide();
      $("#ErrorCode").hide();
      $("#ErrorCountryNameText").text("");
      $("#ErrorISOCodeText").text("");
      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data:
          "CountryName=" +
          CountryName.val() +
          "&ISOCode=" +
          ISOCode.val() +
          "&action=AddCountry",
        success: function (response) {
          switch (response) {
            case "success":
              window.location.replace("../Countries.php");
              break;
          }
        },
      });
    } else {
      $("#ErrorCountryName").show();
      $("#ErrorCode").show();
      $("#ErrorCountryNameText").text("* This Field Require");
      $("#ErrorISOCodeText").text("* This Field Require");
    }
  });

  // currencies
  $("#AddCurrency").click(function (e) {
    e.preventDefault();

    CurrencyTitle = $("#CurrencyTitle");
    Code = $("#Code");
    value = $("#Value");

    if (CurrencyTitle.val() && Code.val() && value.val()) {
      $("#ErrorCurrencyTitle").hide();
      $("#ErrorCode").hide();
      $("#ErrorValue").hide();
      $("#ErrorCurrencyTitleText").text("");
      $("#ErrorCodeText").text("");
      $("#ErrorValueText").text("");

      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data:
          "CurrencyTitle=" +
          CurrencyTitle.val() +
          "&Code=" +
          Code.val() +
          "&value=" +
          value.val() +
          "&action=AddCurencies",
        success: function (response) {
          switch (response) {
            case "success":
              window.location.replace("../Currencies.php");
              break;
          }
        },
      });
    } else {
      $("#ErrorCurrencyTitle").show();
      $("#ErrorCode").show();
      $("#ErrorValue").show();
      $("#ErrorCurrencyTitleText").text("* This Field Require");
      $("#ErrorCodeText").text("* This Field Require");
      $("#ErrorValueText").text("* This Field Require");
    }
  });

  $("#UpdateCountry").click(function (e) {
    e.preventDefault();

    CountryName = $("#CountryName");
    ISOCode = $("#ISOCode");

    if (CountryName.val() && ISOCode.val()) {
      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data:
          "InitialCountryName=" +
          $("#InitialCountryName").val() +
          "&CountryName=" +
          CountryName.val() +
          "&ISOCode=" +
          ISOCode.val() +
          "&action=UpdateCountry",
        success: function (response) {
          console.log(response);
        },
      });
    }
  });

  $("[id=DeleteCountry]").click(function (e) {
    e.preventDefault();
    CountryId = $(this).attr("data-CountryId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "CountryId=" + CountryId + "&action=DeleteCountry",
      success: function (response) {
        console.log(response);
        $("[data-CountryColumnId=" + CountryId + "]").remove();
      },
    });
  });

  $("[id=DeleteCurrency]").click(function (e) {
    e.preventDefault();
    CurrencyId = $(this).attr("data-CurrencyId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "CurrencyId=" + CurrencyId + "&action=DeleteCurrency",
      success: function (response) {
        console.log(response);
        $("[data-CurrencyColumnId=" + CurrencyId + "]").remove();
      },
    });
  });
});
