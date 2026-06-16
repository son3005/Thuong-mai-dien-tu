# E-commerce WordPress Project

Dự án này là mã nguồn của hệ thống sàn thương mại điện tử đơn giản sử dụng nền tảng WordPress và các Plugin liên quan.

## Cấu trúc thư mục dự án

Dự án này tuân theo cấu trúc chuẩn của WordPress. Dưới đây là giải thích về các thư mục và tệp tin quan trọng mà team cần chú ý khi làm việc chung:

### Thư mục cấu hình và mã nguồn chính
- **`/wp-content/`**: Đây là thư mục quan trọng nhất mà bạn sẽ thường xuyên làm việc. Nó chứa tất cả dữ liệu tùy biến của web.
  - **`/wp-content/themes/`**: Chứa giao diện (theme) của sàn thương mại điện tử. Nếu có tùy chỉnh giao diện (code CSS, JS, PHP), bạn sẽ làm việc trong thư mục theme đang kích hoạt hoặc child-theme.
  - **`/wp-content/plugins/`**: Chứa các plugin hỗ trợ (ví dụ: WooCommerce để làm sàn TMĐT, Elementor để kéo thả giao diện, v.v.). Khi bạn cài thêm plugin trên local, mã nguồn của nó sẽ nằm ở đây và được đẩy lên Github để các thành viên khác có thể kéo về sử dụng chung.
  - **`/wp-content/uploads/`**: Chứa hình ảnh sản phẩm, bài viết... *(Thư mục này đã được loại bỏ khỏi Git qua file `.gitignore` để tránh phình to dung lượng kho chứa, do đó khi tải về ở máy khác, bạn cần tự đồng bộ hình ảnh hoặc dùng chung database/hosting)*.

### Các thành phần khác
- **`wp-config.php`**: File cấu hình kết nối database. File này **không được đẩy lên Github** (đã loại trừ trong `.gitignore`) để bảo mật thông tin. Mỗi thành viên sẽ dựa vào `wp-config-sample.php` để tạo một `wp-config.php` riêng trên máy (local) của mình.
- Các file `wp-admin`, `wp-includes` và các file `.php` ở thư mục gốc: Đây là mã nguồn lõi của WordPress. Bạn **không nên** chỉnh sửa bất cứ code nào trong này.

## Quy trình làm việc nhóm (Workflow)

1. **Clone dự án về máy:**
   ```bash
   git clone <link-repo>
   ```
2. **Cấu hình Local:**
   - Đảm bảo bạn đã cài XAMPP/MAMP/Laragon.
   - Copy file `wp-config-sample.php` thành `wp-config.php` và điền thông tin database local của bạn.
   - Import file CSDL (`.sql`) dự án vào database local của bạn (nếu có chia sẻ DB).
3. **Thêm tính năng / Plugin:**
   - Cài đặt cấu hình Plugin hoặc thêm tính năng trong Code ở `wp-content/themes` hay `wp-content/plugins`.
   - Commit code và đẩy lên nhánh của bạn, sau đó tạo Pull Request.

## Quy trình nhập sản phẩm và đồng bộ (Dành cho Team chạy Local)

Vì dự án chạy local trên máy từng người, nhưng **chỉ có 1 bạn phụ trách nhập sản phẩm**, chúng ta sẽ áp dụng quy trình đồng bộ bằng Git như sau:

### 1. Dành cho người nhập sản phẩm (Data Entry)
- Khởi động XAMPP/Laragon, vào `wp-admin` và thêm sản phẩm, thêm ảnh bình thường.
- (Hình ảnh tải lên sẽ tự động được lưu vào `wp-content/uploads/` và được Git theo dõi).
- **Sau khi nhập xong một đợt:**
  1. Vào phpMyAdmin (thường là `http://localhost/phpmyadmin`).
  2. Chọn Database của dự án -> Nhấn tab **Export** (Xuất) -> Định dạng SQL -> Nhấn **Go**.
  3. Copy file `.sql` vừa tải về, đặt tên theo ngày (VD: `data_sanpham_20-11.sql`) và lưu vào thư mục `database-sync/` của dự án.
  4. Mở Terminal, gõ các lệnh sau để đẩy lên Github:
     ```bash
     git add .
     git commit -m "Cập nhật sản phẩm và file database ngày 20-11"
     git push
     ```

### 2. Dành cho các thành viên khác (Developer)
Khi bạn cần code tính năng mới, hãy lấy sản phẩm mới nhất về máy của bạn:
- **Bước 1:** Kéo code và ảnh mới về:
  ```bash
  git pull origin main
  ```
- **Bước 2:** Cập nhật lại Database (chỉ làm khi thấy file `.sql` mới trong thư mục `database-sync/`):
  1. Vào phpMyAdmin ở máy bạn.
  2. Xóa tất cả các bảng (tables) cũ trong Database của dự án (hoặc Drop database rồi tạo lại).
  3. Nhấn tab **Import** (Nhập) -> Chọn file `.sql` mới nhất trong thư mục `database-sync/` -> Nhấn **Go** để nạp dữ liệu.
*(Lưu ý: Nếu tên Database hoặc URL (VD: `localhost/wordpress`) của các máy khác nhau, bạn có thể phải sửa lại table `wp_options` trong phpMyAdmin hoặc dùng lệnh search-replace, tốt nhất cả team nên cài XAMPP và dùng chung tên thư mục giống hệt nhau là `wordpress`).*
