@extends('user.layout')

@section('page', 'user')

@section('title', 'Trang Người Dùng')

@section('content')

<div class="profile-layout">

  {{-- SIDEBAR --}}
  <aside class="profile-sidebar">
    <div class="user-card">
      <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=200"
           alt="Avatar"
           class="user-avatar">

      <h3 class="user-name">
  Xin chào, {{ Auth::user()->ten }}
</h3>


      <span class="user-rank">
        Thành viên
      </span>
    </div>

<nav class="profile-nav">

  <a href="#" class="nav-item active" data-section="overview">
    <i class="fa-solid fa-house"></i> Tổng quan
  </a>

  <a href="#" class="nav-item" data-section="orders">
    <i class="fa-solid fa-clock-rotate-left"></i> Lịch sử đơn hàng
  </a>

  {{-- SETTINGS PARENT --}}
  <div class="nav-item has-sub" data-toggle="settings">
    <i class="fa-solid fa-user-gear"></i>Cài đặt tài khoản
    <i class="fa-solid fa-chevron-down arrow"></i>
  </div>

  {{-- SUB MENU --}}
  <div class="nav-submenu" id="submenu-settings">
    <a href="#" class="sub-item" data-section="settings-account">Tài khoản</a>
    <a href="#" class="sub-item" data-section="settings-support">Hỗ trợ</a>
  </div>
   <form action="{{ route('auth.logout') }}" method="POST" class="logout-form">
  @csrf
  <button type="submit" class="btn-logout">
    <i class="fa-solid fa-arrow-right-from-bracket"></i>
    Đăng xuất
  </button>
</form>

</nav>

  </aside>

  {{-- CONTENT --}}
  <main class="profile-content">

  {{-- OVERVIEW --}}
@php
    // filter đơn đã hoàn thành
    $completedOrders = $donhangs->filter(fn($dh) => $dh->trangthaidonhang === 'hoan_thanh');

    // tổng tiền
    $totalSpent = $completedOrders->sum('tongtien');

    // tổng số ly đã đặt (tổng số lượng chi tiết)
    $totalCups = $completedOrders->sum(fn($dh) => $dh->chitiet->sum('soluong'));
@endphp

<section class="content-section active" id="section-overview">
    <h2>Tổng Quan Tài Khoản</h2>

    <div class="stats-grid">
      <div class="stat-card">
        <i class="fa-solid fa-coins"></i>
        <div>
          <h4>Tổng tiền đã chi</h4>
          <strong>{{ number_format($totalSpent) }} đ</strong>
        </div>
      </div>

      <div class="stat-card">
        <i class="fa-solid fa-mug-hot"></i>
        <div>
          <h4>Ly Đã Đặt</h4>
          <strong>{{ $totalCups }}</strong>
        </div>
      </div>
    </div>
</section>

<section class="content-section" id="section-orders">
  <h2>Lịch sử đơn hàng</h2>

  @if($donhangs->isEmpty())
    <p>Chưa có đơn hàng nào</p>
  @else
    <div class="recent-orders">
      @foreach($donhangs as $dh)
        <div class="order-item">
          <div>
            <span class="order-id">#DH{{ $dh->iddonhang }}</span>
            <div style="margin-top:4px;font-size:13px;color:#666">
              <i class="fa-solid fa-user"></i> {{ $dh->tennguoinhan }} – {{ $dh->sodienthoainguoinhan }}
            </div>
            <div style="margin-top:4px;font-size:13px;color:#666">
              <i class="fa-solid fa-location-dot"></i> {{ $dh->diachinhanhang }}
            </div>
            <div style="margin-top:4px;font-size:13px;color:#666">
              <i class="fa-solid fa-credit-card"></i> {{ $dh->phuongthucthanhtoan == 'tien_mat' ? 'Tiền mặt' : 'MoMo' }}
            </div>
        </div>
          <span class="order-status
            @if($dh->trangthaidonhang=='hoan_thanh') status-done
            @elseif($dh->trangthaidonhang=='da_huy') status-cancel
            @else status-pending @endif">
            {{ str_replace('_',' ', $dh->trangthaidonhang) }}
          </span>
          <div class="order-right">
            <div class="order-price">
              {{ number_format($dh->tongtien) }} đ
            </div>
            <button class="btn-detail" onclick="toggleOrderDetail({{ $dh->iddonhang }})">
              Chi tiết
            </button>
          </div>
        </div>

        {{-- DETAIL --}}
        <div class="order-detail" id="order-detail-{{ $dh->iddonhang }}">
          <div class="detail-info">
            <p><b>Người nhận:</b> {{ $dh->tennguoinhan }}</p>
            <p><b>SĐT:</b> {{ $dh->sodienthoainguoinhan }}</p>
            <p><b>Địa chỉ:</b> {{ $dh->diachinhanhang }}</p>
              <p><b>Ghi chú:</b> {{ $dh->ghichu ?? 'Không có' }}</p>
          </div>
          <div class="detail-products">
            @php $totalQty = 0; @endphp
            @foreach($dh->chitiet as $ct)
              @php $totalQty += $ct->soluong; @endphp
              <div class="detail-product">
                <img src="/uploads/{{ $ct->sanpham->hinhanh ?? 'no-image.png' }}">
                <div>
                  <h4>{{ $ct->sanpham->tensp }}</h4>
                  <p>{{ number_format($ct->dongia) }} đ × {{ $ct->soluong }}</p>
                </div>
              </div>
            @endforeach
          </div>
          <div class="detail-footer">
            <span>Tổng số lượng: <b>{{ $totalQty }}</b></span>
            <span>Tổng tiền: <b>{{ number_format($dh->tongtien) }} đ</b></span>
          </div>
          <div class="detail-actions">
            @if($dh->trangthaidonhang === 'cho_xu_ly')
              <button class="btn-cancel-order" onclick="cancelOrder({{ $dh->iddonhang }})">
                Hủy đơn hàng
              </button>
            @endif
          </div>
        </div>
      @endforeach
    </div>
  @endif
