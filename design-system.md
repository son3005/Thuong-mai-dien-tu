# Hệ Thống Thiết Kế & Cây Thông Tin (Design System & IA)
*Dự án: Hệ thống thương mại điện tử kinh doanh trà và phụ kiện pha trà*

Dựa trên việc phân tích cấu trúc của 3 website hàng đầu về trà (`thaininhtra.vn`, `traviet.com`, `traduoc.vn`), dưới đây là bản thiết kế Cây thông tin (Information Architecture) và Design System đề xuất cho dự án của chúng ta.

---

## 1. Cây thông tin (Information Architecture Tree)
Cấu trúc này được tổng hợp để đảm bảo tính logic, chuẩn SEO và trải nghiệm mua sắm mượt mà nhất.

```text
📦 CÂY THÔNG TIN (WEBSITE SITEMAP)
 ┣ 🏠 Trang chủ (Home)
 ┣ 📖 Về chúng tôi (About Us)
 ┃ ┣ Câu chuyện thương hiệu (Brand Story)
 ┃ ┗ Vùng nguyên liệu & Xưởng sản xuất (Tea Sources & Factory)
 ┣ 🍵 Sản phẩm (Products)
 ┃ ┣ 🌿 Trà Truyền Thống (Traditional Tea)
 ┃ ┃ ┣ Trà Thái Nguyên (Nõn Tôm, Móc Câu, Trà Đinh)
 ┃ ┃ ┣ Trà Ô Long (Oolong Tea)
 ┃ ┃ ┗ Trà Ướp Hoa (Trà Lài, Trà Sen)
 ┃ ┣ 🌺 Trà Dược & Trà Thảo Mộc (Herbal Tea)
 ┃ ┃ ┗ Trà Hoa Cúc, Trà Hoa Hồng, Trà Gạo Lứt...
 ┃ ┣ 🏺 Trà Cụ & Ấm Chén (Tea Accessories)
 ┃ ┃ ┣ Bộ Ấm Chén Bát Tràng / Tử Sa
 ┃ ┃ ┗ Dụng Cụ Pha Trà (Khay trà, Lọc trà, Dụng cụ gắp)
 ┃ ┣ 🥮 Đặc sản ăn kèm (Tea Snacks)
 ┃ ┃ ┗ Bánh đậu xanh, Bánh trung thu, Hạt dinh dưỡng
 ┃ ┗ 🎁 Quà Tặng (Gift Sets)
 ┃   ┣ Quà Tặng Doanh Nghiệp (Corporate Gifts)
 ┃   ┗ Quà Biếu Lễ Tết (Tết Gifts)
 ┣ 🛍️ Luồng Mua Sắm (Shopping Flow)
 ┃ ┣ Chi tiết sản phẩm (Product Details)
 ┃ ┣ Giỏ hàng (Shopping Cart)
 ┃ ┣ Thanh toán (Checkout)
 ┃ ┗ Tài khoản của tôi (My Account/Orders)
 ┣ 📚 Kiến thức & Blog (Tea Knowledge)
 ┃ ┣ Hiểu về trà (Phân loại, Cách pha trà chuẩn, Tác dụng)
 ┃ ┣ Văn hóa trà đạo (Tea Culture)
 ┃ ┗ Tin tức & Sự kiện (News & Events)
 ┣ 📞 Liên hệ (Contact)
 ┃ ┣ Thông tin liên hệ & Cửa hàng
 ┃ ┗ Form tư vấn / Gửi câu hỏi
 ┗ 🛒 Hỗ trợ Khách hàng (Customer Service)
   ┣ Hướng dẫn mua hàng
   ┣ Chính sách đổi trả & bảo hành
   ┣ Chính sách thanh toán & vận chuyển
   ┗ Câu hỏi thường gặp (FAQ)
```

---

## 2. Design System (Hệ thống thiết kế)

Để tạo ra một giao diện chuyên nghiệp, mang đậm chất văn hóa "thưởng trà" (sự tinh tế, thanh lịch, an nhiên, mộc mạc), chúng ta sẽ áp dụng các quy tắc thiết kế sau:

### 🎨 2.1. Bảng màu (Color Palette)
- **Màu chủ đạo (Primary):** `Xanh lục trà` (`#4A7C59` hoặc `#5C8D6D`) 
  - *Ý nghĩa:* Tượng trưng cho lá trà tươi mát, thiên nhiên, sự thanh tịnh và mộc mạc.
- **Màu phụ trợ (Secondary):** `Nâu đất nung` / `Nâu gỗ` (`#8B5A2B` hoặc `#A0522D`) 
  - *Ý nghĩa:* Tượng trưng cho ấm trà đất nung Tử Sa, mộc mạc, truyền thống và vững chãi.
