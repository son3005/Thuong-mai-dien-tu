<?php
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- ===== HERO BREADCRUMB BANNER ===== -->
<div class="single-post-hero">
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="single-post-hero__bg" style="background-image: url('<?php echo esc_url( get_the_post_thumbnail_url( null, 'large' ) ); ?>')"></div>
        <div class="single-post-hero__overlay"></div>
    <?php else : ?>
        <div class="single-post-hero__bg single-post-hero__bg--plain"></div>
    <?php endif; ?>

    <div class="single-post-hero__content container">
        <!-- Breadcrumb (in hoa) -->
        <nav class="single-breadcrumb" aria-label="Breadcrumb">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">TRANG CHỦ</a>
            <span class="single-breadcrumb__sep">／</span>
            <?php
            $blog_page_id = get_option( 'page_for_posts' );
            if ( $blog_page_id ) {
                echo '<a href="' . esc_url( get_permalink( $blog_page_id ) ) . '">' . strtoupper( get_the_title( $blog_page_id ) ) . '</a>';
                echo '<span class="single-breadcrumb__sep">／</span>';
            }
            // Categories
            $cats = get_the_category();
            if ( $cats ) {
                echo '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . strtoupper( $cats[0]->name ) . '</a>';
                echo '<span class="single-breadcrumb__sep">／</span>';
            }
            ?>
            <span class="single-breadcrumb__current"><?php the_title(); ?></span>
        </nav>

        <!-- Post Title -->
        <h1 class="single-post-hero__title"><?php the_title(); ?></h1>

        <!-- Meta Row -->
        <div class="single-post-hero__meta">
            <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <?php echo get_the_date( 'd/m/Y' ); ?>
            </span>
            <span class="single-post-hero__meta-dot">·</span>
            <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <?php the_author(); ?>
            </span>
            <span class="single-post-hero__meta-dot">·</span>
            <span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <?php
                $content   = get_post_field( 'post_content', get_the_ID() );
                $word_count = str_word_count( wp_strip_all_tags( $content ) );
                $mins      = max( 1, ceil( $word_count / 200 ) );
                echo $mins . ' phút đọc';
                ?>
            </span>
        </div>
    </div>
</div>

