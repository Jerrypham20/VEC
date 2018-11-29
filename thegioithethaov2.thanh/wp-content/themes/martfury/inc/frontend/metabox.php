<?php
//Gallery sinlge product
add_action( '_detail_product_gallery', 'detail_product_gallery' );
function detail_product_gallery(){
	global $product;
	$attachment_ids = $product->get_gallery_attachment_ids();
	?>
		<section class="lazy slider" data-sizes="50vw">
			<?php 
				if(!empty($attachment_ids)) :
 					foreach( $attachment_ids as $attachment_id ) {
			?>
		    <div>
		      <img data-lazy="<?php echo $image_link = wp_get_attachment_url( $attachment_id ); ?>" data-srcset="<?php echo $image_link = wp_get_attachment_url( $attachment_id ); ?>" data-sizes="100vw">
		    </div>
		    <?php }; endif; ?>
		</section>
	<?php
}

// new list post
add_action( '_featured_list_post', 'featured_list_post' );
function featured_list_post(){
  $wp_query = new WP_Query( array(
      'type'			=>'post',
      'posts_per_page'  => 6,
      'orderby'         => 'date',
      'order'           => 'DESC',
		'post__not_in'  => array(get_the_ID()),
  ));
  $query = $wp_query->get_posts();
  if ( !empty($query) ) : ?>
  <div id="new-posts-3" class="widget widget_recent_entries"><h2 class="widgettitle"><?php _e('Tin tức nổi bật'); ?><span class="arow"></span></h2><ul>
  <?php
    foreach( $query as $q ) : ?>
        <li>
         	 <div class="post-thumb entry-format">
         	 	<div class="row">
         	 		<div class="col-xs-4">
         	 			<?php
			              $image_size = 'martfury-product-post-list';
							if ( has_post_thumbnail() ) {
								$post_thumbnail_id = get_post_thumbnail_id( $q->ID );

								echo '<a href="'.get_permalink($q->ID).' title="'.$q->post_title.'">'. martfury_get_image_html( $post_thumbnail_id, 'full' ).'</a>';

							} elseif ( function_exists( 'woocommerce_get_product_thumbnail' ) ) {
								echo woocommerce_get_product_thumbnail();
							}
			            ?>
         	 		</div>
         	 		<div class="col-xs-8">
         	 			<span class="post-title"><a href="<?php echo get_permalink($q->ID);?>"><?php echo $q->post_title; ?></a></span>
         	 		</div>
         	 	</div>
          	</div>
      	</li>
    <?php endforeach; ?>
    </ul></div>
    <?php
  endif;
}



// banner Featured post
/**
 * Plugin Name: Support for the _shuffle_and_pick WP_Query argument.
 */
add_filter( 'the_posts', function( $posts, \WP_Query $query )
{
    if( $pick = $query->get( '_shuffle_and_pick' ) )
    {
        shuffle( $posts );
        $posts = array_slice( $posts, 0, (int) $pick );
    }
    return $posts;
}, 10, 2 );
add_action( '_featured_banner', 'featured_banner' );
function featured_banner(){
  $wp_query = new WP_Query( array(
      'post_type'             => 'post',
      'posts_per_page'        => -1,
      'orderby'               => 'date',
      'order'                 => 'DESC',
      '_shuffle_and_pick'     => 5 // <-- our custom argument
  ));
  $query = $wp_query->get_posts();
  // echo '<pre>';
  // var_dump($query);
  // echo '</pre>';
  $css_class = array("blog-wapper");
  if ( !empty($query) ) : $i=0; ?>
    
    <div class="box_banner">   
    <?php
    foreach( $query as $q ) : $i++; ?>
      <?php 
      if ($i == 1 or $i == 2) {
        $css_class = 'width-33';
        $size = 'martfury-blog-large';
      } else {
        $css_class = 'width-100';
        $size = 'martfury-blog-medium';
      }
    ?>
      <article id="post-<?php the_ID(); ?>" class="blog-wapper <?php echo $css_class;?>">
          <header class="entry-header">
            <?php
               martfury_post_format( $blog_layout, $size );
            ?>
          </header>
          <div class="entry-content">
            <div class="entry-content-top">
              <h2 class="entry-title"><a href="<?php echo get_permalink($q->ID);?>"><?php echo $q->post_title; ?></a></h2>
              <?php if($i == 1 or $i == 2): ?>
                <div class="entry-desc">
                  <?php echo wp_trim_words( $q->post_content, 20, '') ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <!-- .entry-content -->
      </article>
    <?php endforeach; ?>
    </div><?php 
  else : get_template_part( 'content', 'none' ); endif;
}
?>