- **Màu nền (Background):** `Trắng ngà` / `Vàng nhạt` (`#FDFBF7` hoặc `#FAF8F5`) 
  - *Ý nghĩa:* Tượng trưng cho màu nước trà pha loãng hoặc giấy dó, tạo cảm giác dịu mắt, sang trọng, thanh lịch hơn là nền trắng toát (`#FFFFFF`).
- **Màu chữ (Text Color):** `Xám đậm` (`#333333` hoặc `#2C3E50`)
  - *Ý nghĩa:* Đọc dễ dàng hơn màu đen tuyền (`#000000`), giảm độ chói mắt khi đọc bài viết blog dài.

### 🔤 2.2. Nghệ thuật chữ (Typography)
Việc chọn font chữ quyết định rất lớn đến "cảm giác" cao cấp của website bán trà.
- **Font Tiêu đề (Headings):** Sử dụng font Serif (có chân) như **Playfair Display**, **Lora**, hoặc **Merriweather**.
  - *Lý do:* Mang lại cảm giác cổ điển, truyền thống, sang trọng và đậm chất văn hóa Á Đông.
- **Font Văn bản (Body Text):** Sử dụng font Sans-serif (không chân) như **Inter**, **Roboto**, hoặc **Mulish**.
  - *Lý do:* Hiện đại, rõ ràng, tối ưu cho việc đọc nội dung dài như mô tả sản phẩm hay bài viết kiến thức.

### 🧱 2.3. Các thành phần giao diện (UI Components)
- **Nút bấm (Buttons):** 
  - *Nút chính (Thêm vào giỏ/Mua ngay):* Nền màu Xanh trà, chữ trắng. Bo góc nhẹ (border-radius: 4px - 6px) để tạo sự thân thiện nhưng không quá trẻ con.
  - *Nút phụ (Xem chi tiết/Đọc thêm):* Outline viền màu Xanh trà, nền trong suốt. Hiệu ứng Hover chuyển sang màu xanh nhạt.
- **Thẻ sản phẩm (Product Cards):**
  - Thiết kế Minimalist (tối giản). Khoảng trắng (whitespace) rộng rãi để sản phẩm trông cao cấp hơn (giống như cách trưng bày trong bảo tàng).
  - Đường viền mờ (`1px solid #eee`) hoặc đổ bóng rất nhẹ (`box-shadow: 0 4px 12px rgba(0,0,0,0.05)`).
- **Trang Chi tiết sản phẩm & Thanh toán (Product & Checkout UI):**
  - *Chi tiết sản phẩm:* Hiển thị rõ nguồn gốc trà, bảng hướng dẫn cách pha (nhiệt độ nước, thời gian hãm trà). Hình ảnh to, sắc nét.
  - *Giỏ hàng & Thanh toán:* Giao diện tối giản (distraction-free checkout) để khách hàng tập trung hoàn tất đơn. Nút "Tiến hành thanh toán" phải lớn và dùng màu Xanh trà đậm nổi bật.
- **Icon (Biểu tượng):**
  - Dạng line (đường nét thanh mảnh), không dùng icon mảng màu khối đặc (solid) để giữ sự tinh tế.

### 🖼️ 2.4. Phong cách Hình ảnh & Moodboard (Photography)
- **Tông màu ảnh:** Ấm áp (warm tone), độ tương phản vừa phải, không chỉnh sửa quá đà (giữ độ tự nhiên).
- **Concept:** Ảnh sản phẩm tĩnh vật (Still life) kết hợp bối cảnh thiên nhiên (lá cây, gỗ, nước), khói bốc lên từ tách trà, ánh sáng tự nhiên (cửa sổ rọi vào).
- Tỉ lệ ảnh đồng nhất, nên dùng nền đồng màu hoặc nền tách mờ (bokeh) làm nổi bật sản phẩm ấm trà hoặc gói trà.

---

## 3. Cấu trúc chi tiết từng trang (Page-level Architecture)

### 🏠 3.1. Trang chủ (Home Page)
- **Header:** Logo (Trái/Giữa), Menu chính, Thanh tìm kiếm, Icon Giỏ hàng, Icon Tài khoản.
- **Hero Banner:** Hình ảnh nghệ thuật về đồi chè hoặc ấm trà đang rót. Nút Call-to-action (CTA) "Khám phá ngay".
- **Câu chuyện thương hiệu (Tóm tắt):** Một đoạn giới thiệu ngắn về triết lý trà của thương hiệu.
- **Sản phẩm nổi bật / Trà thượng hạng:** Slider hoặc Grid hiển thị các sản phẩm best-seller.
- **Banner Khuyến mãi / Bộ quà tặng:** Nhấn mạnh các dịp lễ (Ví dụ: Quà biếu Trung Thu, Tết).
- **Kiến thức trà đạo (Blog mới nhất):** 3 bài viết nổi bật về cách pha trà, phân biệt loại trà.
- **Footer:** Cột thông tin liên hệ, Link chính sách, Form đăng ký nhận bản tin, Icon mạng xã hội.

