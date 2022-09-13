$(document).ready(function () {
  MailProtocol = $("#MailProtocol");
  mail = $("#mail");
  smtp = $("#smtp");

  smtp.hide();

  MailProtocol.change(function () {
    switch (MailProtocol.val()) {
      case "mail":
        mail.show();
        smtp.hide();
        break;
      case "smtp":
        mail.hide();
        smtp.show();
        break;
      default:
        mail.show();
        smtp.hide();
        break;
    }
  });

  $("#SaveSmtpConfigData").click(function (e) {
    e.preventDefault();

    SmtpHost = $("#SmtpHost");
    SmtpUsername = $("#SmtpUsername");
    SmtpPassword = $("#SmtpPassword");
    SmtpPort = $("#SmtpPort");
    SmtpTimeout = $("#SmtpTimeou");
    AlertMail = $("#AlertMail");
    AdditionalAlert = $("#AdditionalAlert");

    if (!SmtpPassword.val()) {
      SMTPAuth = true;
    }
   
    if(SmtpHost.val() && SmtpUsername.val() && SmtpPort.val()){
      $.ajax({
        url: "assets/php/action.php",
        method: "POST",
        data: "Host=" + SmtpHost.val() + "&Auth=" + SMTPAuth + "&Username=" + SmtpUsername.val() + "&Password=" + SmtpPassword.val() + "&Port=" + SmtpPort.val() + "&action=SmtpConfig",
        success: function (response) {
          console.log(response);
        },
      });
    }
  
  });
});
