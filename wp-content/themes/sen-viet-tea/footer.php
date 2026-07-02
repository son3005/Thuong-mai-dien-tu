</div><!-- #content -->

<footer class="site-footer">
    <div class="container">
        <?php if ( ! ( function_exists( 'is_checkout' ) && is_checkout() && empty( is_wc_endpoint_url( 'order-received' ) ) ) ) : ?>
        <div class="footer-widgets">
            <div class="footer-widget-column">
                <h3>Sen Việt Tea</h3>
                <p style="margin-bottom: 16px;">Tinh hoa trà Việt truyền thống. Mỗi lá trà là một câu chuyện từ thiên nhiên.</p>
                <p style="margin-bottom: 16px;">📧 contact@senviet.tea<br>📞 0123 456 789</p>
                <div class="footer-social-links" style="display: flex; gap: 12px; align-items: center;">
                    <a href="https://www.facebook.com/profile.php?id=61590563806510" target="_blank" rel="noopener noreferrer" title="Facebook" style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,0.12); color:inherit; text-decoration:none; font-size:18px; transition: background 0.2s, transform 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='rgba(255,255,255,0.12)';this.style.transform='translateY(0)'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/son_3005/" target="_blank" rel="noopener noreferrer" title="Instagram" style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,0.12); color:inherit; text-decoration:none; font-size:18px; transition: background 0.2s, transform 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='rgba(255,255,255,0.12)';this.style.transform='translateY(0)'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@voc_vach_cong_nghe" target="_blank" rel="noopener noreferrer" title="TikTok" style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:50%; background:rgba(255,255,255,0.12); color:inherit; text-decoration:none; font-size:18px; transition: background 0.2s, transform 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='rgba(255,255,255,0.12)';this.style.transform='translateY(0)'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.69a8.18 8.18 0 0 0 4.78 1.52V6.76a4.85 4.85 0 0 1-1.01-.07z"/></svg>
                    </a>
                </div>

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
