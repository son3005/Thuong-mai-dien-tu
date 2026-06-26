<?php
/**
 * The template for displaying product search form
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<form role="search" method="get" class="custom-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-input-wrapper">
        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Tìm kiếm trà, bộ ấm chén...', 'sen-viet-tea' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <input type="hidden" name="post_type" value="product" />
    </div>
</form>