<!-- ===== MAIN CONTENT ===== -->
<main id="primary" class="site-main">
    <div class="single-post-layout container">

        <!-- Article Body -->
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-article' ); ?>>

            <!-- Category Badge -->
            <?php $cats = get_the_category(); if ( $cats ) : ?>
            <div class="single-post-cats">
                <?php foreach ( $cats as $cat ) : ?>
                    <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" class="single-post-cat-badge">
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Content -->
            <div class="single-post-content entry-content">
                <?php
                the_content();
                wp_link_pages( array(
                    'before' => '<div class="page-links">Trang: ',
                    'after'  => '</div>',
                ) );
                ?>
            </div>

            <!-- Tags -->
            <?php the_tags( '<div class="single-post-tags"><span>🏷 Thẻ:</span> ', ', ', '</div>' ); ?>

            <!-- Author Box -->
            <div class="single-post-author-box">
                <?php echo get_avatar( get_the_author_meta('ID'), 72, '', '', array( 'class' => 'single-post-author-box__avatar' ) ); ?>
                <div class="single-post-author-box__info">
                    <div class="single-post-author-box__name"><?php the_author(); ?></div>
                    <div class="single-post-author-box__bio"><?php the_author_meta( 'description' ); ?></div>
                </div>
            </div>

            <!-- Navigation Prev/Next -->
            <nav class="single-post-nav">
                <?php
                $prev = get_previous_post();
                $next = get_next_post();
                if ( $prev ) :
                ?>
                <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="single-post-nav__item single-post-nav__item--prev">
                    <span class="single-post-nav__label">← Bài trước</span>
                    <span class="single-post-nav__title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
                </a>
                <?php else : ?>
                <div></div>
                <?php endif; ?>

                <?php if ( $next ) : ?>
                <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="single-post-nav__item single-post-nav__item--next">
                    <span class="single-post-nav__label">Bài tiếp →</span>
                    <span class="single-post-nav__title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
                </a>
                <?php endif; ?>
            </nav>

            <!-- Comments inside Article -->
            <?php if ( comments_open() || get_comments_number() ) : ?>
            <div class="article-comments-wrapper" style="margin-top: 40px; border-top: 1px solid var(--color-border-light); padding-top: 40px;">
                <?php comments_template(); ?>
            </div>
            <?php endif; ?>

        </article>

        <!-- Sidebar -->
        <aside class="single-post-sidebar">
            <!-- Back to blog -->
            <?php if ( $blog_page_id = get_option('page_for_posts') ) : ?>
            <a href="<?php echo esc_url( get_permalink( $blog_page_id ) ); ?>" class="single-sidebar-back">
                ← Tất cả bài viết
            </a>
            <?php endif; ?>

            <!-- Related posts -->
            <?php
            $cats = get_the_category();
            if ( $cats ) :
                $related = get_posts( array(
                    'category__in'   => wp_list_pluck( $cats, 'term_id' ),
                    'post__not_in'   => array( get_the_ID() ),
                    'posts_per_page' => 4,
                    'orderby'        => 'rand',
                ) );
                if ( $related ) :
            ?>
            <div class="single-sidebar-widget">
                <h4 class="single-sidebar-widget__title">Bài viết liên quan</h4>
                <ul class="single-sidebar-related">
                    <?php foreach ( $related as $r ) : ?>
                    <li>
                        <?php if ( has_post_thumbnail( $r->ID ) ) : ?>
                            <a href="<?php echo esc_url( get_permalink( $r->ID ) ); ?>">
                                <?php echo get_the_post_thumbnail( $r->ID, 'thumbnail', array( 'class' => 'single-sidebar-related__img' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div>
                            <a href="<?php echo esc_url( get_permalink( $r->ID ) ); ?>" class="single-sidebar-related__title">
                                <?php echo esc_html( get_the_title( $r->ID ) ); ?>
                            </a>
                            <span class="single-sidebar-related__date"><?php echo get_the_date( 'd/m/Y', $r->ID ); ?></span>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; endif; ?>

            <!-- Shop CTA -->
            <?php if ( class_exists( 'WooCommerce' ) ) : ?>
            <div class="single-sidebar-cta">
                <div class="single-sidebar-cta__icon">🍃</div>
                <h4>Khám phá trà Sen Việt</h4>
                <p>Tinh hoa từ thiên nhiên — chất lượng từ tâm huyết.</p>
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn" style="width:100%; text-align:center; display:block;">
                    Xem sản phẩm
                </a>
            </div>
            <?php endif; ?>
        </aside>

    </div><!-- .single-post-layout -->

</main>

<!-- ===== STYLES ===== -->
<style>
/* ---- Hero Banner ---- */
.single-post-hero {
    position: relative;
    min-height: 380px;
    display: flex;
    align-items: flex-end;
    overflow: hidden;
    margin-bottom: 0;
}
.single-post-hero__bg {
    position: absolute; inset: 0;
    background-size: cover;
    background-position: center;
    transform: scale(1.05);
    transition: transform 8s ease;
}
.single-post-hero:hover .single-post-hero__bg { transform: scale(1); }
.single-post-hero__bg--plain {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
}
.single-post-hero__overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.72) 0%, rgba(0,0,0,.25) 60%, transparent 100%);
}
.single-post-hero__content {
    position: relative; z-index: 2;
    padding: 60px 24px 48px;
    color: #fff;
    max-width: 900px;
}

