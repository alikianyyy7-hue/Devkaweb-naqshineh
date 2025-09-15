jQuery(document).ready(function($){
  $(".like-button").on("click", function(){
    var button = $(this);
    var post_id = button.data("post-id");
    var count_span = button.find(".like-count");
    var icon_span = button.find(".like-icon");

    var liked = button.hasClass("liked");

    if(liked){
      // برداشتن لایک
      button.removeClass("liked");
      var count = parseInt(count_span.text()) - 1;
      count_span.text(count);
      icon_span.html('<i class="far fa-heart"></i>'); // قلب توخالی
      document.cookie = "liked_" + post_id + "=; path=/; max-age=0"; 
    } else {
      // اضافه کردن لایک
      button.addClass("liked");
      var count = parseInt(count_span.text()) + 1;
      count_span.text(count);
      icon_span.html('<i class="fas fa-heart text-red-500"></i>'); // قلب پر
      document.cookie = "liked_" + post_id + "=1; path=/; max-age=" + 60*60*24*365;
    }

    // ارسال AJAX به سرور برای ذخیره تغییر
    $.ajax({
      url: like_ajax.ajaxurl,
      type: "POST",
      data: {
        action: "post_like_toggle",
        post_id: post_id,
        liked: !liked // وضعیت جدید
      }
    });
    
  });
});
