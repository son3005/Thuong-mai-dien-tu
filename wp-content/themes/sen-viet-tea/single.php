<?php
get_header();
?>

<main id="primary" class="site-main container" style="padding: var(--spacing-xl) 0;">
    <div style="max-width: 800px; margin: 0 auto;">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header" style="margin-bottom: var(--spacing-lg);">
                    <?php 
                    // Categories
                    echo '<div class="entry-meta" style="color: var(--color-secondary); font-weight: 500; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; margin-bottom: 10px;">';
                    the_category( ', ' );
                    echo '</div>';

                    the_title( '<h1 class="entry-title" style="color: var(--color-primary); font-size: 2.5rem; margin-bottom: 15px;">', '</h1>' ); 
                    
                    // Date & Author
                    echo '<div class="entry-meta" style="color: var(--color-text-light); font-size: 0.9rem;">';
                    echo 'Đăng ngày: ' . get_the_date() . ' | Bởi: ' . get_the_author();
                    echo '</div>';
                    ?>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-thumbnail" style="margin-bottom: var(--spacing-lg); border-radius: var(--border-radius); overflow: hidden;">
                        <?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: auto; display: block;' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content" style="line-height: 1.8; font-size: 1.15rem; color: var(--color-text);">
                    <?php
                    the_content();
                    
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Trang:', 'sen-viet-tea' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>

                <footer class="entry-footer" style="margin-top: var(--spacing-xl); padding-top: var(--spacing-md); border-top: 1px solid var(--color-border);">
                    <?php the_tags( '<span class="tags-links" style="font-weight: 500;">Từ khóa: ', ', ', '</span>' ); ?>
                </footer>
            </article>

            <?php
            // Related Products call to action (Custom feature)
            if ( class_exists( 'WooCommerce' ) ) {
                echo '<div class="related-products-cta" style="margin-top: var(--spacing-xl); padding: var(--spacing-lg); background: var(--color-bg); border-radius: var(--border-radius); text-align: center;">';
                echo '<h3 style="color: var(--color-primary); margin-bottom: var(--spacing-md);">Trải nghiệm hương vị trà tuyệt hảo</h3>';
                echo '<p style="color: var(--color-text-light); margin-bottom: var(--spacing-md);">Mời bạn ghé thăm cửa hàng của chúng tôi để khám phá những sản phẩm trà chất lượng nhất.</p>';
                echo '<a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" class="btn">Xem sản phẩm ngay</a>';
                echo '</div>';
            }

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </div>
</main>

<?php
get_footer();
