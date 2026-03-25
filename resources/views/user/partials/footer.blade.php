<footer class="footer">
  <div class="footer-container">
<div class="footer-col">
      <div class="footer-logo">
        <h2>SKY CHILL</h2>
        <span>COFFEE®</span>
      </div>
      <p class="footer-desc">
        Hương vị cà phê Việt Nam đích thực, được chắt lọc từ những hạt cà phê thượng hạng nhất vùng cao nguyên.
      </p>
      <div class="social-links">
        <a href="https://www.facebook.com/skychillcoffee">FB</a>
        <a href="https://www.instagram.com/skychillcoffee">IG</a>
        <a href="https://www.youtube.com/@SKYCHILLCOFFEE">YT</a>
      </div>
    </div>
    <div class="footer-col">
      <h3>Về Chúng Tôi</h3>
      <ul>
        <li><a href="{{ route('story') }}"class="{{ request()->routeIs('story') ? 'active' : '' }}">Câu chuyện thương hiệu</a></li>
        <li><a href="#">Tin tức & Sự kiện</a></li>
        <li><a href="#">Tuyển dụng</a></li>
        <li><a href="#">Liên hệ nhượng quyền</a></li>
      </ul>
    </div>
    <div class="footer-col">
  <h3>Hỗ Trợ</h3>
  <ul>
    <li><a href="#" class="footer-support-link" data-support="shipping">Chính sách giao hàng</a></li>
    <li><a href="#" class="footer-support-link" data-support="policy">Chính sách hỗ trợ</a></li>
    <li><a href="#" class="footer-support-link" data-support="privacy">Bảo mật thông tin</a></li>
  </ul>
</div>

    <div class="footer-col">
      <h3>Đăng Ký Nhận Tin</h3>
      <form class="newsletter-form">
        <input type="email" placeholder="Email của bạn...">
        <button type="submit">&#10140;</button>
      </form>
      <div class="contact-info">
<p><i class="fas fa-phone"></i> 1900 1234</p>
<p><i class="fas fa-envelope"></i> cskh@skychill.vn</p>

      </div>
    </div>  </div>
  <div class="footer-bottom">
    <p>&copy; {{ date('Y') }} Sky Chill Coffee. All rights reserved.</p>
  </div>
</footer>
