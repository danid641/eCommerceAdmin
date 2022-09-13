$(document).ready(function () {
  $("[id=DeleteProduct]").click(function (e) {
    e.preventDefault();

    ProductId = $(this).attr("data-ProductId");
    console.log(ProductId);
    $.ajax({
      url: "assets/php/action.php",
      method: "POST",
      data: "ProductId=" + ProductId + "&action=DeleteProducts",
      success: function (response) {
        $("[data-ProductColumnId=" + ProductId + "]").remove();
      },
    });
  });

  $("#AddProduct").click(function (e) {
    e.preventDefault();

    ProductName = $("#ProductName");
    Category = $("#category");
    ProductDescription = $("#ProductDescription");
    ProductPrice = $("#ProductPrice");
    ProductDiscount = $("#ProductDiscount");
    Status = $("#status");
    Tags = $("#Tags");
    StatusValueList = ["publish", "Invisible"];
    Stock = $("#Stock");

    var fd = new FormData($("#Product-Form")[0].files);

    fd.append("ProductName", ProductName.val());
    fd.append("Category", Category.val());
    fd.append("ProductDescription", ProductDescription.val());
    fd.append("ProductPrice", ProductPrice.val());
    fd.append("ProductDiscount", ProductDiscount);
    fd.append("Status", Status.val());
    fd.append("stock", Stock.val());
    fd.append("Tags", Tags.val());
    fd.append("action", "AddProducts");

    pondFiles = pond.getFiles();
    for (var i = 0; i < pondFiles.length; i++) {
      fd.append("file[]", pondFiles[i].file);
    }

    if (
      ProductName.val() &&
      Category.val() &&
      ProductDescription.val() &&
      ProductPrice.val() &&
      Status.val() &&
      Tags.val() &&
      Stock.val() &&
      pondFiles[0].fileSize > 0
    ) {
      $("#ErrorProductName").hide();
      $("#ErrorProductNameText").text("");
      $("#ErrorProductDescription").hide();
      $("#ErrorProductDescriptionText").text("");
      $("#ErrorProductPrice").hide();
      $("#ErrorProductPriceText").text("");
      $("#ErrorProductStock").hide();
      $("#ErrorProductStockText").text("");
      $("#ErrorTags").hide();
      $("#ErrorTagsText").text("");
      $("#ErrorProductImage").hide();
      $("#ErrorProductImageText").text("");

      $.ajax({
        url: "../assets/php/action.php",
        type: "POST",
        data: fd,
        dataType: "JSON",
        contentType: false,
        cache: true,
        processData: false,
        error: function (data) {
          window.location.replace("../products.php");
        },
      });
    } else {
      $("#ErrorProductName").show();
      $("#ErrorProductNameText").text("* This Field Require");
      $("#ErrorProductDescription").show();
      $("#ErrorProductDescriptionText").text("* This Field Require");
      $("#ErrorProductPrice").show();
      $("#ErrorProductPriceText").text("* This Field Require");
      $("#ErrorProductStock").show();
      $("#ErrorProductStockText").text("* This Field Require");
      $("#ErrorTags").show();
      $("#ErrorTagsText").text("* This Field Require");
      $("#ErrorProductImage").show();
      $("#ErrorProductImageText").text("* This Field Require");
    }
  });

  $("#ProductImage").filepond({
    allowMultiple: true,
    server: "http://localhost/",
  });

  $(".filepond--credits").remove();

  pond = FilePond.create(document.querySelector("#ProductImage"), {
    allowMultiple: true,
    instantUpload: true,
    allowProcess: false,
  });

  img.forEach((image) => {
    $("#ProductImage").filepond(
      "addFile",
      "https://localhost/ecommerce/GetImage.php?ImageId=" + image
    );
    console.log("https://localhost/ecommerce/GetImage.php?ImageId=" + image);
  });

  $("#UpdateProduct").click(function (e) {
    e.preventDefault();
    InitialProductName = $("#InitialProductName");
    ProductName = $("#ProductName");
    Category = $("#category");
    ProductDescription = $("#ProductDescription");
    ProductPrice = $("#ProductPrice");
    ProductDiscount = $("#ProductDiscount");
    Status = $("#status");
    Tags = $("#Tags");
    StatusValueList = ["publish", "Invisible"];
    Stock = $("#Stock");

    var fd = new FormData($("#Product-Form")[0].files);

    fd.append("InitialProductName", InitialProductName.val());
    fd.append("ProductName", ProductName.val());
    fd.append("Category", Category.val());
    fd.append("ProductDescription", ProductDescription.val());
    fd.append("ProductPrice", ProductPrice.val());
    fd.append("Status", Status.val());
    fd.append("stock", Stock.val());
    fd.append("Tags", Tags.val());
    fd.append("action", "UpdateProduct");

    pondFiles = pond.getFiles();
    for (var i = 0; i < pondFiles.length; i++) {
      fd.append("file[]", pondFiles[i].file);
    }

    if (
      ProductName.val() &&
      Category.val() &&
      ProductDescription.val() &&
      ProductPrice.val() &&
      Status.val() &&
      Tags.val() &&
      Stock.val() &&
      pondFiles[0].fileSize > 0
    ) {
      $("#ErrorProductName").hide();
      $("#ErrorProductNameText").text("");
      $("#ErrorProductDescription").hide();
      $("#ErrorProductDescriptionText").text("");
      $("#ErrorProductPrice").hide();
      $("#ErrorProductPriceText").text("");
      $("#ErrorProductStock").hide();
      $("#ErrorProductStockText").text("");
      $("#ErrorTags").hide();
      $("#ErrorTagsText").text("");
      $("#ErrorProductImage").hide();
      $("#ErrorProductImageText").text("");

      $.ajax({
        url: "../assets/php/action.php",
        type: "POST",
        data: fd,
        dataType: "JSON",
        contentType: false,
        cache: true,
        processData: false,
        error: function (data) {
          console.log(data.responseText);
        },
      });
    } else {
      $("#ErrorProductName").show();
      $("#ErrorProductNameText").text("* This Field Require");
      $("#ErrorProductDescription").show();
      $("#ErrorProductDescriptionText").text("* This Field Require");
      $("#ErrorProductPrice").show();
      $("#ErrorProductPriceText").text("* This Field Require");
      $("#ErrorProductStock").show();
      $("#ErrorProductStockText").text("* This Field Require");
      $("#ErrorTags").show();
      $("#ErrorTagsText").text("* This Field Require");
      $("#ErrorProductImage").show();
      $("#ErrorProductImageText").text("* This Field Require");
    }
  });
});
