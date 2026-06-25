</div><!-- #content -->

<footer class="site-footer">
    <div class="container">
        <?php if ( ! ( function_exists( 'is_checkout' ) && is_checkout() && empty( is_wc_endpoint_url( 'order-received' ) ) ) ) : ?>
        <div class="footer-widgets">
            <div class="footer-widget-column">
                <h3>Sen Việt Tea</h3>
                <p style="margin-bottom: 16px;">Tinh hoa trà Việt truyền thống. Mỗi lá trà là một câu chuyện từ thiên nhiên.</p>
                <p>📧 contact@senviet.tea<br>📞 0123 456 789</p>
            </div>
            
            <div class="footer-widget-column">
                <h4>Liên kết hữu ích</h4>
                <nav class="footer-navigation">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ) );
                    ?>
                </nav>
            </div>
            
            <div class="footer-widget-column">
                <h4>Đăng ký nhận tin</h4>
                <p>Nhận các bí quyết pha trà và ưu đãi mới nhất.</p>
                <form action="#" method="post">
                    <input type="email" placeholder="Email của bạn">
                    <button type="submit" class="btn">Đăng ký</button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <div class="site-info">
            &copy; <?php echo date( 'Y' ); ?> Sen Việt Tea. Tinh hoa trà Việt.
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
