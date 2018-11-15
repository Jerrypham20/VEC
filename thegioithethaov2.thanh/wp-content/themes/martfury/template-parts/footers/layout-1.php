<?php
$footer_class = 'footer-' . martfury_get_option('footer_skin');
?>
<nav class="footer-layout footer-layout-1 <?php echo esc_attr($footer_class); ?>">
	<div class="<?php echo martfury_footer_container_classes(); ?>">
		<div class="footer-content">
			<?php
			martfury_footer_widgets();
			?>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="<?php echo martfury_footer_container_classes(); ?>">
			<div class="row footer-row">
				<div class=" col-xs-12">
					<?php martfury_footer_copyright(); ?>
				</div>
			</div>
		</div>
	</div>
</nav>