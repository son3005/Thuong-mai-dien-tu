<?php
/**
 * Sen Viet Tea functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * ===================================================
 * DỊCH WOOCOMMERCE SANG TIẾNG VIỆT (gettext filter)
 * ===================================================
 */
add_filter( 'gettext', 'sen_viet_tea_translate_wc_strings', 20, 3 );
function sen_viet_tea_translate_wc_strings( $translated, $text, $domain ) {
    if ( 'woocommerce' !== $domain ) {
        return $translated;
    }

    $strings = array(
        // --- Giỏ hàng (Cart) ---
        'Cart'                          => 'Giỏ hàng',
        'Product'                       => 'Sản phẩm',
        'Price'                         => 'Đơn giá',
        'Quantity'                      => 'Số lượng',
        'Subtotal'                      => 'Tạm tính',
        'Total'                         => 'Tổng cộng',
        'Cart totals'                   => 'Tổng giỏ hàng',
        'CART TOTALS'                   => 'TỔNG GIỎ HÀNG',
        'Proceed to checkout'           => 'Tiến hành thanh toán',
        'Proceed to Checkout'           => 'Tiến hành thanh toán',
        'Update cart'                   => 'Cập nhật giỏ hàng',
        'Coupon code'                   => 'Mã giảm giá',
        'Apply coupon'                  => 'Áp dụng',
        'Coupon:'                       => 'Mã giảm giá:',
        'Remove item'                   => 'Xóa sản phẩm',
        'Thumbnail image'               => 'Hình thu nhỏ',
        'Add coupon'                    => 'Thêm mã giảm giá',
        'Add coupons'                   => 'Thêm mã giảm giá',
        'Estimated total'               => 'Tổng ước tính',
        'Estimated for'                 => 'Ước tính cho',
        'Shipping'                      => 'Vận chuyển',
        'Calculate shipping'            => 'Tính phí vận chuyển',
        'Apply'                         => 'Áp dụng',
        'No shipping options were found.' => 'Không tìm thấy tùy chọn vận chuyển.',
        'Enter your address to view shipping options.' => 'Nhập địa chỉ để xem tùy chọn vận chuyển.',
        'Free!'                         => 'Miễn phí!',
        'Free shipping'                 => 'Miễn phí vận chuyển',

        // --- Checkout ---
        'Checkout'                      => 'Thanh toán',
        'Billing details'               => 'Thông tin thanh toán',
        'Order notes'                   => 'Ghi chú đơn hàng',
        'Notes about your order, e.g. special notes for delivery.' => 'Ghi chú về đơn hàng, ví dụ: ghi chú đặc biệt cho việc giao hàng.',
        'Place order'                   => 'Đặt hàng',
        'Your order'                    => 'Đơn hàng của bạn',
        'Order summary'                 => 'Tóm tắt đơn hàng',
        'First name'                    => 'Tên',
        'Last name'                     => 'Họ',
        'Company name (optional)'       => 'Tên công ty (tùy chọn)',
        'Country / Region'              => 'Quốc gia / Khu vực',
        'Street address'                => 'Địa chỉ',
        'Apartment, suite, unit, etc. (optional)' => 'Căn hộ, tòa nhà, v.v. (tùy chọn)',
        'Town / City'                   => 'Thành phố',
        'State / County'                => 'Tỉnh / Thành phố',
        'Postcode / ZIP'                => 'Mã bưu chính',
        'Phone'                         => 'Số điện thoại',
        'Email address'                 => 'Địa chỉ email',
        'Have a coupon?'                => 'Có mã giảm giá?',
        'Click here to enter your code' => 'Nhấp vào đây để nhập mã',
        'I have read and agree to the website'  => 'Tôi đã đọc và đồng ý với',
        'terms and conditions'          => 'điều khoản và điều kiện',

        // --- Sản phẩm (Product) ---
        'Add to cart'                   => 'Thêm vào giỏ',
        'Out of stock'                  => 'Hết hàng',
        'In stock'                      => 'Còn hàng',
        'Sale!'                         => 'Khuyến mãi!',
        'Reviews'                       => 'Đánh giá',
        'Description'                   => 'Mô tả',
        'Additional information'        => 'Thông tin thêm',
        'Related products'              => 'Sản phẩm liên quan',
        'You may also like&hellip;'     => 'Bạn có thể thích&hellip;',
        'SKU:'                          => 'SKU:',
        'Category:'                     => 'Danh mục:',
        'Categories:'                   => 'Danh mục:',
        'Tag:'                          => 'Thẻ:',
        'Tags:'                         => 'Thẻ:',
        'Per page'                      => 'Mỗi trang',
        'Sort by latest'                => 'Mới nhất',
        'Sort by price: low to high'    => 'Giá tăng dần',
        'Sort by price: high to low'    => 'Giá giảm dần',
        'Sort by popularity'            => 'Phổ biến nhất',
        'Sort by average rating'        => 'Đánh giá cao nhất',
        'Default sorting'               => 'Sắp xếp mặc định',
        'Showing all %d results'        => 'Hiển thị tất cả %d sản phẩm',
        'No products were found matching your selection.' => 'Không tìm thấy sản phẩm phù hợp.',

        // --- Tài khoản ---
        'My account'                    => 'Tài khoản của tôi',
        'Login'                         => 'Đăng nhập',
        'Logout'                        => 'Đăng xuất',
        'Register'                      => 'Đăng ký',
        'Username or email address'     => 'Tên đăng nhập hoặc email',
        'Password'                      => 'Mật khẩu',
        'Remember me'                   => 'Ghi nhớ đăng nhập',
        'Lost your password?'           => 'Quên mật khẩu?',
        'Orders'                        => 'Đơn hàng',
        'Account details'               => 'Thông tin tài khoản',
        'Addresses'                     => 'Địa chỉ',
        'Dashboard'                     => 'Tổng quan',

        // --- Checkout chi tiết ---
        'You must be logged in to checkout.' => 'Bạn phải đăng nhập để thanh toán.',
        'Your order'                    => 'Đơn hàng của bạn',
        'Product'                       => 'Sản phẩm',
        'Subtotal'                      => 'Tạm tính',
        'Shipping'                      => 'Vận chuyển',
        'Total'                         => 'Tổng cộng',
        'Payment'                       => 'Thanh toán',
        'Payment method'                => 'Phương thức thanh toán',
        'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.' => 'Không có phương thức thanh toán nào khả dụng. Vui lòng liên hệ chúng tôi.',
        'Please fill in your details above to see available payment methods.' => 'Vui lòng điền thông tin để xem phương thức thanh toán.',
        'Place order'                   => 'Đặt hàng',
        'Place Order'                   => 'Đặt hàng',
        'I have read and agree to the website %s'  => 'Tôi đã đọc và đồng ý với %s của website',
        'terms and conditions'          => 'điều khoản và điều kiện',
        'Have a coupon?'                => 'Có mã giảm giá?',
        'Click here to enter your code' => 'Nhấp vào đây để nhập mã',
        'Apply coupon'                  => 'Áp dụng mã',
        'Coupon code'                   => 'Mã giảm giá',
        'Return to cart'                => 'Quay lại giỏ hàng',
        'Order #%s'                     => 'Đơn hàng #%s',
        'Thank you. Your order has been received.' => 'Cảm ơn bạn! Đơn hàng đã được tiếp nhận.',
        'Order number:'                 => 'Mã đơn hàng:',
        'Date:'                         => 'Ngày đặt:',
        'Email:'                        => 'Email:',
        'Total:'                        => 'Tổng cộng:',
        'Payment method:'               => 'Phương thức thanh toán:',
        'Order details'                 => 'Chi tiết đơn hàng',
        'Billing address'               => 'Địa chỉ thanh toán',
        'Shipping address'              => 'Địa chỉ giao hàng',
        'Ship to a different address?'  => 'Giao đến địa chỉ khác?',
        'Order notes'                   => 'Ghi chú đơn hàng',
        'Notes about your order, e.g. special notes for delivery.' => 'Ghi chú về đơn hàng, ví dụ: ghi chú đặc biệt cho việc giao hàng.',
        'Company name (optional)'       => 'Tên công ty (tùy chọn)',
        'Apartment, suite, unit, etc. (optional)' => 'Số căn hộ, tòa nhà (tùy chọn)',
        'Town / City'                   => 'Thành phố',
        'State / County'                => 'Tỉnh / Thành',
        'Postcode / ZIP'                => 'Mã bưu chính',
        'Country / Region'              => 'Quốc gia / Khu vực',
        'Phone'                         => 'Số điện thoại',
        'Email address'                 => 'Địa chỉ email',
        'First name'                    => 'Tên',
        'Last name'                     => 'Họ',
        'Street address'                => 'Địa chỉ',
        'Woo'                           => 'Woo',
    );

    return isset( $strings[ $text ] ) ? $strings[ $text ] : $translated;
}

