<?php
/**
 * Template Name: Dashboard
 * Description: Trang tài khoản người dùng với sidebar và lịch sử giao dịch
 */

// Redirect if not logged in
if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// Lấy data từ bảng svt_members
global $wpdb;
$member_table = $wpdb->prefix . 'svt_members';
$member = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $member_table WHERE user_id = %d", $user_id ) );

// Nếu chưa có trong bảng members, tạo mới
if ( ! $member ) {
    $member_code = 'SVT' . str_pad( $user_id, 6, '0', STR_PAD_LEFT );
    $wpdb->insert( $member_table, array(
        'user_id' => $user_id,
        'member_code' => $member_code,
        'full_name' => $current_user->display_name,
        'email' => $current_user->user_email,
        'phone' => get_user_meta( $user_id, 'billing_phone', true ),
        'birthday' => get_user_meta( $user_id, 'billing_date_of_birth', true ),
        'address' => get_user_meta( $user_id, 'billing_address_1', true ),
        'city' => get_user_meta( $user_id, 'billing_city', true ),
        'district' => get_user_meta( $user_id, 'billing_state', true ),
        'ward' => '',
    ) );
    $member = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $member_table WHERE user_id = %d", $user_id ) );
}

// Lấy đơn hàng
$orders = wc_get_orders( array(
    'customer_id' => $user_id,
    'limit' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
) );

// Đếm đơn hàng theo trạng thái
$total_orders = count( $orders );
$pending_orders = 0;
$processing_orders = 0;
$completed_orders = 0;
$cancelled_orders = 0;

foreach ( $orders as $o ) {
    $status = $o->get_status();
    if ( $status === 'pending' || $status === 'on-hold' ) $pending_orders++;
    elseif ( $status === 'processing' ) $processing_orders++;
    elseif ( $status === 'completed' ) $completed_orders++;
    elseif ( $status === 'cancelled' || $status === 'failed' ) $cancelled_orders++;
}

// Lấy voucher
$coupons = get_posts( array(
    'post_type' => 'shop_coupon',
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
) );

get_header(); ?>

<style>
/* Dashboard Styles */
.dashboard-wrapper {
    display: flex;
    min-height: calc(100vh - 200px);
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 20px;
    gap: 30px;
}

/* Sidebar */
.dashboard-sidebar {
    width: 280px;
    background: linear-gradient(180deg, #2C5530 0%, #1a3320 100%);
    color: #FDFBF7;
    border-radius: 12px;
    position: sticky;
    top: 100px;
    height: fit-content;
    overflow: hidden;
}

.sidebar-header {
    padding: 35px 25px;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.user-avatar {
    margin-bottom: 15px;
}

.user-avatar svg {
    border-radius: 50%;
}

.user-name {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 5px;
    color: #fff;
}

.user-email {
    font-size: 13px;
    color: rgba(255,255,255,0.7);
}

.sidebar-menu {
    padding: 15px 0;
}

.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 25px;
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
    cursor: pointer;
}

.menu-item:hover {
    background: rgba(255,255,255,0.1);
    color: #fff;
}

.menu-item.active {
    background: rgba(255,255,255,0.15);
    color: #fff;
    border-left-color: #8FB996;
}

.menu-item svg {
    flex-shrink: 0;
    opacity: 0.9;
}

/* Main Content */
.dashboard-main {
    flex: 1;
    min-width: 0;
}

.dashboard-page {
    display: none;
    background: #fff;
    border-radius: 12px;
    padding: 35px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    border: 1px solid #eee;
}

.dashboard-page.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Page Header */
.page-header {
    margin-bottom: 30px;
}

.page-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 26px;
    color: #2C5530;
    margin-bottom: 8px;
}

.welcome-text {
    color: #666;
    font-size: 14px;
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 35px;
}

.stat-card {
    background: #FAFAFA;
    padding: 22px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 15px;
    border: 1px solid #f0f0f0;
    transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
}

