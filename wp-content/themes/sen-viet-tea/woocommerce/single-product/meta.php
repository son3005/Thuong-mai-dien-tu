<?php
/**
 * Single Product Meta - Override Sen Viet Tea Theme
 * Đổi "Category:" / "Categories:" → "Danh mục:" và "Tag:" / "Tags:" → "Thẻ:"
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( ProductType::VARIABLE ) ) ) : ?>

		<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php
	// Đổi "Category:" / "Categories:" → "Danh mục:"
	$cat_count  = count( $product->get_category_ids() );
	$cat_label  = _n( 'Danh mục:', 'Danh mục:', $cat_count, 'sen-viet-tea' );
	echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . $cat_label . ' ', '</span>' );
	?>

	<?php
	// Đổi "Tag:" / "Tags:" → "Thẻ:"
	$tag_count  = count( $product->get_tag_ids() );
	$tag_label  = _n( 'Thẻ:', 'Thẻ:', $tag_count, 'sen-viet-tea' );
	echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . $tag_label . ' ', '</span>' );
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
