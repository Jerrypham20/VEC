<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( __( 'Thông tin chi tiết sản phẩm', 'woocommerce' ) );

?>
<div class="col-md-8 col-lg-9">
	<div class="detail-left">
		<?php if ( $heading ) : ?>
		  <h2 class="title-detail"><?php echo $heading; ?></h2>
		<?php endif; ?>
		<?php do_action('_detail_product_gallery'); ?>
		<div class="content-product">
			<?php the_content(); ?>
			<a href="#" class="view-more">Xem thêm</a>
		</div>
	</div>
</div>
