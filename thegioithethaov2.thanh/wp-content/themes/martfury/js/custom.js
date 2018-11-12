(function ($) {
    'use strict';
//Flexslider
	jQuery(function(){
      SyntaxHighlighter.all();
    });
    jQuery(window).load(function(){
      jQuery('#banner-title').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider-image'
      });

      jQuery('#slider-image').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#banner-title",
        start: function(slider){
          jQuery('body').removeClass('loading');
        }
      });
    });
});