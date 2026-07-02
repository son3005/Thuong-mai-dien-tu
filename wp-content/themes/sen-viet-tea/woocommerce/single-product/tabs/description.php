<?php
/**
 * Description tab - Override Sen Viet Tea Theme
 *
 * Ghi đè template WooCommerce để:
 * 1. Hiển thị tiêu đề tiếng Việt "Mô tả sản phẩm" thay vì "Description"
 * 2. Fix lỗi Mojibake nếu nội dung DB bị double-encoded
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Mô tả sản phẩm', 'sen-viet-tea' ) );

?>

<?php if ( $heading ) : ?>
	<h2><?php echo esc_html( $heading ); ?></h2>
<?php endif; ?>

<?php
/*
 * Fix lỗi Mojibake (Double-encoded UTF-8):
 * Nguyên nhân: nội dung được nhập vào DB qua kết nối Latin-1,
 * dẫn đến UTF-8 bytes bị encode thêm 1 lần nữa.
 * Ví dụ: "Việt" trở thành "Viá»‡t"
 *
 * Cách nhận biết: chuỗi tiếng Việt hợp lệ UTF-8 bị hiển thị dưới dạng
 * các ký tự Ã, Â, á» ... khi browser đọc đúng UTF-8.
 *
 * Cách fix: decode ngược từ UTF-8 → bytes thô → đọc lại đúng UTF-8.
 */
$raw_content = $post->post_content;

// Phát hiện Mojibake: kiểm tra xem chuỗi có chứa pattern double-encoded không
// "Ã" trong UTF-8 = 0xC3 0x83 — xuất hiện khi ký tự tiếng Việt bị double-encode
$is_mojibake = false;
if ( function_exists( 'mb_detect_encoding' ) ) {
    // Nếu chuỗi chứa Ã theo sau bởi ký tự Latin mở rộng → dấu hiệu double-encode
    if ( preg_match( '/Ã[€-ÿ]|Â[€-ÿ]/', $raw_content ) ) {
        $is_mojibake = true;
    }
}

if ( $is_mojibake ) {
    // Giải mã: chuyển từ UTF-8 (đã bị double-encode) về bytes gốc
    $fixed = mb_convert_encoding( $raw_content, 'ISO-8859-1', 'UTF-8' );
    $the_content = apply_filters( 'the_content', $fixed );
} else {
    $the_content = apply_filters( 'the_content', $raw_content );
}

$the_content = str_replace( ']]>', ']]&gt;', $the_content );
echo wp_kses_post( $the_content );
?>
