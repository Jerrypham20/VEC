<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
	$price = $product->price;
	$price_sale = $product->sale_price;
	$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 ) . '%';
// echo '<pre>';
// var_dump($product);
// echo '</pre>';
?>
<li class="product">
	<div class="product-item">
		<div class="product-thumbnail col-xs-6">
			<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo martfury_get_image_html( get_post_thumbnail_id( $id ), 'shop_thumbnail' ); ?></a>
		</div>

		<div class="product-inners col-xs-6">
			<h2>
				<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_title() ); ?></a>
			</h2>
			<span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>
			<div class="highlight-desc">
				<ul class="progress">
					<li class="progress__item <?php if($price_sale == '') {echo 'progress_freeship';} ?>">
				      	<p class="progress__title progress__title_discount <?php if($price_sale == '') {echo 'progress_freeship';} ?> "><?php if($price_sale != '') {echo 'sale ' .$percentage;}else{echo 'free ship'; } ?></p>
				    </li>			    
				    	<?php 
				    	if( have_rows('description_highlights') ):
				    		while ( have_rows('description_highlights') ) : the_row();
				    			$content = get_sub_field('content');
				    			echo '<li class="progress__item"><p class="progress__title">'.$content.'</p></li>';
				    		endwhile;
						endif;				    			
				    ?>	
				 </ul>
			</div>
		</div>
	</div>
</li>