.stat-icon {
    width: 48px;
    height: 48px;
    background: #F5F3EC;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-value {
    font-size: 26px;
    font-weight: 600;
    color: #2C5530;
    display: block;
}

.stat-label {
    font-size: 12px;
    color: #888;
}

/* Recent Orders */
.section-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    color: #2C5530;
    margin-bottom: 18px;
}

.recent-orders {
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
}

.order-item {
    display: flex;
    align-items: center;
    padding: 16px 20px;
    border-bottom: 1px solid #f5f5f5;
    transition: background 0.2s;
}

.order-item:last-child {
    border-bottom: none;
}

.order-item:hover {
    background: #FAFAFA;
}

.order-img {
    width: 48px;
    height: 48px;
    background: #F5F3EC;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-right: 15px;
}

.order-details {
    flex: 1;
}

.order-details h4 {
    font-size: 14px;
    color: #333;
    margin-bottom: 3px;
    font-weight: 500;
}

.order-details p {
    font-size: 12px;
    color: #888;
}

.order-status {
    padding: 5px 12px;
    border-radius: 15px;
    font-size: 11px;
    font-weight: 500;
    margin-right: 15px;
}

.order-status.delivered {
    background: #E8F5E9;
    color: #2E7D32;
}

.order-status.shipping {
    background: #FFF3E0;
    color: #E65100;
}

.order-status.pending {
    background: #E3F2FD;
    color: #1565C0;
}

.order-status.cancelled {
    background: #FFEBEE;
    color: #C62828;
}

.order-total {
    font-weight: 600;
    color: #2C5530;
    font-size: 14px;
    min-width: 110px;
    text-align: right;
}

/* Orders Table */
.orders-table {
    overflow-x: auto;
}

.orders-table table {
    width: 100%;
    border-collapse: collapse;
}

.orders-table th {
    background: #F5F3EC;
    padding: 14px 18px;
    text-align: left;
    font-weight: 600;
    color: #2C5530;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.orders-table td {
    padding: 16px 18px;
    border-bottom: 1px solid #f0f0f0;
    font-size: 13px;
}

.orders-table tr:last-child td {
    border-bottom: none;
}

.orders-table tr:hover {
    background: #FAFAFA;
}

.product-cell {
    display: flex;
    align-items: center;
    gap: 10px;
}

.product-thumb {
    width: 40px;
    height: 40px;
    background: #F5F3EC;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.btn-detail {
    color: #4A7C59;
    text-decoration: none;
    font-weight: 500;
    font-size: 12px;
    transition: color 0.2s;
}

.btn-detail:hover {
    color: #2C5530;
    text-decoration: underline;
}

/* Filter Tabs */
.filter-tabs {
    display: flex;
    gap: 8px;
    margin-top: 18px;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 8px 18px;
    border: 1px solid #ddd;
    background: #fff;
    border-radius: 20px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.2s;
    color: #666;
}

.filter-btn:hover {
    border-color: #4A7C59;
    color: #4A7C59;
}

.filter-btn.active {
    background: #4A7C59;
    color: #fff;
    border-color: #4A7C59;
}

/* Profile Page */
.profile-avatar {
    text-align: center;
    margin-bottom: 30px;
}

.btn-change-avatar {
    display: inline-block;
    margin-top: 12px;
    padding: 8px 20px;
    background: transparent;
    border: 1px solid #4A7C59;
    color: #4A7C59;
    border-radius: 6px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.2s;
}

.btn-change-avatar:hover {
    background: #4A7C59;
    color: #fff;
}

.profile-form {
    max-width: 650px;
    margin: 0 auto;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #444;
    font-size: 13px;
}

.form-group input {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 13px;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #FAFAFA;
}

.form-group input:focus {
    outline: none;
    border-color: #4A7C59;
    box-shadow: 0 0 0 3px rgba(74,124,89,0.1);
    background: #fff;
}

