<?php
get_header();
?>

<main id="primary" class="site-main container" style="padding: var(--spacing-xl) 0;">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header" style="text-align: center; margin-bottom: var(--spacing-xl);">
                <?php the_title( '<h1 class="entry-title" style="color: var(--color-primary); font-size: 2.5rem;">', '</h1>' ); ?>
            </header>

            <div class="entry-content" style="max-width: 800px; margin: 0 auto; line-height: 1.8; font-size: 1.1rem; color: var(--color-text);">
                <?php
                the_content();
                ?>
            </div>
        </article>
        <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
