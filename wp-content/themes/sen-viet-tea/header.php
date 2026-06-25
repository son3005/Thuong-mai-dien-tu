<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <!-- Site Branding / Logo -->
        <div class="site-branding">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <?php if ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo( 'name' ); ?>">
                <?php else : ?>
                    <span class="site-title"><?php bloginfo( 'name' ); ?></span>
                <?php endif; ?>
            </a>
        </div>

        <!-- Main Navigation -->
        <?php if ( ! ( function_exists( 'is_checkout' ) && is_checkout() && empty( is_wc_endpoint_url( 'order-received' ) ) ) ) : ?>
        <nav class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>

        <!-- Header Actions (Cart) -->
        <div class="header-actions">
            <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'Giỏ hàng', 'sen-viet-tea' ); ?>">
                    🛒 <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</header>

<div id="content" class="site-content">
