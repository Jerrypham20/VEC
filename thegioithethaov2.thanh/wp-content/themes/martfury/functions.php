<?php
/**
 * DrFuri Core functions and definitions
 *
 * @package Martfury
 */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0
 *
 * @return void
 */


function martfury_setup() {
	// Sets the content width in pixels, based on the theme's design and stylesheet.
	$GLOBALS['content_width'] = apply_filters( 'martfury_content_width', 840 );

	// Make theme available for translation.
	load_theme_textdomain( 'martfury', get_template_directory() . '/lang' );

	// Theme supports
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video', 'quote', 'link' ) );
	add_theme_support(
		'html5', array(
			'comment-list',
			'search-form',
			'comment-form',
			'gallery',
		)
	);

	add_editor_style( 'css/editor-style.css' );

	// Register theme nav menu
	$nav_menu = array(
		'primary'         => esc_html__( 'Primary Menu', 'martfury' ),
		'mobile'          => esc_html__( 'Mobile Menu', 'martfury' ),
		'shop_department' => esc_html__( 'Shop By Department Menu', 'martfury' ),
		'user_logged'     => esc_html__( 'User Logged Menu', 'martfury' ),
	);
	if ( martfury_has_vendor() ) {
		$nav_menu['vendor_logged'] = esc_html__( 'Vendor Logged Menu', 'martfury' );
	}
	register_nav_menus( $nav_menu );

	add_image_size( 'martfury-blog-grid', 380, 300, true );
	add_image_size( 'martfury-blog-list', 790, 510, true );
	add_image_size( 'martfury-product-post-list', 100, 65, true );
	add_image_size( 'martfury-blog-masonry', 370, 588, false );
	add_image_size( 'martfury-blog-large', 365, 265, true );
	add_image_size( 'martfury-blog-medium', 180, 120, true );

	global $martfury_woocommerce;
	$martfury_woocommerce = new Martfury_WooCommerce;



	global $martfury_dokan;
	$martfury_dokan = new Martfury_Dokan;

	global $martfury_wcvendors;
	$martfury_wcvendors = new Martfury_WCVendors;

	global $martfury_dcvendors;
	$martfury_dcvendors = new Martfury_DCVendors;

}

add_action( 'after_setup_theme', 'martfury_setup', 100 );

/**
 * Register widgetized area and update sidebar with default widgets.
 *
 * @since 1.0
 *
 * @return void
 */
function martfury_register_sidebar() {
	// Register primary sidebar
	$sidebars = array(
		'blog-sidebar'    			=> esc_html__( 'Blog Sidebar', 'martfury' ),
		'topbar-left'     			=> esc_html__( 'Topbar Left', 'martfury' ),
		'topbar-right'    			=> esc_html__( 'Topbar Right', 'martfury' ),
		'topbar-mobile'   			=> esc_html__( 'Topbar on Mobile', 'martfury' ),
		'header-bar'      			=> esc_html__( 'Header Bar', 'martfury' ),
		'post-sidebar'    			=> esc_html__( 'Single Post Sidebar', 'martfury' ),
		'product-socials'    		=> esc_html__( 'Product list socials in review', 'martfury' ),
		'page-sidebar'    			=> esc_html__( 'Page Sidebar', 'martfury' ),
		'catalog-sidebar' 			=> esc_html__( 'Catalog Sidebar', 'martfury' ),
		'product-sidebar' 			=> esc_html__( 'Single Product Sidebar', 'martfury' ),
		'product-sidebar_bottom' 	=> esc_html__( 'Single Product Sidebar Bottom', 'martfury' ),
		'footer-links'    			=> esc_html__( 'Footer Links', 'martfury' ),
	);

	if ( class_exists( 'WC_Vendors' ) || class_exists( 'WCMp' ) ) {
		$sidebars['vendor_sidebar'] = esc_html( 'Vendor Sidebar', 'martfury' );
	}

	// Register footer sidebars
	for ( $i = 1; $i <= 10; $i++ ) {
		$sidebars["footer-sidebar-$i"] = esc_html__( 'Footer', 'martfury' ) . " $i";
	}

	$custom_sidebar = martfury_get_option( 'custom_product_cat_sidebars' );
	if ( $custom_sidebar ) {
		foreach ( $custom_sidebar as $sidebar ) {
			$title                                = $sidebar['title'];
			$sidebars[ sanitize_title( $title ) ] = $title;
		}
	}

	// Register sidebars
	foreach ( $sidebars as $id => $name ) {
		register_sidebar(
			array(
				'name'          => $name,
				'id'            => $id,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);
	}

	unregister_widget( 'WC_Widget_Layered_Nav' );
	unregister_widget( 'WC_Widget_Layered_Nav_Filters' );
	unregister_widget( 'WC_Widget_Rating_Filter' );

}

add_action( 'widgets_init', 'martfury_register_sidebar' );


//woocommer custom product sorting
add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');
function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'menu_order' => __( 'Sắp xếp mặc định', 'woocommerce' ),
        'popularity' => __( 'Sắp xếp theo thứ tự phổ biến', 'woocommerce' ),
        'rating'     => __( 'Sắp xếp theo điểm đánh giá', 'woocommerce' ),
        'date'       => __( 'Sắp xếp theo sản phẩm mới nhất', 'woocommerce' ),
        'price'      => __( 'Sắp xếp theo giá từ thấp đến cao', 'woocommerce' ),
        'price-desc' => __( 'Sắp xếp theo giá từ cao xuống thấp', 'woocommerce' ),
    );

    return $sorting_options;
}