/**
 * ===================================================
 * FIX LỖI MOJIBAKE (Double-encoded UTF-8)
 * Áp dụng toàn cục cho mọi nội dung the_content
 * ===================================================
 */
add_filter( 'the_content', 'sen_viet_tea_fix_mojibake', 1 );
add_filter( 'woocommerce_short_description', 'sen_viet_tea_fix_mojibake', 1 );
add_filter( 'get_the_excerpt', 'sen_viet_tea_fix_mojibake', 1 );

function sen_viet_tea_fix_mojibake( $content ) {
    if ( empty( $content ) ) {
        return $content;
    }
    // Phát hiện Mojibake: UTF-8 bị encode thêm 1 lần như Latin-1
    // Ví dụ: "Việt" → "Viá»‡t" hoặc "Viêt" → ký tự Ã + ký tự Latin
    if ( preg_match( '/Ã[€-ÿ]|Â[€-ÿ]|á»|Ä\x83|Æ°/', $content ) ) {
        $content = mb_convert_encoding( $content, 'ISO-8859-1', 'UTF-8' );
    }
    return $content;
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
 * Đổi tiêu đề trang Cart/Checkout sang tiếng Việt
 */
add_filter( 'woocommerce_page_title', 'sen_viet_tea_page_titles' );
add_filter( 'the_title', 'sen_viet_tea_page_titles', 10, 2 );
function sen_viet_tea_page_titles( $title, $post_id = null ) {
    $map = array(
        'Cart'     => 'Giỏ hàng',
        'Checkout' => 'Thanh toán',
        'My account' => 'Tài khoản',
    );
    return isset( $map[ $title ] ) ? $map[ $title ] : $title;
}

/**
 * Dịch WooCommerce Block Cart/Checkout strings sang tiếng Việt
 * (Block-based cart dùng JS nên cần override bằng JavaScript)
 * Chạy trên mọi trang để đảm bảo bắt được mọi block.
 */
add_action( 'wp_footer', 'sen_viet_tea_block_cart_translations' );
function sen_viet_tea_block_cart_translations() {
    ?>
    <script>
    (function() {
        'use strict';

        var translations = {
            'Cart':                    'Giỏ hàng',
            'PRODUCT':                 'SẢN PHẨM',
            'Product':                 'Sản phẩm',
            'TOTAL':                   'TỔNG',
            'Total':                   'Tổng cộng',
            'CART TOTALS':             'TỔNG GIỎ HÀNG',
            'Cart totals':             'Tổng giỏ hàng',
            'Add coupons':             'Thêm mã giảm giá',
            'Add a coupon':            'Thêm mã giảm giá',
            'Enter code':              'Nhập mã giảm giá',
            'Apply':                   'Áp dụng',
            'Estimated total':         'Tổng ước tính',
            'Proceed to Checkout':     'Tiến hành thanh toán',
            'Proceed to checkout':     'Tiến hành thanh toán',
            'Remove item':             'Xóa',
            'Quantity:':               'Số lượng:',
            'Subtotal':                'Tạm tính',
            'Shipping':                'Vận chuyển',
            'Free!':                   'Miễn phí!',
            'Coupon code':             'Mã giảm giá',
            'Update':                  'Cập nhật',
            'Update cart':             'Cập nhật giỏ hàng',
            'Checkout':                'Thanh toán',
            'Order summary':           'Tóm tắt đơn hàng',
            'Place Order':             'Đặt hàng',
            'Place order':             'Đặt hàng',
            'Billing address':         'Địa chỉ thanh toán',
            'Billing details':         'Thông tin thanh toán',
            'Contact information':     'Thông tin liên hệ',
            'Email address':           'Địa chỉ email',
            'First name':              'Tên',
            'Last name':               'Họ',
            'Phone':                   'Điện thoại',
            'Your order':              'Đơn hàng của bạn',

            // --- Block Checkout fields (từ screenshot) ---
            'Country/Region':          'Quốc gia/Khu vực',
            'Address':                 'Địa chỉ',
            'Street address':          'Địa chỉ đường',
            '+ Add apartment, suite, etc.': '+ Thêm căn hộ, tòa nhà,...',
            'Add apartment, suite, etc.':   'Thêm căn hộ, tòa nhà,...',
            'Postal code (optional)':  'Mã bưu chính (tùy chọn)',
            'Postal code':             'Mã bưu chính',
            'City':                    'Thành phố',
            'Phone (optional)':        'Điện thoại (tùy chọn)',
            'Payment options':         'Phương thức thanh toán',
            'Payment methods':         'Phương thức thanh toán',
            'There are no payment methods available. Please contact us for help placing your order.':
                                       'Hiện không có phương thức thanh toán. Vui lòng liên hệ chúng tôi.',
            'Add a note to your order':'Thêm ghi chú cho đơn hàng',
            'Note about your order (optional)': 'Ghi chú đơn hàng (tùy chọn)',
            'Ship to a different address?': 'Giao đến địa chỉ khác?',
            'Shipping address':        'Địa chỉ giao hàng',
            'Return to Cart':          'Quay lại giỏ hàng',
            'Return to cart':          'Quay lại giỏ hàng',
            'Order notes':             'Ghi chú đơn hàng',
            'Use same address for billing': 'Dùng địa chỉ này để thanh toán',
            'State/County':            'Tỉnh/Thành phố',
            'Continue to payment':     'Tiếp tục thanh toán',
            'Continue to shipping':    'Tiếp tục vận chuyển',
            'Express checkout':        'Thanh toán nhanh',
        };


        function translateTextNode(node) {
            var text = node.textContent;
            if (!text || !text.trim()) return;
            var trimmed = text.trim();
            if (translations[trimmed]) {
                node.textContent = text.replace(trimmed, translations[trimmed]);
            }
        }

        function translateInputs() {
            document.querySelectorAll('input[placeholder]').forEach(function(el) {
                var ph = el.placeholder.trim();
                if (translations[ph]) el.placeholder = translations[ph];
            });
            document.querySelectorAll('button').forEach(function(el) {
                var txt = el.textContent.trim();
                if (translations[txt]) el.textContent = translations[txt];
            });
            document.querySelectorAll('input[type="submit"], input[type="button"]').forEach(function(el) {
                if (translations[el.value.trim()]) el.value = translations[el.value.trim()];
            });
        }

        function translateAll() {
            var walker = document.createTreeWalker(
                document.body,
                NodeFilter.SHOW_TEXT,
                {
                    acceptNode: function(node) {
                        var parent = node.parentElement;
                        if (!parent) return NodeFilter.FILTER_REJECT;
                        var tag = parent.tagName;
                        if (tag === 'SCRIPT' || tag === 'STYLE' || tag === 'NOSCRIPT') return NodeFilter.FILTER_REJECT;
                        return NodeFilter.FILTER_ACCEPT;
                    }
                },
                false
            );
            var node;
            while ((node = walker.nextNode())) {
                translateTextNode(node);
            }
            translateInputs();
        }

        // Chạy ngay lập tức
        translateAll();

        // Chạy lại sau khi DOM loaded
        document.addEventListener('DOMContentLoaded', translateAll);

        // Chạy lại sau 500ms, 1s, 2s để bắt React blocks
        setTimeout(translateAll, 500);
        setTimeout(translateAll, 1000);
        setTimeout(translateAll, 2000);

        // Theo dõi DOM changes (React re-renders)
        var observer = new MutationObserver(function(mutations) {
            var changed = false;
            mutations.forEach(function(m) {
                if (m.addedNodes.length > 0) changed = true;
                if (m.type === 'characterData') changed = true;
            });
            if (changed) translateAll();
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true,
            characterData: false,
        });
    })();
    </script>
    <?php
}


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
    echo '<h4 style="margin-top: 0; color: var(--color-secondary);">Hướng dẫn pha chuẩn</h4>';
    echo '<ul style="list-style: none; padding: 0; margin: 0; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 0.9em;">';
    echo '<li>Nhiệt độ: <b>80°C - 90°C</b></li>';
    echo '<li>Thời gian: <b>30 - 45 giây</b></li>';
    echo '<li>Lượng trà: <b>5g / 150ml</b></li>';
    echo '<li>Số lần hãm: <b>4 - 5 lần</b></li>';
    echo '</ul>';
    echo '</div>';
}

