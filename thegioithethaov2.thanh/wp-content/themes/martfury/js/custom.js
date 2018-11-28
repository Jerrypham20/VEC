
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

    //gallery single product
    jQuery(".lazy").slick({
        lazyLoad: 'ondemand', // ondemand progressive anticipated
        infinite: true,
        dots: true,
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>',
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>'
      });

    jQuery('.lazy').hover(function() {
      jQuery('.lazy .slick-arrow').toggleClass('arrow-show');
    })


    //scroll to div
    jQuery(".sc-tabs li").find("a").click(function(e) {
        e.preventDefault();
        var section = jQuery(this).attr("href");
        jQuery('html, body').animate({
          scrollTop: jQuery(jQuery(this).attr('href')).offset().top -100
        }, 600, 'linear');
    });


    //view more sinlge product 
    jQuery('.view-more').click(function() {
      jQuery('.content-product').addClass('content-heightauto');

      return false;
    })

    var nameElement = jQuery('.mf-products-tabs-highlight .tabs-content .products').find('.product');
    var titleRelated = jQuery('.related products .mf-product-content').find('h2');
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

    function fixHeightLocationNormal (nameElement) {
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
    fixHeightLocationNormal(titleRelated);
    //fixHeightLocation(nameElementCat);
    fixHeightLocationNormal(bannerCategory);
    jQuery( window ).resize(function() {
      fixHeightLocation(nameElement);
      fixHeightLocationNormal(titleRelated);
      //fixHeightLocation(nameElementCat);
      fixHeightLocationNormal(bannerCategory);
    });
    jQuery( window ).load(function() {
      fixHeightLocation(nameElement);
      fixHeightLocationNormal(titleRelated);
      //fixHeightLocation(nameElementCat);
      fixHeightLocationNormal(bannerCategory);
    });

