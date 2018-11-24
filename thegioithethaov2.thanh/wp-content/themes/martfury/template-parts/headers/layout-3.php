<?php

$show_department = true;
$extras          = martfury_menu_extras();
if ( empty( $extras ) || ! in_array( 'department', $extras ) ) {
	$show_department = false;
	$css_header_menu = 'col-md-12 col-sm-12';
}
?>
<div class="header-main-wapper">
    <div class="header-main">
        <div class="<?php echo martfury_header_container_classes(); ?>">
            <div class="header-row">
                <div class="header-logo">
                    <div class="d-logo">
						<?php get_template_part( 'template-parts/logo' ); ?>
                    </div>
					<!-- <?php if ( intval( martfury_get_option( 'sticky_header' ) ) ) : ?>
                        <div class="d-department hidden-md hidden-xs hidden-sm">
							<?php martfury_extra_department( true, 'sticky' ); ?>
                        </div>
					<?php endif; ?> -->
                </div>
                <div class="header-extras">
                    <ul class="extras-menu">
                        <div class="main-menu hidden-md hidden-xs hidden-sm">
                            <div class="<?php echo martfury_header_container_classes(); ?>">
                                <div class="row header-row">
                                    <div class="<?php echo esc_attr( $css_header_menu ); ?> col-nav-menu mr-header-menu">
                                        <?php if ( martfury_get_option( 'header_layout' ) == '3' ): ?>
                                            <div class="recently-viewed">
                                                <?php martfury_header_recently_products(); ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-header-menu">
                                                <?php martfury_header_menu(); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="account">
                                            <?php
                                                martfury_extra_cart();
                                                martfury_extra_account();
                                            ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="mobile-menu hidden-lg">
                            <div class="container">
                                <div class="mobile-menu-row">
                                    <a class="mf-toggle-menu" id="mf-toggle-menu" href="#">
                                        <i class="icon-menu"></i>
                                    </a>
                                    <?php martfury_extra_search( false ); ?>
                                </div>
                            </div>
                        </div>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header-bottom">
    <div class="header-main-bottom">
        <div class="<?php echo martfury_header_container_classes(); ?>">
            <div class="row header-row">
                <div class="header-logo">
                    <div class="social">
                        <ul class="extras-menu">
                            <li class="extra-menu-item menu-item-cart mini-cart woocommerce">
                                <a  href="facebook">
                                   <img src="<?php echo get_template_directory_uri()?>/images/icons/facebook.png" alt="facebook">
                                </a>
                            </li>
                            <li class="extra-menu-item menu-item-cart mini-cart woocommerce">
                                <a  href="facebook">
                                   <img src="<?php echo get_template_directory_uri()?>/images/icons/youtube.png" alt="facebook">
                                </a>
                            </li>
                            <li class="extra-menu-item menu-item-cart mini-cart woocommerce">
                                <a  href="facebook">
                                   <img src="<?php echo get_template_directory_uri()?>/images/icons/instagram.png" alt="facebook">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-extras">
                    <?php martfury_extra_search( ); ?>
                    <div class="top-phone">
                        <img src="<?php echo get_template_directory_uri()?>/images/icons/phone_top.png" alt="Hotline">
                        <label>Hotline: </label>
                        <span>0979 068 742</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