### 🍵 3.2. Trang Chi tiết sản phẩm (Product Detail Page - PDP)
- **Breadcrumb (Thanh điều hướng):** Ví dụ: *Trang chủ > Sản phẩm > Trà Truyền Thống > Trà Nõn Tôm*.
- **Khu vực hiển thị chính (Top Section):**
  - *Cột trái (Gallery):* Ảnh chính lớn (sắc nét), các ảnh phụ (cận cảnh lá trà, màu nước trà khi pha, quy cách đóng gói).
  - *Cột phải (Thông tin mua hàng):* 
    - Tên sản phẩm (To, font Serif).
    - Đánh giá (Số sao & lượt review).
    - Giá bán (Nổi bật) & Trạng thái kho (Còn hàng).
    - Tóm tắt thông tin: Nguồn gốc (Thái Nguyên/Bảo Lộc), Hương vị đặc trưng.
    - Lựa chọn phân loại (Ví dụ: Hộp 100g, Hộp 200g, Gói hút chân không).
    - Khu vực Số lượng & Nút "Thêm vào giỏ hàng" + "Mua ngay" (To, màu Xanh trà).
- **Khu vực Thông tin chi tiết (Middle Section - Tabs):**
  - *Tab Mô tả chi tiết:* Kể câu chuyện về loại trà này, xuất xứ, quá trình thu hái và sao trà.
  - *Tab Hướng dẫn pha trà:* Thông số lý tưởng (Ví dụ: Nhiệt độ nước 85°C, Thời gian hãm 30 giây, Lượng trà 5g). Có thể làm dạng icon trực quan.
  - *Tab Đánh giá (Reviews):* Nhận xét từ khách hàng đã mua (có hình ảnh).
- **Sản phẩm liên quan (Bottom Section):** Gợi ý các loại trà cùng phân khúc hoặc ấm chén phù hợp để pha loại trà đó.

### 🛒 3.3. Trang Giỏ hàng (Shopping Cart)
- **Danh sách sản phẩm:** Ảnh thu nhỏ, Tên sản phẩm, Phân loại, Giá đơn vị, Bộ đếm số lượng (+/-), Nút "Xóa" (Icon thùng rác).
- **Khu vực Tóm tắt đơn hàng (Order Summary):** 
  - Tạm tính.
  - Ô nhập Mã giảm giá (Voucher).
  - Phí vận chuyển (Tính toán tạm thời).
  - Tổng tiền (In đậm, to).
- **Nút Hành động:** 
  - "Tiếp tục mua sắm" (Outline button).
  - "Tiến hành thanh toán" (Primary button, màu xanh nổi bật).
- **Cross-sell:** Gợi ý "Mua thêm đồ ngọt ăn kèm" ngay dưới giỏ hàng để tăng giá trị đơn.

### 💳 3.4. Trang Thanh toán (Checkout Page)
*Áp dụng quy tắc "Distraction-free": Ẩn Header phức tạp, chỉ giữ lại Logo để khách tập trung hoàn tất thanh toán.*
- **Cột trái (Thông tin khách hàng & Vận chuyển):**
  - Form thông tin: Họ tên, Số điện thoại, Email.
  - Địa chỉ giao hàng (Tỉnh/Thành, Quận/Huyện, Phường/Xã, Địa chỉ cụ thể).
  - Phương thức vận chuyển (Giao hàng tiêu chuẩn, Giao hỏa tốc).
  - Ghi chú đơn hàng (Ví dụ: "Giao vào giờ hành chính", "Gói quà giúp mình").
- **Cột phải (Thông tin đơn hàng & Thanh toán):**
  - Tóm tắt lại danh sách SP trong giỏ (Có ảnh thu nhỏ).
  - Phương thức thanh toán (Thanh toán khi nhận hàng - COD, Chuyển khoản ngân hàng, Quét mã QR).
  - Tổng thanh toán cuối cùng.
  - Nút "Đặt hàng" (Lớn, tràn viền cột).

### 📖 3.5. Trang Bài viết / Kiến thức Trà (Blog Detail)
- **Tiêu đề bài viết:** Nổi bật, có ngày đăng & Tên tác giả (hoặc "Nghệ nhân trà").
- **Ảnh cover bài viết:** Chất lượng cao, liên quan đến chủ đề.
- **Nội dung bài viết (Body Content):** Phông chữ to dễ đọc, dãn dòng rộng (`line-height: 1.6`). Có chia Heading rõ ràng.
- **Sản phẩm liên kết:** Nếu bài viết nói về Trà Ô Long, tự động chèn widget sản phẩm Trà Ô Long vào giữa hoặc cuối bài để thúc đẩy mua bán.
- **Bài viết liên quan:** Đề xuất các bài viết khác cùng chuyên mục.
