<?php
get_header();
?>

<main id="primary" class="site-main container" style="padding: var(--spacing-xl) 0;">
    <?php
    if ( have_posts() ) :

        if ( is_home() && ! is_front_page() ) :
            ?>
            <header>
                <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            </header>
            <?php
        endif;

        echo '<div class="woocommerce"><ul class="products">';
        /* Start the Loop */
        while ( have_posts() ) :
            the_post();
            ?>
            <li <?php post_class('product'); ?>>
                <a href="<?php echo esc_url( get_permalink() ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__title">
                    <?php 
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'medium_large' );
                    } else {
                        echo '<div style="width:100%; aspect-ratio:1/1; background:var(--color-border-light); display:flex; align-items:center; justify-content:center; color:var(--color-text-muted); font-weight:600; letter-spacing:2px;">SEN VIỆT TEA</div>';
                    }
                    ?>
                    <h2 class="woocommerce-loop-product__title"><?php the_title(); ?></h2>
                </a>
                
                <div style="padding: 0 20px 16px; color: var(--color-text-light); font-size: 14px; line-height: 1.6; text-align: center; flex-grow: 1;">
                    <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                </div>

                <a href="<?php echo esc_url( get_permalink() ); ?>" class="button add_to_cart_button" style="text-align: center; justify-content: center;"><?php _e( 'ĐỌC XEM', 'sen-viet-tea' ); ?></a>
            </li>
            <?php
        endwhile;
        echo '</ul></div>';

        the_posts_navigation();

    else :
        ?>
        <section class="no-results not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Không tìm thấy nội dung', 'sen-viet-tea' ); ?></h1>
            </header>
            <div class="page-content">
                <p><?php esc_html_e( 'Có vẻ như nội dung bạn đang tìm kiếm không tồn tại. Vui lòng thử tìm kiếm bằng từ khóa khác.', 'sen-viet-tea' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        </section>
        <?php
    endif;
    ?>
</main><!-- #main -->

<?php
get_footer();