/* Breadcrumb */
.single-breadcrumb {
    display: flex; flex-wrap: wrap; align-items: center; gap: 4px;
    font-size: 0.78rem; font-weight: 600; letter-spacing: 1.5px;
    text-transform: uppercase; margin-bottom: 20px;
    color: rgba(255,255,255,.75);
}
.single-breadcrumb a {
    color: rgba(255,255,255,.75); text-decoration: none;
    transition: color .2s;
}
.single-breadcrumb a:hover { color: #fff; }
.single-breadcrumb__sep { color: rgba(255,255,255,.4); margin: 0 2px; }
.single-breadcrumb__current { color: rgba(255,255,255,.5); }

/* Hero title */
.single-post-hero__title {
    font-family: var(--font-heading);
    font-size: clamp(1.8rem, 4vw, 3rem);
    font-weight: 700; line-height: 1.25;
    color: #fff; margin: 0 0 20px;
    text-shadow: 0 2px 12px rgba(0,0,0,.3);
}
.single-post-hero__meta {
    display: flex; flex-wrap: wrap; align-items: center; gap: 10px;
    font-size: 0.88rem; color: rgba(255,255,255,.8);
}
.single-post-hero__meta span {
    display: flex; align-items: center; gap: 5px;
}
.single-post-hero__meta-dot { color: rgba(255,255,255,.4); }

/* ---- Layout ---- */
.single-post-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 48px;
    padding: var(--spacing-xl) 24px;
    max-width: 1200px;
    align-items: start;
}
@media (max-width: 900px) {
    .single-post-layout { grid-template-columns: 1fr; }
    .single-post-sidebar { order: -1; }
}

