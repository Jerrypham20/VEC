<?php
if ( ! intval( martfury_get_option( 'show_post_format' ) ) ) {
	return;
}
?>

<div class="single-post-header text-center layout-3">
	<div class="container">
		<div class="page-content">
			<?php martfury_entry_thumbnail(); ?>
		</div>
		<div class="page-breadcrumbs">
		    <div class="<?php echo esc_attr( $container_class ); ?> catalog-cat">
				<?php martfury_get_breadcrumbs(); ?>
		    </div>
		</div>
	</div>
</div>
