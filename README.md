# 🍃 Sen Việt Tea - Hướng Dẫn Cài Đặt & Đồng Bộ Nhóm (Local Development)

Chào mừng đội ngũ phát triển **Sen Việt Tea**. Dự án này được xây dựng trên nền tảng WordPress và WooCommerce, sử dụng Custom Theme tối giản theo phong cách Zen & Modern Premium E-Commerce.

Tài liệu này hướng dẫn cách cài đặt môi trường cục bộ (Localhost) và quy trình phối hợp chỉnh sửa đồng bộ giữa 4 thành viên trong nhóm.

---

## Ⅰ. Yêu Cầu Hệ Thống (Prerequisites)
Để chạy dự án, mỗi thành viên cần cài đặt sẵn trên máy cá nhân:
* **Môi trường Web Server:** XAMPP (khuyến nghị), Laragon, hoặc MAMP.
* **PHP Version:** 7.4 hoặc 8.0+.
* **Cơ sở dữ liệu:** MySQL / MariaDB (tên cơ sở dữ liệu cục bộ: `tea_store`).
* **WordPress:** Phiên bản 6.0+.
* **WooCommerce:** Phiên bản mới nhất.
* **Thư viện PHP:** Cần mở rộng kích hoạt thư viện GD (`extension=gd` trong `php.ini`) để WordPress và WooCommerce có thể nén và xử lý hình ảnh định dạng WebP mượt mà.

---

## Ⅱ. Quy Trình Cài Đặt Cho Thành Viên Mới (New Member Setup)

Nếu bạn là thành viên mới thiết lập môi trường local từ đầu, hãy làm theo các bước sau:

