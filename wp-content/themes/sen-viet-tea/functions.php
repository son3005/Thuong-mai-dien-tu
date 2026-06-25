<?php
/**
 * Sen Viet Tea functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Setup theme supports
 */
function sen_viet_tea_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Register Navigation Menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'sen-viet-tea' ),
        'footer'  => esc_html__( 'Footer Menu', 'sen-viet-tea' ),
    ) );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // WooCommerce Support
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 600,
        'single_image_width'    => 800,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ) );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'sen_viet_tea_setup' );

/**
 * Enqueue scripts and styles.
 */
function sen_viet_tea_scripts() {
    // Google Fonts (Playfair Display & Inter)
    wp_enqueue_style( 'sen-viet-tea-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap', array(), null );

    // Main Stylesheet
    wp_enqueue_style( 'sen-viet-tea-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'sen_viet_tea_scripts' );

/**
 * WooCommerce Customizations (Minimalist / Distraction-free)
 */
// Remove WooCommerce Breadcrumbs if custom one is needed
// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// Change "Add to cart" text
add_filter( 'woocommerce_product_single_add_to_cart_text', 'sen_viet_tea_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'sen_viet_tea_custom_cart_button_text' );
function sen_viet_tea_custom_cart_button_text() {
    return __( 'Thêm vào giỏ', 'sen-viet-tea' );
}

/**
 * Thêm Hướng dẫn pha trà vào trang Chi tiết sản phẩm
 */
add_action( 'woocommerce_single_product_summary', 'sen_viet_tea_brewing_instructions', 25 );
function sen_viet_tea_brewing_instructions() {
    echo '<div class="tea-brewing-guide" style="background: var(--color-bg); padding: 15px; border-radius: var(--border-radius); border: 1px solid var(--color-border); margin: 20px 0;">';
    echo '<h4 style="margin-top: 0; color: var(--color-secondary);"><span style="margin-right:8px;">🍵</span>Hướng dẫn pha chuẩn</h4>';
    echo '<ul style="list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 0.9em;">';
    echo '<li>🌡️ Nhiệt độ: <b>80°C - 90°C</b></li>';
    echo '<li>⏳ Thời gian: <b>30 - 45 giây</b></li>';
    echo '<li>⚖️ Lượng trà: <b>5g / 150ml</b></li>';
    echo '<li>🔁 Số lần hãm: <b>4 - 5 lần</b></li>';
    echo '</ul>';
    echo '</div>';
}

/**
 * Thêm Trust Badges dưới nút Thêm vào giỏ
 */
add_action( 'woocommerce_after_add_to_cart_form', 'sen_viet_tea_trust_badges', 15 );
function sen_viet_tea_trust_badges() {
    echo '<div class="trust-badges">';
    echo '<div class="trust-badge-item">✅ 100% Trà Tự Nhiên</div>';
    echo '<div class="trust-badge-item">🚚 Giao Hàng Toàn Quốc</div>';
    echo '<div class="trust-badge-item">🛡️ Đổi Trả 7 Ngày</div>';
    echo '<div class="trust-badge-item">🎁 Hỗ Trợ Đóng Quà</div>';
    echo '</div>';
}

/**
 * Thêm Tab Bảo quản & Lợi ích
 */
add_filter( 'woocommerce_product_tabs', 'sen_viet_tea_custom_tab' );
function sen_viet_tea_custom_tab( $tabs ) {
    $tabs['storage_tab'] = array(
        'title'     => __( 'Bảo quản & Lợi ích', 'sen-viet-tea' ),
        'priority'  => 50,
        'callback'  => 'sen_viet_tea_storage_tab_content'
    );
    return $tabs;
}
function sen_viet_tea_storage_tab_content() {
    echo '<h3 style="color: var(--color-primary);">Hướng dẫn bảo quản</h3>';
    echo '<p>Bảo quản trà ở nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp. Luôn đậy kín nắp/miệng túi sau khi sử dụng để giữ hương vị tốt nhất. Tuyệt đối không để chung với các loại thực phẩm có mùi mạnh như gia vị, cá khô.</p>';
    echo '<h3 style="color: var(--color-primary); margin-top: 20px;">Lợi ích sức khỏe</h3>';
    echo '<ul>';
    echo '<li>Thanh lọc cơ thể, hỗ trợ tiêu hóa.</li>';
    echo '<li>Giàu chất chống oxy hóa, giúp duy trì làn da tươi trẻ.</li>';
    echo '<li>Giảm căng thẳng, mang lại tinh thần sảng khoái, an nhiên và tỉnh táo.</li>';
    echo '</ul>';
}

/**
 * Đăng ký Shop Sidebar cho trang Danh mục / Cửa hàng
 */
function sen_viet_tea_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Shop Sidebar', 'sen-viet-tea' ),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__( 'Thêm widget vào đây để hiển thị trên sidebar trang cửa hàng.', 'sen-viet-tea' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'sen_viet_tea_widgets_init' );

/**
 * Tùy chỉnh Wrapper WooCommerce để hỗ trợ layout Grid 2 cột
 * Được bao bọc trong action after_setup_theme để đảm bảo chạy sau khi WooCommerce đã đăng ký hook mặc định.
 */
function sen_viet_tea_woocommerce_wrappers_setup() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
    
    add_action( 'woocommerce_before_main_content', 'sen_viet_tea_theme_wrapper_start', 10 );
    add_action( 'woocommerce_after_main_content', 'sen_viet_tea_theme_wrapper_end', 10 );
}
add_action( 'after_setup_theme', 'sen_viet_tea_woocommerce_wrappers_setup', 15 );

function sen_viet_tea_theme_wrapper_start() {
    if ( is_singular( 'product' ) ) {
        // Layout full-width cho trang chi tiết sản phẩm
        echo '<main id="primary" class="site-main container product-single-container" style="padding: var(--spacing-lg) 24px;">';
    } else {
        // Layout 2 cột (Sidebar + Sản phẩm) cho trang Danh mục / Cửa hàng
        echo '<main id="primary" class="site-main container shop-archive-container" style="padding: var(--spacing-lg) 24px;">';
        echo '<div class="shop-layout-grid">';
        echo '<div class="shop-products-column">';
    }
}

function sen_viet_tea_theme_wrapper_end() {
    if ( is_singular( 'product' ) ) {
        echo '</main>';
    } else {
        echo '</div><!-- .shop-products-column -->';
    }
}

