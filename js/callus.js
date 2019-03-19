(function ($, Drupal, drupalSettings) {

  Drupal.behaviors.callus = {

    attach: function (context, settings) {

      $(document).ready(function(){

    if ( $('body').length && !($('#cms_callus').length) ) {
        var cms_phone_number = drupalSettings.cms_phone_number;
        var cms_button_lable = drupalSettings.cms_button_lable;
        //$('body').append('<a href="tel:'+cms_phone_number+'" class="scrollup" id="cms_scrollup">'+cms_button_lable+'</a><div class="icon-bar"><a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="twitter"><i class="fa fa-twitter"></i></a><a href="#" class="google"><i class="fa fa-google"></i></a><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></div>');
          $('body').append('<a href="tel:'+cms_phone_number+'" class="callus" id="cms_callus">'+cms_button_lable+'</a><div class="icon-bar" id="cmssocial"></div>');
          //$('body').append('<div class="icon-bar"></div>');
          var cms_button_side = drupalSettings.cms_button_side;
          var cms_button_lable = drupalSettings.cms_button_lable;
          var cms_color_picker = drupalSettings.cms_color_picker;
          var cms_color_font = drupalSettings.cms_color_font;

           //Social Icon Conn
          var cms_facebook = drupalSettings.cms_facebook;
          var cms_gmail = drupalSettings.cms_gmail;
          var cms_twitter = drupalSettings.cms_twitter;
          var cms_linkedin = drupalSettings.cms_linkedin;
          var cms_youtube = drupalSettings.cms_youtube;

          $('.callus').css({"color":cms_color_font});
          if (cms_button_side == 1) {
            $('.callus').css({"right":"100px","background-color":cms_color_picker});
          } else {
            $('.callus').css({"left":"100px","background-color":cms_color_picker});
          }

         // $('body').append('<a href="#" class="facebook"><i class="fa fa-facebook"></i></a><a href="#" class="twitter"><i class="fa fa-twitter"></i></a><a href="#" class="google"><i class="fa fa-google"></i></a><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></div>');
          if (cms_facebook) {
           $('#cmssocial').append('<a href="'+cms_facebook+'" class="facebook"><i class="fa fa-facebook"></i></a>');
          //}else{
          // $('.icon-bar').append('<a href="'+cms_facebook+'" class="facebook"><i class="fa fa-facebook"></i></a>');
          } if (cms_gmail) {
           $('#cmssocial').append('<a href="'+cms_gmail+'" class="google"><i class="fa fa-google"></i></a>');
          //}else{
          // $('.icon-bar').append('<a href="'+cms_facebook+'" class="facebook"><i class="fa fa-facebook"></i></a>');
          } if (cms_twitter) {
           $('#cmssocial').append('<a href="'+cms_twitter+'" class="twitter"><i class="fa fa-twitter"></i></a>');
          //}else{
          // $('.icon-bar').append('<a href="'+cms_facebook+'" class="facebook"><i class="fa fa-facebook"></i></a>');
          } if (cms_linkedin) {
           $('#cmssocial').append('<a href="'+cms_linkedin+'" class="linkedin"><i class="fa fa-linkedin"></i></a>');
          //}else{
          // $('.icon-bar').append('<a href="'+cms_facebook+'" class="facebook"><i class="fa fa-facebook"></i></a>');
          }if (cms_youtube) {
           $('#cmssocial').append('<a href="'+cms_youtube+'" class="youtube"><i class="fa fa-youtube"></i></a>');
          //}else{
          // $('.icon-bar').append('<a href="'+cms_facebook+'" class="facebook"><i class="fa fa-facebook"></i></a>');
          }
        }

      });
    }
  };
})(jQuery, Drupal, drupalSettings);