### Bước 1: Sao chép Mã nguồn (Codebase)
1. Copy toàn bộ thư mục dự án `wordpress` vào thư mục gốc của Web Server cục bộ (ví dụ: `C:\xampp\htdocs\wordpress\` trên Windows).
2. Kiểm tra thư mục theme tùy chỉnh đã nằm đúng vị trí: `wp-content/themes/sen-viet-tea/`.

### Bước 2: Thiết lập Cơ sở dữ liệu (Database)
1. Mở trình duyệt, truy cập `http://localhost/phpmyadmin/`.
2. Tạo một cơ sở dữ liệu mới với tên là: `tea_store` (bộ mã: `utf8mb4_unicode_ci`).
3. Import file sao lưu cơ sở dữ liệu (`.sql` - nếu trưởng nhóm cung cấp) hoặc thực hiện cài đặt WordPress mới thông qua cổng cấu hình mặc định tại `http://localhost/wordpress/`.
4. Chỉnh sửa file `wp-config.php` ở thư mục gốc để kết nối DB và tự động đồng bộ URL (giúp dự án chạy bình thường bất kể bạn đổi tên thư mục hay chạy cổng port khác):
   ```php
   define( 'DB_NAME', 'tea_store' );
   define( 'DB_USER', 'root' );
   define( 'DB_PASSWORD', '' ); // Mật khẩu của XAMPP mặc định để trống
   define( 'DB_HOST', 'localhost' );

   // Tự động cấu hình URL dựa trên tên thư mục và host cục bộ (Cần thiết cho cả nhóm đồng bộ)
   if ( isset( $_SERVER['HTTP_HOST'] ) ) {
       $http_protocol = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) ? 'https' : 'http';
       define( 'WP_HOME', $http_protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . basename( __DIR__ ) );
       define( 'WP_SITEURL', $http_protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . basename( __DIR__ ) );
   } else {
       define( 'WP_HOME', 'http://localhost/' . basename( __DIR__ ) );
       define( 'WP_SITEURL', $http_protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . basename( __DIR__ ) );
   }
   ```

### Bước 3: Kích hoạt Theme & Plugin
1. Đăng nhập vào trang quản trị WP Admin: `http://localhost/wordpress/wp-admin/`.
2. Đi tới mục **Giao diện (Appearance) -> Giao diện (Themes)**, tìm và bấm **Kích hoạt (Activate)** theme **Sen Việt Tea**.
3. Đi tới mục **Plugin**, cài đặt và kích hoạt plugin **WooCommerce**.

---

## Ⅲ. QUY TRÌNH PHỐI HỢP & ĐỒNG BỘ ĐỘI NGŨ (SYNC WORKFLOW)

Vì dự án chạy hoàn toàn trên môi trường Local cá nhân, nhóm cần tuân thủ 3 bước đồng bộ dưới đây để đảm bảo code và dữ liệu luôn trùng khớp:

### 1. Đồng bộ Giao diện (Code - Theme Files)
* **Người quản lý chính:** **Thành viên 2 (Dev)** chịu trách nhiệm chỉnh sửa code trong thư mục theme `wp-content/themes/sen-viet-tea/`.
* **Cách đồng bộ:**
  - Nhóm nên sử dụng **Git** (GitHub/GitLab) tạo 1 repository riêng cho thư mục theme này.
  - Khi Thành viên 2 sửa đổi CSS hoặc PHP, họ sẽ push lên repository. Các thành viên khác chỉ cần chạy `git pull` trong thư mục theme để cập nhật giao diện mới nhất.
  - *Cách thủ công (nếu không dùng Git):* Thành viên 2 nén thư mục theme `sen-viet-tea` gửi cho cả nhóm ghi đè vào máy local của mình.

### 2. Đồng bộ Nội dung (Dữ liệu Sản phẩm, Bài viết, Menu)
* **Người quản lý chính:** **Thành viên 1 (Content)** nhập toàn bộ sản phẩm demo, bài viết blog, thuộc tính và cấu hình menu trên máy local của mình.
* **Cách đồng bộ:**
  - Sau khi thêm mới sản phẩm/bài viết, Thành viên 1 vào **Công cụ (Tools) -> Xuất ra (Export)** -> Chọn xuất **Tất cả nội dung** để tải về 1 file `.xml`.
  - Thành viên 1 gửi file `.xml` này cho cả nhóm qua Zalo/Drive.
  - Các thành viên khác tải file về, vào **Công cụ (Tools) -> Nhập vào (Import) -> WordPress** trên máy local của mình, tải file lên và tích chọn "Tải về và nhập các file đính kèm" để dữ liệu đồng bộ ngay lập tức mà không phải tự tay nhập lại.

### 3. Đồng bộ Hình ảnh thư viện (Media Library Uploads)
* **Cách đồng bộ:**
  - File `.xml` chỉ chứa text và link ảnh. Để ảnh hiển thị đầy đủ, Thành viên 1 cần nén thư mục hình ảnh uploads: `wp-content/uploads/` trên máy mình gửi cho cả nhóm.
  - Mọi người giải nén và ghi đè vào thư mục `wp-content/uploads/` trên máy local của mình.

---

## Ⅳ. BẢN ĐỒ PHÂN CHIA NHIỆM VỤ CHO 4 THÀNH VIÊN

Để tiến trình trơn tru, công việc được phân chia cụ thể như sau:

1. **Thành viên 1 (Content / Admin):**
   - Đảm bảo tạo đủ **12 sản phẩm demo** để bố cục lưới đẹp mắt.
   - Biên tập nội dung các trang chính: *Giới thiệu (Về chúng tôi)*, các bài viết *Kiến thức Trà*, trang *Liên hệ*.
   - Thực hiện quy trình xuất file `.xml` dữ liệu định kỳ để đồng bộ cho cả nhóm.
2. **Thành viên 2 (Dev / Front-End):**
   - Viết code tinh chỉnh CSS cho bảng giỏ hàng, bố cục trang Thanh toán thành 2 cột và trang tin tức trong file [style.css](file:///d:/Develop/xampp/htdocs/wordpress/wp-content/themes/sen-viet-tea/style.css).
   - Thêm thông tin MST doanh nghiệp và logo Bộ Công Thương vào [footer.php](file:///d:/Develop/xampp/htdocs/wordpress/wp-content/themes/sen-viet-tea/footer.php).
3. **Thành viên 3 (Designer / Media):**
   - Tối ưu kích thước toàn bộ ảnh sản phẩm về tỷ lệ vuông `1:1` để hiển thị cân đối.
   - Nén ảnh chất lượng cao (định dạng WebP, dung lượng < 150KB) trước khi chuyển cho Thành viên 1 tải lên.
4. **Thành viên 4 (QA / Tester):**
   - Kiểm tra hiển thị giao diện mượt mà trên desktop/mobile.
   - Thử nghiệm quy trình mua hàng cục bộ (Thêm giỏ -> Điền form Thanh toán -> Đặt hàng thành công) xem có lỗi phát sinh không.

---

## Ⅴ. HƯỚNG DẪN THÊM SẢN PHẨM & CẤU HÌNH THUỘC TÍNH (PRODUCT SETUP GUIDE)

Quy trình chuẩn dành cho **Thành viên 1 (Content)** và **Thành viên 3 (Designer)** để đảm bảo mọi sản phẩm tải lên đều đẹp mắt và đồng bộ:

### 1. Chuẩn bị Hình ảnh sản phẩm (Lưu ở đâu, cấu trúc thế nào?)
* **Định dạng & Dung lượng:** Bắt buộc lưu dưới định dạng **WebP** (.webp), chất lượng nén 90%, dung lượng **< 150KB** để trang web tải nhanh nhất.
* **Kích thước & Tỷ lệ:** Ảnh đại diện bắt buộc phải là **hình vuông (tỉ lệ 1:1)**, kích thước chuẩn là **800x800 px**.
* **Cấu trúc lưu trữ Offline (Trước khi upload):** 
  - Các ảnh sản phẩm gốc chưa upload nên được Designer lưu trong thư mục: `wp-content/themes/sen-viet-tea/assets/images/products/` trên máy local để cả nhóm dễ dàng đồng bộ, lưu trữ và quản lý nguồn ảnh gốc của dự án.
  - Khi tải lên WordPress, ảnh sẽ tự động được lưu trong thư mục hệ thống `wp-content/uploads/`.

### 2. Các thuộc tính bắt buộc khai báo (Product Attributes)
Trước khi thêm sản phẩm, nhóm cần khai báo thuộc tính dùng chung trong **Sản phẩm (Products) -> Các thuộc tính (Attributes)**:
1. **Trọng lượng (weight):**
   - *Tên:* Trọng lượng
   - *Đường dẫn (slug):* `weight`
   - *Các giá trị (terms):* `100g`, `200g`, `500g` (hoặc `Hộp 100g`, `Gói 200g`).
2. **Quy cách đóng gói (packaging):**
   - *Tên:* Quy cách
   - *Đường dẫn (slug):* `packaging`
   - *Các giá trị (terms):* `Túi hút chân không`, `Hộp giấy Zen`, `Hộp thiếc Premium`.

### 3. Quy trình thêm sản phẩm mẫu (Step-by-Step Upload)
1. Vào **Sản phẩm (Products) -> Thêm mới (Add New)**.
2. **Tiêu đề & Nội dung:**
   - *Tiêu đề:* Nhập tên sản phẩm thanh lịch (Ví dụ: *Trà Đinh Ngọc Cao Cấp Thái Nguyên*).
   - *Mô tả chi tiết (Long Description):* Viết triết lý sản phẩm, câu chuyện đồi chè, hương vị đặc trưng, có thể chèn thêm ảnh nước trà hoặc ảnh đồi chè.
3. **Phân loại danh mục (Categories):** Ở cột bên phải, tích chọn danh mục tương ứng (Ví dụ: *Trà Thái Nguyên*).
4. **Cấu hình dữ liệu sản phẩm (Product Data):**
   - **Trường hợp A - Sản phẩm đơn giản (Nếu chỉ bán một mức trọng lượng duy nhất):**
     - Đặt giá bán thường (Regular Price) và giá khuyến mãi (Sale Price) nếu có.
     - Vào tab **Các thuộc tính (Attributes)** -> Chọn thuộc tính (Ví dụ: "Trọng lượng") -> Chọn giá trị tương ứng (Ví dụ: "100g") -> Bấm *Lưu thuộc tính*.
   - **Trường hợp B - Sản phẩm có biến thể (Nếu giá thay đổi theo trọng lượng 100g/200g/500g):**
     - Chọn kiểu dữ liệu là **Sản phẩm biến thể (Variable Product)**.
     - Vào tab **Các thuộc tính (Attributes)** -> Chọn "Trọng lượng" -> Chọn các giá trị (100g, 200g, 500g) -> Tích chọn **Dùng cho nhiều biến thể (Used for variations)** -> Bấm *Lưu thuộc tính*.
     - Vào tab **Các biến thể (Variations)** -> Bấm **Tạo biến thể từ tất cả thuộc tính** -> Điền giá bán, số lượng kho cho từng biến thể trọng lượng cụ thể.
5. **Mô tả ngắn sản phẩm (Short Description):** Nhập mô tả ngắn 3-4 dòng tóm tắt hương vị trà.
6. **Đặt ảnh đại diện sản phẩm (Set Product Image):** Upload file ảnh `.webp` hình vuông đã chuẩn bị ở Bước 1 vào mục **Ảnh sản phẩm (Product image)** ở cột bên phải.
7. **Đăng bài (Publish):** Bấm nút Đăng bài để sản phẩm hiển thị trên website.

---

*Tài liệu này được soạn thảo để hướng dẫn quy trình đồng bộ nội bộ, chúc nhóm hoàn thiện sản phẩm Sen Việt Tea tốt nhất!*