.form-section {
    margin: 30px 0;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.form-section h3 {
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    color: #2C5530;
    margin-bottom: 18px;
}

.form-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.btn-primary,
.btn-secondary {
    padding: 12px 28px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-primary {
    background: #4A7C59;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background: #3d6649;
}

.btn-secondary {
    background: #fff;
    color: #666;
    border: 1px solid #ddd;
}

.btn-secondary:hover {
    border-color: #999;
    color: #333;
}

/* Vouchers Page */
.voucher-input-group {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.voucher-input-group input {
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 13px;
    width: 280px;
}

.voucher-input-group input:focus {
    outline: none;
    border-color: #4A7C59;
}

.btn-apply {
    padding: 12px 24px;
    background: #8B5A2B;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    font-size: 13px;
    transition: background 0.2s;
}

.btn-apply:hover {
    background: #704820;
}

.vouchers-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 25px;
}

.voucher-card {
    border: 1px solid #eee;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    transition: transform 0.2s, box-shadow 0.2s;
}

.voucher-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
}

.voucher-discount {
    background: linear-gradient(135deg, #4A7C59 0%, #2C5530 100%);
    color: #fff;
    padding: 25px 20px;
    text-align: center;
    min-width: 100px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.discount-value {
    font-size: 28px;
    font-weight: 700;
    font-family: 'Playfair Display', serif;
}

.discount-label {
    font-size: 10px;
    letter-spacing: 2px;
    opacity: 0.9;
}

.voucher-info {
    flex: 1;
    padding: 18px;
}

.voucher-info h4 {
    font-size: 14px;
    color: #333;
    margin-bottom: 6px;
    font-weight: 500;
}

.voucher-info p {
    font-size: 12px;
    color: #666;
    margin-bottom: 3px;
}

.voucher-expire {
    color: #999 !important;
    font-size: 11px !important;
    margin-top: 8px !important;
}

.btn-use {
    align-self: center;
    margin-right: 15px;
    padding: 8px 16px;
    background: transparent;
    border: 1px solid #4A7C59;
    color: #4A7C59;
    border-radius: 5px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.2s;
}

.btn-use:hover {
    background: #4A7C59;
    color: #fff;
}

.voucher-note {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 25px;
    padding: 14px 18px;
    background: #FFF8E1;
    border-radius: 6px;
    border-left: 3px solid #8B5A2B;
    font-size: 12px;
    color: #666;
}

/* Responsive */
@media (max-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 992px) {
    .dashboard-wrapper {
        flex-direction: column;
    }
    
    .dashboard-sidebar {
        width: 100%;
        position: static;
    }
    
    .sidebar-header {
        display: flex;
        align-items: center;
        gap: 20px;
        text-align: left;
    }
    
    .user-avatar svg {
        width: 50px;
        height: 50px;
    }
    
    .sidebar-menu {
        display: flex;
        overflow-x: auto;
        padding: 0 15px;
    }
    
    .menu-item {
        padding: 12px 18px;
        white-space: nowrap;
        border-left: none;
        border-bottom: 3px solid transparent;
    }
    
    .menu-item.active {
        border-left: none;
        border-bottom-color: #8FB996;
    }
    
    .vouchers-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="dashboard-wrapper">
    <!-- Sidebar -->
    <aside class="dashboard-sidebar">
        <div class="sidebar-header">
            <div class="user-avatar">
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <circle cx="30" cy="30" r="30" fill="#4A7C59"/>
                    <circle cx="30" cy="24" r="10" fill="#FDFBF7"/>
                    <path d="M12 52c0-10 8-18 18-18s18 8 18 18" fill="#FDFBF7"/>
                </svg>
            </div>
            <div>
                <h3 class="user-name"><?php echo esc_html( $member->full_name ? $member->full_name : $current_user->display_name ); ?></h3>
                <p class="user-email"><?php echo esc_html( $current_user->user_email ); ?></p>
            </div>
        </div>
        
        <nav class="sidebar-menu">
            <a href="#" class="menu-item active" data-page="overview">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9,22 9,12 15,12 15,22"/>
                </svg>
                <span>Tổng quan</span>
            </a>
            <a href="#" class="menu-item" data-page="orders">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14,2 14,8 20,8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
                <span>Lịch sử mua hàng</span>
            </a>
            <a href="#" class="menu-item" data-page="profile">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                <span>Hồ sơ cá nhân</span>
            </a>
            <a href="#" class="menu-item" data-page="vouchers">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M21 5H3a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2 2 2 0 0 1-2 2v4a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2v-4a2 2 0 0 1-2-2 2 2 0 0 1 2-2V7a2 2 0 0 0-2-2z"/>
                    <line x1="9" y1="9" x2="15" y2="9"/>
                    <line x1="9" y1="13" x2="12" y2="13"/>
                </svg>
                <span>Mã giảm giá</span>
            </a>
            <a href="<?php echo wp_logout_url( home_url() ); ?>" class="menu-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16,17 21,12 16,7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
                <span>Đăng xuất</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="dashboard-main">
        
        <!-- Overview Page -->
        <div class="dashboard-page active" id="page-overview">
            <div class="page-header">
                <h1>Tổng quan tài khoản</h1>
                <p class="welcome-text">Chào mừng bạn quay trở lại, An!</p>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A7C59" stroke-width="1.5">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14,2 14,8 20,8"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value"><?php echo $total_orders; ?></span>
                        <span class="stat-label">Tổng đơn hàng</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A7C59" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value"><?php echo $pending_orders + $processing_orders; ?></span>
                        <span class="stat-label">Đang xử lý</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A7C59" stroke-width="1.5">
                            <path d="M21 5H3a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2 2 2 0 0 1-2 2v4a2 2 0 0 0 2 2h18a2 2 0 0 0 2-2v-4a2 2 0 0 1-2-2 2 2 0 0 1 2-2V7a2 2 0 0 0-2-2z"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value"><?php echo count( $coupons ); ?></span>
                        <span class="stat-label">Voucher hiện có</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#4A7C59" stroke-width="1.5">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                            <path d="M2 17l10 5 10-5"/>
                            <path d="M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-value"><?php echo number_format( $member->points ); ?></span>
                        <span class="stat-label">Điểm tích lũy</span>
                    </div>
                </div>
            </div>

            <h2 class="section-title">Đơn hàng gần đây</h2>
            <div class="recent-orders">
                <?php 
                $recent_orders = array_slice( $orders, 0, 5 );
                if ( $recent_orders ) :
                    foreach ( $recent_orders as $order ) :
                        $status = $order->get_status();
                        $status_class = 'pending';
                        $status_text = 'Đang xử lý';
                        
                        if ( $status === 'completed' ) {
                            $status_class = 'delivered';
                            $status_text = 'Đã giao';
                        } elseif ( $status === 'processing' ) {
                            $status_class = 'shipping';
                            $status_text = 'Đang giao';
                        } elseif ( $status === 'cancelled' || $status === 'failed' ) {
                            $status_class = 'cancelled';
                            $status_text = 'Đã hủy';
                        }
                        
                        // Lấy tên sản phẩm đầu tiên
                        $items = $order->get_items();
                        $first_item = !empty($items) ? reset($items) : null;
                        $item_name = $first_item ? $first_item->get_name() : 'N/A';
                ?>
                <div class="order-item">
                    <div class="order-img">🍵</div>
                    <div class="order-details">
                        <h4>Đơn hàng #<?php echo $order->get_order_number(); ?></h4>
                        <p><?php echo date( 'd/m/Y', strtotime( $order->get_date_created() ) ); ?></p>
                    </div>
                    <div class="order-status <?php echo $status_class; ?>"><?php echo $status_text; ?></div>
                    <div class="order-total"><?php echo $order->get_formatted_order_total(); ?></div>
                </div>
                <?php 
                    endforeach;
                else :
                ?>
                <div style="padding:30px;text-align:center;color:#999;">Chưa có đơn hàng nào</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Orders Page -->
        <div class="dashboard-page" id="page-orders">
            <div class="page-header">
                <h1>Lịch sử mua hàng</h1>
                <div class="filter-tabs">
                    <button class="filter-btn active" data-status="all">Tất cả</button>
                    <button class="filter-btn" data-status="processing">Đang xử lý</button>
                    <button class="filter-btn" data-status="shipping">Đang giao</button>
                    <button class="filter-btn" data-status="completed">Đã giao</button>
                    <button class="filter-btn" data-status="cancelled">Đã hủy</button>
                </div>
            </div>

            <div class="orders-table">
                <table>
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Ngày mua</th>
                            <th>Sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( $orders ) : ?>
                        <?php foreach ( $orders as $order ) :
                            $status = $order->get_status();
                            $status_class = 'pending';
                            $status_text = 'Đang xử lý';
                            
                            if ( $status === 'completed' ) {
                                $status_class = 'delivered';
                                $status_text = 'Đã giao';
                            } elseif ( $status === 'processing' ) {
                                $status_class = 'shipping';
                                $status_text = 'Đang giao';
                            } elseif ( $status === 'cancelled' || $status === 'failed' ) {
                                $status_class = 'cancelled';
                                $status_text = 'Đã hủy';
                            }
                            
                            $items = $order->get_items();
                            $first_item = !empty($items) ? reset($items) : null;
                            $item_name = $first_item ? $first_item->get_name() : 'N/A';
                        ?>
                        <tr data-status="<?php echo $status; ?>">
                            <td><strong>#<?php echo $order->get_order_number(); ?></strong></td>
                            <td><?php echo date( 'd/m/Y', strtotime( $order->get_date_created() ) ); ?></td>
                            <td>
                                <div class="product-cell">
                                    <div class="product-thumb">🍵</div>
                                    <span><?php echo esc_html( $item_name ); ?></span>
                                </div>
                            </td>
                            <td><strong><?php echo $order->get_formatted_order_total(); ?></strong></td>
                            <td><span class="order-status <?php echo $status_class; ?>"><?php echo $status_text; ?></span></td>
                            <td><a href="<?php echo $order->get_view_order_url(); ?>" class="btn-detail">Chi tiết</a></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="6" style="text-align:center;padding:30px;color:#999;">Chưa có đơn hàng nào</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Profile Page -->
        <div class="dashboard-page" id="page-profile">
            <div class="page-header">
                <h1>Hồ sơ cá nhân</h1>
            </div>

            <div class="profile-avatar">
                <svg width="100" height="100" viewBox="0 0 100 100" fill="none">
                    <circle cx="50" cy="50" r="50" fill="#4A7C59"/>
                    <circle cx="50" cy="40" r="18" fill="#FDFBF7"/>
                    <path d="M20 88c0-17 13-30 30-30s30 13 30 30" fill="#FDFBF7"/>
                </svg>
                <button class="btn-change-avatar">Thay đổi ảnh</button>
            </div>

            <form class="profile-form" id="profile-form">
                <div class="form-row">
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" name="full_name" value="<?php echo esc_attr( $member->full_name ); ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo esc_attr( $member->email ); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="tel" name="phone" value="<?php echo esc_attr( $member->phone ); ?>">
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" name="birthday" value="<?php echo esc_attr( $member->birthday ); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="<?php echo esc_attr( $member->address ); ?>">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Phường/Xã</label>
                        <input type="text" name="ward" value="<?php echo esc_attr( $member->ward ); ?>">
                    </div>
                    <div class="form-group">
                        <label>Quận/Huyện</label>
                        <input type="text" name="district" value="<?php echo esc_attr( $member->district ); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Tỉnh/Thành phố</label>
                    <input type="text" name="city" value="<?php echo esc_attr( $member->city ); ?>">
                </div>

                <div class="form-section">
                    <h3>Đổi mật khẩu</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" placeholder="••••••••">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" name="new_password" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-secondary">Hủy</button>
                    <button type="submit" class="btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>

        <!-- Vouchers Page -->
        <div class="dashboard-page" id="page-vouchers">
            <div class="page-header">
                <h1>Mã giảm giá của tôi</h1>
                <div class="voucher-input-group">
                    <input type="text" id="voucher-code" placeholder="Nhập mã giảm giá">
                    <button class="btn-apply" id="apply-voucher">Áp dụng</button>
                </div>
            </div>

            <div class="vouchers-grid">
                <?php if ( $coupons ) : ?>
                <?php foreach ( $coupons as $coupon ) :
                    $discount_type = get_post_meta( $coupon->ID, 'discount_type', true );
                    $amount = get_post_meta( $coupon->ID, 'coupon_amount', true );
                    $expiry = get_post_meta( $coupon->ID, 'date_expires', true );
                    $min_amount = get_post_meta( $coupon->ID, 'minimum_amount', true );
                    
                    if ( $discount_type === 'percent' ) {
                        $discount_display = $amount . '%';
                    } else {
                        $discount_display = number_format( intval( $amount ), 0, ',', '.' ) . 'K';
                    }
                    
                    $expiry_display = $expiry ? date( 'd/m/Y', $expiry ) : 'Không giới hạn';
                ?>
                <div class="voucher-card">
                    <div class="voucher-discount">
                        <span class="discount-value"><?php echo $discount_display; ?></span>
                        <span class="discount-label">GIẢM</span>
                    </div>
                    <div class="voucher-info">
                        <h4><?php echo esc_html( $coupon->post_title ); ?></h4>
                        <p><?php echo $min_amount ? 'Áp dụng cho đơn từ ' . number_format( intval( $min_amount ), 0, ',', '.' ) . 'đ' : 'Áp dụng cho tất cả đơn hàng'; ?></p>
                        <p class="voucher-expire">Hết hạn: <?php echo $expiry_display; ?></p>
                    </div>
                    <button class="btn-use" data-code="<?php echo esc_attr( $coupon->post_title ); ?>">Sử dụng</button>
                </div>
                <?php endforeach; ?>
                <?php else : ?>
                <div style="grid-column:1/-1;text-align:center;padding:40px;color:#999;">Chưa có mã giảm giá nào</div>
                <?php endif; ?>
            </div>

            <div class="voucher-note">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#8B5A2B" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="16" x2="12" y2="12"/>
                    <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
                <span>Lưu ý: Mỗi mã chỉ sử dụng một lần và không áp dụng chung với chương trình khuyến mãi khác.</span>
            </div>
        </div>

    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menu Navigation
    var menuItems = document.querySelectorAll('.menu-item[data-page]');
    var pages = document.querySelectorAll('.dashboard-page');

    menuItems.forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            var targetPage = this.getAttribute('data-page');
            
            menuItems.forEach(function(mi) { mi.classList.remove('active'); });
            this.classList.add('active');

            pages.forEach(function(page) { page.classList.remove('active'); });
            document.getElementById('page-' + targetPage).classList.add('active');
        });
    });

    // Filter Orders
    var filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            filterBtns.forEach(function(b) { b.classList.remove('active'); });
            this.classList.add('active');
            
            var status = this.getAttribute('data-status');
            var rows = document.querySelectorAll('.orders-table tbody tr');
            
            rows.forEach(function(row) {
                if (status === 'all' || row.getAttribute('data-status') === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });

    // Profile Form
    var profileForm = document.getElementById('profile-form');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Đã lưu thay đổi thành công!');
        });
    }

    // Voucher Apply
    var applyBtn = document.getElementById('apply-voucher');
    var voucherInput = document.getElementById('voucher-code');
    if (applyBtn && voucherInput) {
        applyBtn.addEventListener('click', function() {
            var code = voucherInput.value.trim();
            if (code) {
                alert('Đã áp dụng mã giảm giá: ' + code);
                voucherInput.value = '';
            } else {
                alert('Vui lòng nhập mã giảm giá!');
            }
        });
    }

    // Use Voucher
    var useBtns = document.querySelectorAll('.btn-use');
    useBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var code = this.getAttribute('data-code');
            alert('Đã thêm voucher ' + code + ' vào giỏ hàng!');
        });
    });
});
</script>

<?php get_footer(); ?>