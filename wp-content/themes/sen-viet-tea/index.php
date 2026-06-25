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

        /* Start the Loop */
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom: var(--spacing-lg);">
                <header class="entry-header">
                    <?php
                    if ( is_singular() ) :
                        the_title( '<h1 class="entry-title" style="color: var(--color-primary);">', '</h1>' );
                    else :
                        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style="color: var(--color-primary);">', '</a></h2>' );
                    endif;
                    ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    if ( is_singular() ) {
                        the_content();
                    } else {
                        the_excerpt();
                        echo '<a href="' . esc_url( get_permalink() ) . '" class="btn btn-outline" style="margin-top: var(--spacing-sm);">' . __( 'Đọc thêm', 'sen-viet-tea' ) . '</a>';
                    }
                    ?>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
            <?php
        endwhile;

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
