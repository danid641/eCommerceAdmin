$(document).ready(function () {
  $("#SaveSocialLink").click(function (e) {
    e.preventDefault();

    isValidUrl = (urlString) => {
      urlPattern = new RegExp(
        "^(https?:\\/\\/)?" + // validate protocol
          "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|" + // validate domain name
          "((\\d{1,3}\\.){3}\\d{1,3}))" + // validate OR ip (v4) address
          "(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*" + // validate port and path
          "(\\?[;&a-z\\d%_.~+=-]*)?" + // validate query string
          "(\\#[-a-z\\d_]*)?$",
        "i"
      ); // validate fragment locator
      return !!urlPattern.test(urlString);
    };

    facebook = $("#facebook");
    twitter = $("#twitter");
    youtube = $("#youtube");
    Instagram = $("#Instagram");
    TikTok = $("#TikTok");

    if (
      facebook.val() &&
      twitter.val() &&
      youtube.val() &&
      Instagram.val() &&
      TikTok.val()
    ) {
      $("#Errorfacebook").hide();
      $("#Errortwitter").hide();
      $("#Erroryoutube").hide();
      $("#ErrorInstagram").hide();
      $("#ErrorTikTok").hide();
      if (
        isValidUrl(facebook.val()) &&
        isValidUrl(twitter.val()) &&
        isValidUrl(youtube.val()) &&
        isValidUrl(Instagram.val()) &&
        isValidUrl(TikTok.val())
      ) {
        $.ajax({
          url: "assets/php/action.php",
          method: "POST",
          data:
            "facebook=" +
            facebook.val() +
            "&twitter=" +
            twitter.val() +
            "&youtube=" +
            youtube.val() +
            "&instagram=" +
            Instagram.val() +
            "&TikTok=" +
            TikTok.val() +
            "&action=ConfigSocial",
          success: function (response) {
            console.log(response);
          },
        });
      } else {

        switch (!isValidUrl()) {
          case facebook.val():
            $("#Errorfacebook").show();
            $("#ErrorfacebookText").text("This Field Require");
           console.log(1)
            break;

          case twitter.val():
            $("#Errortwitter").show();
            $("#ErrortwitterText").text("This Field Require");
            break;

          case youtube.val():
            $("#Erroryoutube").show();
            $("#ErroryoutubeText").text("This Field Require");
            break;

          case Instagram.val():
            $("#ErrorInstagram").show();
            $("#ErrorInstagramText").text("This Field Require");

            break;

          case TikTok.val():
            $("#ErrorTikTok").show();
            $("#ErrorTikTokText").text("This Field Require");
            break;
        }

        console.log("url incorect :{@};");
      }
    } else {
      $("#Errorfacebook").show();
      $("#Errortwitter").show();
      $("#Erroryoutube").show();
      $("#ErrorInstagram").show();
      $("#ErrorTikTok").show();
      $("#ErrorfacebookText").text("This Field Require");
      $("#ErrortwitterText").text("This Field Require");
      $("#ErroryoutubeText").text("This Field Require");
      $("#ErrorInstagramText").text("This Field Require");
      $("#ErrorTikTokText").text("This Field Require");
    }
  });
});
