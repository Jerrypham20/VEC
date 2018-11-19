
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

    var nameElement = jQuery('.tabs-panel .products').find('.product-inner .mf-product-details .mf-product-content h2');
    function fixHeightLocation (nameElement) {
      if ( jQuery(window).width() > 991 ) {

          nameElement.removeAttr('sytle');
          var heightLocation = 0;
          nameElement.each(function() {
              if (jQuery(this).height() > heightLocation) {
                  heightLocation = jQuery(this).outerHeight();
              }
          })

          nameElement.css({ 'height': heightLocation });
      }else {
          nameElement.css({ 'height': 'auto' });
      }
    }


    fixHeightLocation(nameElement);
    jQuery( window ).resize(function() {
      fixHeightLocation(nameElement);
    });