//custom text add to cart
add_filter('woocommerce_product_single_add_to_cart_text', 'single_custom_add_to_cart_text');
function single_custom_add_to_cart_text($text) {
	$text = sprintf('Thêm vào giỏ hàng') ;
	return $text;
}

//action button mua ngay
add_filter ('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout($checkout_url) {
    global $woocommerce;
    if($_GET['quick_buy']) {
        $checkout_url = $woocommerce->cart->get_checkout_url();
    }
    return $checkout_url;
}
//remove product tabs
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

//get description product
function woocommerce_template_product_description() {
  woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_product_description', 20 );

function woocommerce_template_product_infomation() {
  woocommerce_get_template( 'single-product/tabs/additional-information.php' );
}
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_product_infomation', 20 );

//get review product

add_action( 'woocommerce_after_single_product', 'comments_template', 50 );


// remove product-category in url
/*
* Remove product-category in URL
* Thay product-category bằng slug hiện tại của bạn. Mặc định là product-category
*/
add_filter( 'term_link', 'devvn_product_cat_permalink', 10, 3 );
function devvn_product_cat_permalink( $url, $term, $taxonomy ){
    switch ($taxonomy):
        case 'product_cat':
            $taxonomy_slug = 'product-category'; //Thay bằng slug hiện tại của bạn. Mặc định là product-category
            if(strpos($url, $taxonomy_slug) === FALSE) break;
            $url = str_replace('/' . $taxonomy_slug, '', $url);
            break;
    endswitch;
    return $url;
}
// Add our custom product cat rewrite rules
function devvn_product_category_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'product_cat',
        'post_type' => 'product',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        $siteurl = esc_url(home_url('/'));
        foreach ($terms as $term){
            $term_slug = $term->slug;
            $baseterm = str_replace($siteurl,'',get_term_link($term->term_id,'product_cat'));
            add_rewrite_rule($baseterm.'?$','index.php?product_cat='.$term_slug,'top');
            add_rewrite_rule($baseterm.'/page/([0-9]{1,})?$', 'index.php?product_cat='.$term_slug.'&paged=$matches[1]','top');
			add_rewrite_rule($baseterm.'/(?:feed/)?(feed|rdf|rss|rss2|atom)?$', 'index.php?product_cat='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_product_category_rewrite_rules');
/*Sửa lỗi khi tạo mới taxomony bị 404*/
add_action( 'create_term', 'devvn_new_product_cat_edit_success', 10, 2 );
function devvn_new_product_cat_edit_success( $term_id, $taxonomy ) {
    devvn_product_category_rewrite_rules(true);
}



/*
* Code Bỏ /product/ hoặc /cua-hang/ hoặc /shop/ ... có hỗ trợ dạng %product_cat%
* Thay /cua-hang/ bằng slug hiện tại của bạn
*/
function devvn_remove_slug( $post_link, $post ) {
    if ( !in_array( get_post_type($post), array( 'product' ) ) || 'publish' != $post->post_status ) {
        return $post_link;
    }
    if('product' == $post->post_type){
        $post_link = str_replace( '/cua-hang/', '/', $post_link ); //Thay cua-hang bằng slug hiện tại của bạn
    }else{
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'devvn_remove_slug', 10, 2 );
/*Sửa lỗi 404 sau khi đã remove slug product hoặc cua-hang*/
function devvn_woo_product_rewrite_rules($flash = false) {
    global $wp_post_types, $wpdb;
    $siteLink = esc_url(home_url('/'));
    foreach ($wp_post_types as $type=>$custom_post) {
        if($type == 'product'){
            if ($custom_post->_builtin == false) {
                $querystr = "SELECT {$wpdb->posts}.post_name, {$wpdb->posts}.ID
                            FROM {$wpdb->posts} 
                            WHERE {$wpdb->posts}.post_status = 'publish' 
                            AND {$wpdb->posts}.post_type = '{$type}'";
                $posts = $wpdb->get_results($querystr, OBJECT);
                foreach ($posts as $post) {
                    $current_slug = get_permalink($post->ID);
                    $base_product = str_replace($siteLink,'',$current_slug);
                    add_rewrite_rule($base_product.'?$', "index.php?{$custom_post->query_var}={$post->post_name}", 'top');                    
                    add_rewrite_rule($base_product.'comment-page-([0-9]{1,})/?$', 'index.php?'.$custom_post->query_var.'='.$post->post_name.'&cpage=$matches[1]', 'top');
                    add_rewrite_rule($base_product.'(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?'.$custom_post->query_var.'='.$post->post_name.'&feed=$matches[1]','top');
                }
            }
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_woo_product_rewrite_rules');
/*Fix lỗi khi tạo sản phẩm mới bị 404*/
function devvn_woo_new_product_post_save($post_id){
    global $wp_post_types;
    $post_type = get_post_type($post_id);
    foreach ($wp_post_types as $type=>$custom_post) {
        if ($custom_post->_builtin == false && $type == $post_type) {
            devvn_woo_product_rewrite_rules(true);
        }
    }
}
add_action('wp_insert_post', 'devvn_woo_new_product_post_save');
/**
 * Load theme
 */

// customizer hooks
require get_template_directory() . '/inc/backend/customizer.php';

// Widgets
require get_template_directory() . '/inc/widgets/widgets.php';

// layout
require get_template_directory() . '/inc/functions/layout.php';

require get_template_directory() . '/inc/functions/entry.php';

// Woocommerce
require get_template_directory() . '/inc/frontend/woocommerce.php';


// Vendor
require get_template_directory() . '/inc/frontend/dokan.php';
require get_template_directory() . '/inc/frontend/wc_vendors.php';
require get_template_directory() . '/inc/frontend/dc_vendors.php';
require get_template_directory() . '/inc/frontend/metabox.php';

if ( is_admin() ) {
	require get_template_directory() . '/inc/libs/class-tgm-plugin-activation.php';
	require get_template_directory() . '/inc/backend/plugins.php';
	require get_template_directory() . '/inc/backend/meta-boxes.php';
	require get_template_directory() . '/inc/backend/product-cat.php';
	require get_template_directory() . '/inc/backend/product-meta-box-data.php';
	require get_template_directory() . '/inc/backend/woocommerce.php';
	require get_template_directory() . '/inc/mega-menu/class-mega-menu.php';
} else {
	// Frontend functions and shortcodes
	require get_template_directory() . '/inc/functions/media.php';
	require get_template_directory() . '/inc/functions/nav.php';
	require get_template_directory() . '/inc/functions/header.php';
	require get_template_directory() . '/inc/functions/breadcrumbs.php';
	require get_template_directory() . '/inc/mega-menu/class-mega-menu-walker.php';
	require get_template_directory() . '/inc/functions/comments.php';
	require get_template_directory() . '/inc/functions/footer.php';
	//require get_template_directory() . '/inc/functions/framework.php';

	// Frontend hooks
	require get_template_directory() . '/inc/frontend/layout.php';
	require get_template_directory() . '/inc/frontend/header.php';
	require get_template_directory() . '/inc/frontend/nav.php';
	require get_template_directory() . '/inc/frontend/entry.php';
	require get_template_directory() . '/inc/frontend/footer.php';
}

