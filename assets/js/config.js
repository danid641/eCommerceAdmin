$(document).ready(function () {
  if(typeof ConfigCancel === 'undefined'){
    ConfigCancel = false;
  }
  
  if (ConfigCancel != true) {
    Swal.fire({
      html: '<div class="text-heading">Quick Start Wizard</div><hr><div class="row"><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="StoreName" type="text" placeholder="Store Name:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="Title" type="text" placeholder="Title:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="MetaTagDescription" type="text" placeholder="Meta Tag Description:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="MetaKeywords" type="text" placeholder="Meta Keywords:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="WelcomeMessage" type="text" placeholder="Welcome Message:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="StoreOwner" type="text" placeholder="Store Owner:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="Address" type="text" placeholder="Address:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="E-Mail" type="text" placeholder="E-Mail:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="Telephone" type="text" placeholder="Telephone:"></div><div class="col-lg-6 col-12 mb-30"><input class="form-control" id="Country" type="text" placeholder="Country:"></div></div><div class="row"><div class=" col mbn-10"><button id="SaveConfigData" class="button button-outline button-success">Save</button><a class="ml-5"><button id="swal-cancel" class="button button-outline button-danger">Cancel</button></a></div></div>',
      customClass: "swal-wide",
      showConfirmButton: false,
    });

    StoreName = $("#StoreName");
    Title = $("#Title");
    MetaTagDescription = $("#MetaTagDescription");
    MetaKeywords = $("#MetaKeywords");
    WelcomeMessage = $("#WelcomeMessage");
    StoreOwner = $("#StoreOwner");
    Address = $("#Address");
    EMail = $("#E-Mail");
    Telephone = $("#Telephone");
    Country = $("#Country");

    $("#swal-cancel").click(function () {
      $.ajax({
        url: "assets/php/action.php",
        method: "POST",
        data: "action=ConfigCancel",
        success: function (response) {
          console.log(response);
        },
      });
      swal.clickConfirm();
    });

    $("#SaveConfigData").click(function () {
      $.ajax({
        url: "assets/php/action.php",
        method: "POST",
        data:
          "StoreName=" +
          StoreName.val() +
          "&Title=" +
          Title.val() +
          "&MetaTagDescription=" +
          MetaTagDescription.val() +
          "&MetaKeywords=" +
          MetaKeywords.val() +
          "&WelcomeMessage=" +
          WelcomeMessage.val() +
          "&StoreOwner=" +
          StoreOwner.val() +
          "&Address=" +
          Address.val() +
          "&EMail=" +
          EMail.val() +
          "&Telephone=" +
          Telephone.val() +
          "&Country=" +
          Country.val() +
          "&action=config",
        success: function (response) {
          console.log(response);
        },
      });
      swal.clickConfirm();
    });
  }
});
