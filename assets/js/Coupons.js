$(document).ready(function () {
  $("#AddCupon").click(function (e) {
    e.preventDefault();

    CouponName = $("#CouponName");
    Code = $("#Code");
    CouponDescription = $("#CouponDescription");
    Type = $("#type");
    Discount = $("#Discount");
    FreeShipping = $("#FreeShipping");
    DateStart = $("#DateStart");
    DateEnd = $("#DateEnd");
    Categories = $("#Categories");

    if (
      CouponName.val() &&
      Code.val() &&
      CouponDescription.val() &&
      Type.val() &&
      Discount.val() &&
      FreeShipping.val() &&
      DateStart.val() &&
      DateEnd.val() &&
      Categories.val()
    ) {
      $("#ErrorCouponName").hide();
      $("#ErrorCouponNameText").text("");
      $("#ErrorCode").hide();
      $("#ErrorCodeText").text("");
      $("#ErrorCouponDescription").hide();
      $("#ErrorCouponDescriptionText").text("");
      $("#ErrorDiscount").hide();
      $("#ErrorDiscountText").text("");
      $("#ErrorDateStart").hide();
      $("#ErrorDateStartText").text("");
      $("#ErrorDateEnd").hide();
      $("#ErrorDateEndText").text("");

      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data:
          "CouponName=" +
          CouponName.val() +
          "&Code=" +
          Code.val() +
          "&CouponDescription=" +
          CouponDescription.val() +
          "&Type=" +
          Type.val() +
          "&Discount=" +
          Discount.val() +
          "&FreeShipping=" +
          FreeShipping.val() +
          "&DateStart=" +
          DateStart.val() +
          "&DateEnd=" +
          DateEnd.val() +
          "&Categories=" +
          Categories.val() +
          "&action=AddCupon",
        success: function (response) {
          switch (response) {
            case "success":
              window.location.replace("../Coupons.php");
              break;
          }
        },
      });
    } else {
      $("#ErrorCouponName").show();
      $("#ErrorCouponNameText").text("* This Field Require");
      $("#ErrorCode").show();
      $("#ErrorCodeText").text("* This Field Require");
      $("#ErrorCouponDescription").show();
      $("#ErrorCouponDescriptionText").text("* This Field Require");
      $("#ErrorDiscount").show();
      $("#ErrorDiscountText").text("* This Field Require");
      $("#ErrorDateStart").show();
      $("#ErrorDateStartText").text("* This Field Require");
      $("#ErrorDateEnd").show();
      $("#ErrorDateEndText").text("* This Field Require");
    }
  });

  $("#UpdateCupon").click(function (e) {
    e.preventDefault();

    CouponName = $("#CouponName");
    Code = $("#Code");
    CouponDescription = $("#CouponDescription");
    Type = $("#type");
    Discount = $("#Discount");
    FreeShipping = $("#FreeShipping");
    DateStart = $("#DateStart");
    DateEnd = $("#DateEnd");
    Categories = $("#Categories");

    if (
      CouponName.val() &&
      Code.val() &&
      CouponDescription.val() &&
      Type.val() &&
      Discount.val() &&
      FreeShipping.val() &&
      DateStart.val() &&
      DateEnd.val() &&
      Categories.val()
    ) {
      $.ajax({
        url: "../assets/php/action.php",
        method: "POST",
        data:
          "CouponName=" +
          CouponName.val() +
          "&Code=" +
          Code.val() +
          "&CouponDescription=" +
          CouponDescription.val() +
          "&Type=" +
          Type.val() +
          "&Discount=" +
          Discount.val() +
          "&FreeShipping=" +
          FreeShipping.val() +
          "&DateStart=" +
          DateStart.val() +
          "&DateEnd=" +
          DateEnd.val() +
          "&Categories=" +
          Categories.val() +
          "&action=UpdateCupon",
        success: function (response) {
          console.log(response);
        },
      });
    }
  });

  $("[id=DeleteCoupon]").click(function (e) {
    e.preventDefault();
    CouponId = $(this).attr("data-CouponId");

    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "CouponId=" + CouponId + "&action=DeleteCoupon",
      success: function (response) {
        console.log(response);
        $("[data-CouponColumnId=" + CouponId + "]").remove();
      },
    });
  });
});