/**
 * Thêm Trust Badges dưới nút Thêm vào giỏ
 */
add_action( 'woocommerce_after_add_to_cart_form', 'sen_viet_tea_trust_badges', 15 );
function sen_viet_tea_trust_badges() {
    echo '<div class="trust-badges">';
    echo '<div class="trust-badge-item">100% Trà Tự Nhiên</div>';
    echo '<div class="trust-badge-item">Giao Hàng Toàn Quốc</div>';
    echo '<div class="trust-badge-item">Đổi Trả 7 Ngày</div>';
    echo '<div class="trust-badge-item">Hỗ Trợ Đóng Quà</div>';
    echo '</div>';
}

/**
 * Đổi tên Tab WooCommerce sang tiếng Việt
 */
add_filter( 'woocommerce_product_tabs', 'sen_viet_tea_rename_tabs', 98 );
function sen_viet_tea_rename_tabs( $tabs ) {
    // Đổi tab "Description" → "Mô tả"
    if ( isset( $tabs['description'] ) ) {
        $tabs['description']['title'] = __( 'Mô tả', 'sen-viet-tea' );
    }
    // Đổi tab "Additional information" → "Thông tin thêm"
    if ( isset( $tabs['additional_information'] ) ) {
        $tabs['additional_information']['title'] = __( 'Thông tin thêm', 'sen-viet-tea' );
    }
    // Đổi tab "Reviews" → "Đánh giá"
    if ( isset( $tabs['reviews'] ) ) {
        $count = $tabs['reviews']['title'];
        // Thay thế chữ Reviews bằng Đánh giá, giữ nguyên số lượng
        global $product;
        $review_count = is_a( $product, 'WC_Product' ) ? $product->get_review_count() : 0;
        $tabs['reviews']['title'] = sprintf( __( 'Đánh giá (%d)', 'sen-viet-tea' ), $review_count );
    }
    return $tabs;
}