/* ---- Article ---- */
.single-post-article {
    background: var(--color-white, #fff);
    border-radius: var(--radius-lg, 16px);
    border: 1px solid var(--color-border-light, #e8e0d5);
    padding: 48px;
    box-shadow: var(--shadow-sm, 0 2px 16px rgba(0,0,0,.04));
}
@media (max-width: 600px) { .single-post-article { padding: 24px 20px; } }

.single-post-cats {
    display: flex; flex-wrap: wrap; gap: 8px;
    margin-bottom: 28px;
}
.single-post-cat-badge {
    display: inline-block;
    padding: 4px 14px; border-radius: 20px;
    background: var(--color-primary-light, #f0ebe3);
    color: var(--color-secondary, #6b8f71);
    font-size: 0.78rem; font-weight: 700;
    letter-spacing: 1px; text-transform: uppercase;
    text-decoration: none; transition: background .2s;
}
.single-post-cat-badge:hover { background: var(--color-secondary); color: #fff; }

/* Content typography */
.single-post-content {
    line-height: 1.9; font-size: 1.1rem;
    color: var(--color-text, #3a3228);
}
.single-post-content h2, .single-post-content h3 {
    font-family: var(--font-heading);
    color: var(--color-primary);
    margin: 2em 0 .75em;
}
.single-post-content h2 { font-size: 1.65rem; }
.single-post-content h3 { font-size: 1.35rem; }
.single-post-content p { margin-bottom: 1.4em; }
.single-post-content img {
    border-radius: var(--border-radius);
    max-width: 100%; height: auto;
    margin: 1.5em auto; display: block;
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
}
.single-post-content blockquote {
    border-left: 4px solid var(--color-secondary);
    margin: 2em 0; padding: 16px 24px;
    background: var(--color-bg, #f9f6f0);
    border-radius: 0 8px 8px 0;
    font-style: italic; color: var(--color-primary);
    font-size: 1.1em;
}

/* Tags */
.single-post-tags {
    margin-top: 32px; padding-top: 24px;
    border-top: 1px solid var(--color-border-light);
    font-size: 0.9rem; color: var(--color-text-light);
}
.single-post-tags a {
    color: var(--color-secondary);
    text-decoration: none;
}
.single-post-tags a:hover { text-decoration: underline; }

/* Author Box */
.single-post-author-box {
    display: flex; gap: 20px; align-items: flex-start;
    margin-top: 36px; padding: 28px;
    background: var(--color-bg, #f9f6f0);
    border-radius: 12px;
    border: 1px solid var(--color-border-light);
}
.single-post-author-box__avatar {
    border-radius: 50%; width: 72px; height: 72px;
    object-fit: cover; flex-shrink: 0;
    border: 3px solid var(--color-secondary);
}
.single-post-author-box__name {
    font-weight: 700; color: var(--color-primary);
    font-size: 1.05rem; margin-bottom: 6px;
}
.single-post-author-box__bio {
    font-size: 0.92rem; color: var(--color-text-light); line-height: 1.6;
}

/* Prev/Next Nav */
.single-post-nav {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 16px; margin-top: 36px;
}
.single-post-nav__item {
    padding: 20px; border-radius: 12px;
    border: 1px solid var(--color-border-light);
    text-decoration: none; background: var(--color-white);
    transition: border-color .2s, box-shadow .2s;
    display: flex; flex-direction: column; gap: 6px;
}
.single-post-nav__item:hover {
    border-color: var(--color-secondary);
    box-shadow: 0 4px 16px rgba(0,0,0,.06);
}
.single-post-nav__item--next { text-align: right; }
.single-post-nav__label {
    font-size: 0.78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1px;
    color: var(--color-secondary);
}
.single-post-nav__title {
    font-size: 0.95rem; color: var(--color-primary);
    font-weight: 500; line-height: 1.4;
}

/* ---- Sidebar ---- */
.single-post-sidebar {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
@media (min-width: 901px) {
    .single-post-sidebar {
        position: sticky;
        top: 100px;
        align-self: start;
    }
}

.single-sidebar-back {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.88rem; font-weight: 600;
    color: var(--color-secondary); text-decoration: none;
    letter-spacing: .5px; transition: gap .2s;
}
.single-sidebar-back:hover { gap: 10px; }

.single-sidebar-widget {
    background: var(--color-white, #fff);
    border: 1px solid var(--color-border-light);
    border-radius: 14px; padding: 28px;
    box-shadow: var(--shadow-sm);
}
.single-sidebar-widget__title {
    font-family: var(--font-heading);
    font-size: 1.05rem; color: var(--color-primary);
    margin: 0 0 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid var(--color-border-light);
}
.single-sidebar-related {
    list-style: none; padding: 0; margin: 0;
    display: flex; flex-direction: column; gap: 16px;
}
.single-sidebar-related li {
    display: flex; gap: 12px; align-items: flex-start;
}
.single-sidebar-related__img {
    width: 64px; height: 64px; object-fit: cover;
    border-radius: 8px; flex-shrink: 0;
}
.single-sidebar-related__title {
    font-size: 0.9rem; font-weight: 500;
    color: var(--color-primary); text-decoration: none;
    line-height: 1.4; display: block; margin-bottom: 4px;
    transition: color .2s;
}
.single-sidebar-related__title:hover { color: var(--color-secondary); }
.single-sidebar-related__date {
    font-size: 0.78rem; color: var(--color-text-light);
}

/* CTA */
.single-sidebar-cta {
    background: linear-gradient(135deg, var(--color-primary) 0%, #2d5a3d 100%);
    border-radius: 14px; padding: 32px 24px;
    text-align: center; color: #fff;
}
.single-sidebar-cta__icon { font-size: 2rem; margin-bottom: 12px; }
.single-sidebar-cta h4 {
    font-family: var(--font-heading);
    font-size: 1.15rem; margin: 0 0 10px; color: #fff;
}
.single-sidebar-cta p {
    font-size: 0.88rem; color: rgba(255,255,255,.8);
    margin: 0 0 20px; line-height: 1.6;
}
.single-sidebar-cta .btn {
    background: #fff;
    color: var(--color-primary) !important;
    font-weight: 700;
}
.single-sidebar-cta .btn:hover { background: var(--color-bg); }

/* Overrides for comments inside article to prevent double borders/padding */
.article-comments-wrapper .custom-comments-area {
    margin-top: 0;
    padding: 0;
    background: transparent;
    border: none;
    box-shadow: none;
}
</style>

<?php endwhile; ?>

<?php get_footer(); ?>
