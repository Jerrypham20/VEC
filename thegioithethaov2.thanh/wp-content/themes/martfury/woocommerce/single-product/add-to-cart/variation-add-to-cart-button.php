<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<div class="cart-content">
		<p>Vận chuyển: Địa điểm giao hàng tại Hà Nội</p>
		<p><img src="<?php echo get_template_directory_uri() ?>/images/icons/freeship.jpg">Freeship với đơn hàng trên <span>1 triệu</span></p>
	</div>
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	woocommerce_quantity_input( array(
		'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
		'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
		'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
	) );

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>
	<div class="list-button-addcart">
		<button type="submit" class="single_add_to_cart_button button alt"><i class="fa fa-shopping-cart" aria-hidden="true"></i><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
		<a href="?quick_buy=1&add-to-cart=<?php echo $product->get_id()?>" class="qn_btn single_add_to_cart_button button alt"><?php echo esc_html( 'Mua ngay' ); ?></a>
	</div>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
