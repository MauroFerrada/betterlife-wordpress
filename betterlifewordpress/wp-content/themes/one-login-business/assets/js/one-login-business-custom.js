// NAVIGATION CALLBACK
var ww = jQuery(window).width();
jQuery(document).ready(function() { 
  jQuery(".nav li a").each(function() {
    if (jQuery(this).next().length > 0) {
      jQuery(this).addClass("parent");
    };
  })
  jQuery(".toggleMenu").click(function(e) { 
    e.preventDefault();
    jQuery(this).toggleClass("active");
    jQuery(".nav").slideToggle('fast');
  });
  adjustMenu();
})

// navigation orientation resize callbak
jQuery(window).bind('resize orientationchange', function() {
  ww = jQuery(window).width();
  adjustMenu();
});

var adjustMenu = function() {
  if (ww < 720) {
    jQuery(".toggleMenu").css("display", "block");
    if (!jQuery(".toggleMenu").hasClass("active")) {
      jQuery(".nav").hide();
    } else {
      jQuery(".nav").show();
    }
    jQuery(".nav li").unbind('mouseenter mouseleave');
  } else {
    jQuery(".toggleMenu").css("display", "none");
    jQuery(".nav").show();
    jQuery(".nav li").removeClass("hover");
    jQuery(".nav li a").unbind('click');
    jQuery(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
      jQuery(this).toggleClass('hover');
    });
  }
}

jQuery('document').ready(function($){
  $('.search-box span i').click(function(){
      $(".serach_outer").slideDown(700);
  });

  $('.closepop i').click(function(){
      $(".serach_outer").slideUp(700);
  });
});

jQuery(window).scroll(function(){
  if (jQuery(this).scrollTop() > 100) {
    jQuery('.scrollup').addClass('is-active');
  } else {
      jQuery('.scrollup').removeClass('is-active');
  }
});

jQuery( document ).ready(function() {
  jQuery('#one-login-business-scroll-to-top').click(function (argument) {
    jQuery("html, body").animate({
           scrollTop: 0
       }, 600);
  })
})

jQuery(window).load(function() {
  jQuery(".preloader").delay(2000).fadeOut("slow");
});
// sticky header
jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 120) {
        jQuery('.fixed_header').addClass('fixed');
    } else {
            jQuery('.fixed_header').removeClass('fixed');
    }
});