/**
 * Đổi "Related products" → "Sản phẩm liên quan"
 */
add_filter( 'woocommerce_product_related_products_heading', function() {
    return __( 'Sản phẩm liên quan', 'sen-viet-tea' );
} );

/**
 * Đổi tiêu đề "Description" bên trong tab nội dung → "Mô tả sản phẩm"
 */
add_filter( 'woocommerce_product_description_heading', function() {
    return __( 'Mô tả sản phẩm', 'sen-viet-tea' );
} );

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

/**
 * Xóa Sidebar mặc định của WooCommerce
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Xóa Tiêu đề Shop và Breadcrumbs
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );
add_action( 'init', 'sen_viet_tea_remove_shop_title_breadcrumbs' );
function sen_viet_tea_remove_shop_title_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

/**
 * Giao diện 2 cột mới (Sidebar bên trái)
 */
add_action('after_setup_theme', function() {
    remove_action( 'woocommerce_before_main_content', 'sen_viet_tea_theme_wrapper_start', 10 );
    remove_action( 'woocommerce_after_main_content', 'sen_viet_tea_theme_wrapper_end', 10 );
    
    add_action( 'woocommerce_before_main_content', 'sen_viet_tea_theme_wrapper_start_v2', 10 );
    add_action( 'woocommerce_after_main_content', 'sen_viet_tea_theme_wrapper_end_v2', 10 );
}, 20);

