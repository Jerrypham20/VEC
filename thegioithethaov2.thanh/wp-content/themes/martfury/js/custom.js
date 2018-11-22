
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

    var nameElement = jQuery('.mf-products-tabs .tabs-content .products').find('.product');
    //var productList = jQuery('.mf-products-tabs .tabs-content .tabs-25').find('.product');
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
          //productList.css({ 'min-height': heightLocation });
      }else {
          nameElement.css({ 'height': 'auto' });
          //productList.css({ 'min-height': 'auto' });
      }
    }


    fixHeightLocation(nameElement);
    //fixHeightLocation(productList);
    jQuery( window ).resize(function() {
      fixHeightLocation(nameElement);
      //fixHeightLocation(nameElement);
    });

