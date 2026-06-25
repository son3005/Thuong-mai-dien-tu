<?php
/**
 * The sidebar containing the WooCommerce widgets
 *
 * @package Sen_Viet_Tea
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Ẩn hoàn toàn sidebar trên trang chi tiết sản phẩm để hiển thị full-width
if ( is_singular( 'product' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area shop-sidebar-column">
    <?php
    if ( is_active_sidebar( 'shop-sidebar' ) ) {
        dynamic_sidebar( 'shop-sidebar' );
    } else {
        // Fallback: Hiển thị các Widget mặc định được thiết kế đẹp mắt nếu người dùng chưa cấu hình trong Admin
        
        // 1. Widget Tìm Kiếm Sản Phẩm
        if ( class_exists( 'WC_Widget_Product_Search' ) ) {
            the_widget( 'WC_Widget_Product_Search', array(
                'title' => __( 'Tìm kiếm trà', 'sen-viet-tea' )
            ), array(
                'before_widget' => '<section class="widget widget_product_search">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
        }

        // 2. Widget Danh Mục Sản Phẩm
        if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
            the_widget( 'WC_Widget_Product_Categories', array(
                'title'        => __( 'Danh mục sản phẩm', 'sen-viet-tea' ),
                'count'        => 1,
                'hierarchical' => 1,
                'dropdown'     => 0
            ), array(
                'before_widget' => '<section class="widget widget_product_categories">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
        }

        // 3. Widget Lọc Theo Giá
        if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
            the_widget( 'WC_Widget_Price_Filter', array(
                'title' => __( 'Lọc theo giá', 'sen-viet-tea' )
            ), array(
                'before_widget' => '<section class="widget widget_price_filter">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
        }
    }
    ?>
</aside><!-- #secondary -->

</div><!-- .shop-layout-grid -->
</main><!-- .shop-archive-container -->
