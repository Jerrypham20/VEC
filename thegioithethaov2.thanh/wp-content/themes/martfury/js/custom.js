
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

    var nameElement = jQuery('.mf-products-tabs-highlight .tabs-content .products').find('.product');
    //var nameElementSale = jQuery('.jr-best-selling .tabs-content .products').find('.product');
    //var nameElementCat = jQuery('#mf-shop-content .products').find('.product-inner');
    var bannerCategory = jQuery('.catalog-banner-top').find('.banner-height');
    function fixHeightLocation (nameElement) {
      if ( jQuery(window).width() > 991 ) {

          nameElement.removeAttr('sytle');
          var heightLocation = 0;
          nameElement.each(function() {
              if (jQuery(this).height() > heightLocation) {
                  heightLocation = jQuery(this).outerHeight();
              }
          })

          nameElement.css({ 'height': heightLocation - 30 });
      }else {
          nameElement.css({ 'height': 'auto' });
      }
    }


    fixHeightLocation(nameElement);
    //fixHeightLocation(nameElementSale);
    //fixHeightLocation(nameElementCat);
    fixHeightLocation(bannerCategory);
    jQuery( window ).resize(function() {
      fixHeightLocation(nameElement);
      //fixHeightLocation(nameElementSale);
      //fixHeightLocation(nameElementCat);
      fixHeightLocation(bannerCategory);
    });
    jQuery( window ).load(function() {
      fixHeightLocation(nameElement);
      //fixHeightLocation(nameElementSale);
      //fixHeightLocation(nameElementCat);
      fixHeightLocation(bannerCategory);
    });