function sen_viet_tea_theme_wrapper_start_v2() {
    if ( is_singular( 'product' ) ) {
        echo '<main id="primary" class="site-main container product-single-container" style="padding: var(--spacing-lg) 24px;">';
    } else {
        echo '<main id="primary" class="site-main container shop-archive-container" style="padding: var(--spacing-lg) 24px;">';
        echo '<div class="shop-layout-grid shop-grid-v2">';
        
        // Output Sidebar
        echo '<aside class="shop-sidebar-column" style="background: var(--color-white); padding: 32px 24px; border-radius: var(--radius-lg); border: 1px solid var(--color-border-light); box-shadow: var(--shadow-sm); height: fit-content;">';
        
        // 1. Search Box
        echo '<div class="widget widget_search" style="margin-bottom: 40px;">';
        echo '<h3 class="widget-title" style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 600; color: var(--color-primary); margin-bottom: 20px; border-bottom: 2px solid var(--color-border-light); padding-bottom: 12px;">Tìm kiếm</h3>';
        echo '<div class="sidebar-search-wrapper">';
        get_product_search_form();
        echo '</div>';
        echo '</div>';
        
        // 2. Custom Sorting List
        $current_orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : 'menu_order';
        $sort_options = array(
            'menu_order' => 'Sắp xếp mặc định',
            'popularity' => 'Phổ biến nhất',
            'rating'     => 'Đánh giá cao',
            'date'       => 'Mới nhất',
            'price'      => 'Giá từ thấp đến cao',
            'price-desc' => 'Giá từ cao xuống thấp',
        );
        
        echo '<div class="widget widget_sorting" style="margin-bottom: 40px;">';
        echo '<h3 class="widget-title" style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 600; color: var(--color-primary); margin-bottom: 20px; border-bottom: 2px solid var(--color-border-light); padding-bottom: 12px;">Sắp xếp theo</h3>';
        echo '<ul style="list-style: none; padding: 0; margin: 0;">';
        foreach ( $sort_options as $id => $name ) {
            $is_active = ( $current_orderby === $id ) ? 'font-weight: 700; color: var(--color-primary); background: var(--color-primary-light); border-radius: var(--radius-md); padding: 8px 12px;' : 'color: var(--color-text); padding: 8px 12px;';
            $url = add_query_arg( 'orderby', $id );
            echo '<li style="margin-bottom: 4px;"><a href="' . esc_url( $url ) . '" style="display: block; font-size: 0.95rem; text-decoration: none; transition: all 0.2s; ' . $is_active . '">' . esc_html( $name ) . '</a></li>';
        }
        echo '</ul>';
        echo '</div>';

        // 3. Category Filter
        echo '<div class="widget widget_product_categories" style="margin-bottom: 0;">';
        echo '<h3 class="widget-title" style="font-family: var(--font-heading); font-size: 1.25rem; font-weight: 600; color: var(--color-primary); margin-bottom: 20px; border-bottom: 2px solid var(--color-border-light); padding-bottom: 12px;">Danh mục trà</h3>';
        echo '<ul class="custom-cat-list" style="list-style: none; padding: 0; margin: 0; font-size: 0.95rem;">';
        $uncat = get_term_by('slug', 'uncategorized', 'product_cat');
        $exclude = $uncat ? $uncat->term_id : '';
        
        wp_list_categories( array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => 0,
            'title_li'   => '',
            'exclude'    => $exclude,
        ) );
        echo '</ul>';
        echo '</div>';
        
        echo '</aside>';

        echo '<div class="shop-products-column">';
    }
}

function sen_viet_tea_theme_wrapper_end_v2() {
    if ( is_singular( 'product' ) ) {
        echo '</main>';
    } else {
        echo '</div><!-- .shop-products-column --></div></main>';
    }
}

// Remove the old top sorting dropdown and the old top search bar
add_action('wp', function() {
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    remove_action( 'woocommerce_before_shop_loop', 'sen_viet_tea_add_search_to_shop', 15 );
});
