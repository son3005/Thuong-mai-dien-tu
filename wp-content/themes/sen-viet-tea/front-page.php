<?php get_header(); ?>

<main id="primary" class="site-main">
    <!-- Hero Banner -->
    <section class="hero-section" style="background: url('<?php echo get_template_directory_uri(); ?>/assets/images/hero-banner.png') center/cover no-repeat;">
        <div class="hero-overlay"></div>
        <div class="hero-content fade-in-up">
            <span class="hero-eyebrow">🍃 Thủ Công · Tự Nhiên · Tinh Tế</span>
            <h1>Tinh Hoa Trà Việt</h1>
            <p class="hero-desc">Khám phá những hương vị trà truyền thống được tuyển chọn khắt khe từ những đồi chè danh tiếng nhất Việt Nam.</p>
            <?php $shop_url = function_exists('wc_get_page_id') ? get_permalink( wc_get_page_id( 'shop' ) ) : '#'; ?>
            <a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn-lg">Khám Phá Bộ Sưu Tập</a>
        </div>
    </section>

    <?php if ( class_exists( 'WooCommerce' ) ) : ?>

    <!-- Section: All Products (fallback-safe) -->
    <section style="padding: 80px 0; background: var(--color-white);">
        <div class="container">
            <div class="section-heading">
                <span class="section-eyebrow">Bộ Sưu Tập</span>
                <h2>Sản Phẩm Nổi Bật</h2>
                <p>Mỗi lá trà là một câu chuyện từ thiên nhiên Việt Nam</p>
            </div>
            <?php echo do_shortcode('[products limit="8" columns="4" orderby="date"]'); ?>
        </div>
    </section>

    <!-- Section: Categories Display -->
    <?php
    $categories_to_show = array(
        array('slug' => 'tra-thai-nguyen', 'title' => 'Trà Thái Nguyên', 'desc' => 'Hương vị mộc mạc nguyên bản từ vùng đất trà nổi tiếng nhất Việt Nam', 'bg' => 'var(--color-bg)'),
        array('slug' => 'tra-uop-hoa',    'title' => 'Trà Ướp Hoa',     'desc' => 'Sự kết hợp tinh tế giữa trà xanh và hương hoa tự nhiên', 'bg' => 'var(--color-white)'),
        array('slug' => 'phu-kien-tra',    'title' => 'Trà Cụ & Phụ Kiện', 'desc' => 'Nâng tầm nghệ thuật thưởng trà với những sản phẩm thủ công tinh xảo', 'bg' => 'var(--color-bg)'),
    );
    foreach ( $categories_to_show as $cat ) :
        $term = get_term_by( 'slug', $cat['slug'], 'product_cat' );
        if ( $term && ! is_wp_error( $term ) ) :
    ?>
    <section style="padding: 80px 0; background: <?php echo $cat['bg']; ?>;">
        <div class="container">
            <div class="section-heading">
                <span class="section-eyebrow"><?php echo esc_html( $cat['title'] ); ?></span>
                <h2><?php echo esc_html( $cat['title'] ); ?></h2>
                <p><?php echo esc_html( $cat['desc'] ); ?></p>
            </div>
            <?php echo do_shortcode('[products category="' . esc_attr( $cat['slug'] ) . '" limit="4" columns="4"]'); ?>
            <div style="text-align: center; margin-top: 40px;">
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="btn btn-outline">Xem tất cả <?php echo esc_html( $cat['title'] ); ?></a>
            </div>
        </div>
    </section>
    <?php
        endif;
    endforeach;
    ?>

    <?php endif; ?>

    <!-- CTA Section -->
    <section style="padding: 80px 0; background: linear-gradient(135deg, var(--color-primary) 0%, #2D5340 100%); text-align: center;">
        <div class="container">
            <h2 style="color: var(--color-white); font-size: var(--font-size-xl); margin-bottom: 16px;">Trải Nghiệm Trà Đúng Nghĩa</h2>
            <p style="color: rgba(255,255,255,0.7); max-width: 500px; margin: 0 auto 32px; font-size: var(--font-size-md);">Mỗi tách trà là một khoảnh khắc an nhiên. Hãy để Sen Việt Tea đồng hành cùng bạn.</p>
            <a href="<?php echo esc_url( $shop_url ); ?>" class="btn" style="background: var(--color-white); color: var(--color-primary) !important;">Mua Ngay</a>
        </div>
    </section>

</main><!-- #main -->

<?php get_footer(); ?>
