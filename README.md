# E-commerce WordPress Project

Dự án này là mã nguồn của hệ thống sàn thương mại điện tử đơn giản sử dụng nền tảng WordPress và các Plugin liên quan.

## Cấu trúc thư mục dự án

Dự án này tuân theo cấu trúc chuẩn của WordPress. Dưới đây là giải thích về các thư mục và tệp tin quan trọng mà team cần chú ý khi làm việc chung:

### Thư mục cấu hình và mã nguồn chính
- **`/wp-content/`**: Đây là thư mục quan trọng nhất mà bạn sẽ thường xuyên làm việc. Nó chứa tất cả dữ liệu tùy biến của web.
  - **`/wp-content/themes/`**: Chứa giao diện (theme) của sàn thương mại điện tử. Nếu có tùy chỉnh giao diện (code CSS, JS, PHP), bạn sẽ làm việc trong thư mục theme đang kích hoạt.
  - **`/wp-content/plugins/`**: Chứa các plugin hỗ trợ (WooCommerce, Elementor, Contact Form 7...). Mã nguồn của plugin đã được đồng bộ lên Git nên cả team không cần cài lại.
  - **`/wp-content/uploads/`**: Chứa hình ảnh sản phẩm, bài viết... *(Thư mục này được Git theo dõi để đồng bộ ảnh sản phẩm cho cả team)*.

### Các thành phần khác
- **`wp-config.php`**: File cấu hình kết nối database. File này **không được đẩy lên Github** để bảo mật thông tin.

---

## 🔥 Hướng dẫn Tải code và Cấu hình dự án (Dành cho Đồng nghiệp)

Nếu bạn là thành viên mới hoặc cần tải code về máy tính khác để làm việc, hãy làm đúng theo 3 bước sau đây để hệ thống chạy được:

### Bước 1: Tải mã nguồn về máy (Clone)
1. Mở Terminal (hoặc Git Bash) bên trong thư mục `htdocs` của XAMPP.
2. Gõ lệnh sau để tải toàn bộ mã nguồn về:
   ```bash
   git clone https://github.com/son3005/Thuong-mai-dien-tu.git
   ```
2. **Cấu hình Database (Làm 1 lần duy nhất):**
   - *Lưu ý: Vì lý do bảo mật, file `wp-config.php` không được đẩy lên Git. Khi bạn mới clone về sẽ không có file này.*
   - Đảm bảo bạn đã bật XAMPP (Apache & MySQL).
   - Truy cập `http://localhost/phpmyadmin` và tạo một Database trống tên là `dat_san`.
   - Truy cập `http://localhost/tên-thư-mục-chứa-code` (ví dụ `http://localhost/wordpress`).
   - Lúc này, WordPress sẽ phát hiện thiếu file config và tự động hiện màn hình cài đặt. 
   - **Điền thông tin kết nối như sau (quan trọng):**
     - Tên Database: `dat_san`
     - Tên người dùng: `root`
     - Mật khẩu: **(Xóa trắng, không nhập gì cả)**
     - Máy chủ: `localhost`
   - Bấm "Gửi". WordPress sẽ tự động sinh ra file `wp-config.php` mới trên máy của bạn.
3. **Cập nhật dữ liệu sản phẩm từ nhóm:**
   - Quay lại phpMyAdmin, chọn Database `dat_san` vừa tạo.
   - Nếu có sẵn các bảng (tables) nào, hãy **Check all** và chọn **Drop** để xóa trắng.
   - Nhấn tab **Import** (Nhập), chọn file `.sql` mới nhất trong thư mục `database-sync/` của dự án và nhấn **Go**.

---

## Quy trình nhập sản phẩm và đồng bộ (Dành cho Data Entry)

Vì dự án chạy local trên máy từng người, nhưng **chỉ có 1 bạn phụ trách nhập sản phẩm**, chúng ta sẽ áp dụng quy trình đồng bộ bằng Git như sau:

- Bạn phụ trách nhập liệu vào `wp-admin` thêm sản phẩm, thêm ảnh.
- **Sau khi nhập xong một đợt:**
  1. Vào phpMyAdmin (`http://localhost/phpmyadmin`).
  2. Chọn Database `dat_san` -> Nhấn **Export** -> Nhấn **Go**.
  3. Đổi tên file `.sql` vừa tải về theo ngày (VD: `data_sanpham_20-11.sql`) và lưu đè vào thư mục `database-sync/` của dự án.
  4. Mở Terminal, gõ các lệnh sau để đẩy lên Github:
     ```bash
     git add .
     git commit -m "Cập nhật sản phẩm và file database ngày..."
     git push
     ```

---

## Hướng dẫn thiết lập và sử dụng Plugins (Cho Team)

Dự án sử dụng các Plugin cốt lõi sau để xây dựng sàn TMĐT:

### 1. WooCommerce (Xử lý Bán hàng)
- **Truy cập:** Menu `WooCommerce` bên trái màn hình Admin.
- **Cấu hình Tiền tệ:** Vào `WooCommerce -> Cài đặt (Settings) -> Chung (General)`, cuộn xuống dưới cùng chọn Tiền tệ là **Đồng Việt Nam (₫)**.
- **Cấu hình Thanh toán:** Vào tab `Thanh toán (Payments)`. Hãy bật **Trả tiền mặt khi nhận hàng (COD)** và **Chuyển khoản ngân hàng** để dễ dàng test tính năng đặt hàng trong quá trình làm đồ án.
- **Thêm Sản phẩm:** Vào menu `Sản phẩm -> Thêm mới`. Điền tên, giá (Giá bán thường / Giá khuyến mãi), và tải Ảnh đại diện sản phẩm lên.

### 2. Elementor (Thiết kế Giao diện)
- **Sử dụng để làm Trang chủ:**
  1. Vào `Trang (Pages) -> Thêm trang mới`. Đặt tên là `Trang chủ`.
  2. Bấm nút màu xanh **"Sửa với Elementor"**.
  3. Kéo thả các khối tính năng (Text, Ảnh, Danh sách sản phẩm) từ menu bên trái vào màn hình.
  4. Lưu lại.
  5. Vào `Cài đặt (Settings) -> Đọc (Reading)`. Ở phần "Bố cục trang chủ", chọn Trang tĩnh và trỏ về trang `Trang chủ` vừa tạo.

### 3. Contact Form 7 (Tạo Form Liên hệ)
- Truy cập menu `Form Liên Hệ (Contact) -> Thêm mới`.
- Tạo các trường thông tin muốn khách hàng điền (Tên, SĐT, Lời nhắn).
- Copy đoạn Shortcode (mã code ngắn trong ngoặc vuông `[contact-form-7...]`) dán vào trang Liên Hệ bằng Elementor hoặc trình soạn thảo của WordPress.

### 4. Loco Translate (Dịch thuật)
- Nếu theme hoặc plugin hiện tiếng Anh (Ví dụ: nút "Add to cart"), vào menu `Loco Translate`.
- Chọn Plugin/Theme cần dịch, chọn ngôn ngữ Tiếng Việt và bắt đầu tìm từ tiếng Anh để thay bằng tiếng Việt.