</section>


{{-- SETTINGS ACCOUNT --}}
<section class="content-section" id="section-settings-account">
  <h3 class="section-title">Tài khoản của tôi</h3>
  <form action="{{ route('user.profile.update') }}" method="POST" class="coffee-form" data-no-auth>
    @csrf
    @method('PUT')
    <div class="form-grid">
      <div class="form-group">
        <label>Họ tên</label>
        <input type="text" name="ten" value="{{ $user->ten }}" required>
      </div>
      <div class="form-group">
        <label>Số điện thoại</label>
        <input type="text" name="sdt" value="{{ $user->sdt }}">
      </div>
      <div class="form-group full">
        <label>Email</label>
        <input type="email" value="{{ $user->email }}" disabled>
      </div>
      <div class="form-divider"><span>Đổi mật khẩu</span></div>
      <div class="form-group">
        <label>Mật khẩu hiện tại</label>
        <input type="password" name="current_password" placeholder="••••••">
        @error('current_password')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group">
        <label>Mật khẩu mới</label>
        <input type="password" name="password" placeholder="Ít nhất 6 ký tự">
        @error('password')<div class="form-error">{{ $message }}</div>@enderror
      </div>
      <div class="form-group full">
        <label>Xác nhận mật khẩu mới</label>
        <input type="password" name="password_confirmation">
        @error('password_confirmation')<div class="form-error">{{ $message }}</div>@enderror
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn-coffee">Lưu thay đổi</button>
    </div>
  </form>
</section>

{{-- SETTINGS SUPPORT --}}
<section class="content-section" id="section-settings-support">
  <h3>Hỗ trợ khách hàng</h3>

  <div class="support-accordion">

    {{-- Item 1 --}}
    <div class="support-item" id="support-shipping">
      <button class="support-toggle">
        <span>Chính sách giao hàng</span>
        <i class="fa-solid fa-chevron-down arrow"></i>
      </button>
      <div class="support-content">
        <p>
          Sky Chill Coffee cam kết giao hàng nhanh chóng và an toàn. Thời gian giao hàng dự kiến từ 1–3 ngày tùy khu vực.<br>
          - Miễn phí giao hàng cho đơn từ 200.000₫ trở lên trong nội thành.<br>
          - Đơn hàng được chuẩn bị trong vòng 2 giờ sau khi thanh toán.<br>
          - Giao hàng tận nơi với dịch vụ chuyên nghiệp, đảm bảo sản phẩm không bị hư hỏng.<br>
          - Khách hàng được thông báo trạng thái đơn hàng qua SMS hoặc email.
        </p>
      </div>
    </div>

    {{-- Item 2 --}}
    <div class="support-item" id="support-policy">
      <button class="support-toggle">
        <span>Chính sách hỗ trợ</span>
        <i class="fa-solid fa-chevron-down arrow"></i>
      </button>
      <div class="support-content">
        <p>
          Chúng tôi luôn sẵn sàng hỗ trợ khách hàng 24/7.<br>
          - Mọi thắc mắc về sản phẩm, đơn hàng, voucher đều được trả lời nhanh chóng qua hotline hoặc email.<br>
          - Khiếu nại, đổi/trả hàng sẽ được xử lý trong vòng 24 giờ kể từ khi nhận thông tin.<br>
          - Hỗ trợ trực tiếp tại cửa hàng nếu có vấn đề khi nhận đơn.<br>
          - Khách hàng sẽ được hoàn tiền đầy đủ hoặc đổi sản phẩm nếu xảy ra lỗi từ phía chúng tôi.
        </p>
      </div>
    </div>

    {{-- Item 3 --}}
    <div class="support-item" id="support-privacy">
      <button class="support-toggle">
        <span>Bảo mật thông tin</span>
        <i class="fa-solid fa-chevron-down arrow"></i>
      </button>
      <div class="support-content">
        <p>
          Sky Chill Coffee coi trọng quyền riêng tư và bảo mật thông tin khách hàng.<br>
          - Mọi thông tin cá nhân đều được bảo mật tuyệt đối.<br>
          - Chúng tôi không chia sẻ dữ liệu khách hàng với bên thứ ba.<br>
          - Thanh toán trực tuyến được mã hóa theo chuẩn bảo mật quốc tế (SSL).<br>
          - Khách hàng có quyền yêu cầu xóa thông tin cá nhân bất kỳ lúc nào.
        </p>
      </div>
    </div>

  </div>
</section>

      </div>
    </div>
  </section>
@if (session('success'))
<div class="toast toast-success" id="toast-success">
  <i class="fa-solid fa-circle-check"></i>
  <span>{{ session('success') }}</span>
</div>
@endif



</main>


@endsection
