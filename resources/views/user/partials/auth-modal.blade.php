<div id="authModal" class="auth-overlay">
  <div class="auth-box">
    <span class="auth-close">&times;</span>
  <div class="auth-scroll">
    <div id="loginView" class="auth-view">
      <div class="auth-header">
        <h2>Chào Bạn,</h2>
        <p>Đăng nhập để tích điểm và nhận ưu đãi riêng</p>
      </div>
      <form method="POST" action="{{ route('login') }}" class="auth-form">
  @csrf
    @if ($errors->has('login'))
    <div class="alert-error">
      {{ $errors->first('login') }}
    </div>
  @endif
  <input type="text" name="email" placeholder="Số điện thoại / Email">
  <input type="password" name="password" placeholder="Mật khẩu">
  <button type="submit" class="btn-auth">ĐĂNG NHẬP</button>
</form>

      <div class="auth-switch">
        Chưa có tài khoản? <span onclick="switchAuth('register')">Đăng ký ngay</span>
      </div>
    </div>

    <div id="registerView" class="auth-view hidden">
      <div class="auth-header">
        <h2>Thành Viên Mới</h2>
        <p>Gia nhập gia đình Sky Chill Coffee</p>
      </div>
<form method="POST" action="{{ route('register') }}" class="auth-form">
  @csrf
  @if ($errors->any())
  <div class="alert-error">
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach
  </div>
@endif
  <input type="text" name="ten" placeholder="Họ và tên">
  <input type="text" name="sdt" placeholder="Số điện thoại">
  <input type="email" name="email" placeholder="Email">
  <input type="password" name="password" placeholder="Mật khẩu">
  <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
  <button type="submit" class="btn-auth">ĐĂNG KÝ</button>
</form>


      <div class="auth-switch">
        Đã có tài khoản? <span onclick="switchAuth('login')">Đăng nhập</span>
      </div>
    </div>
</div>
@if ($errors->any())
<script>
  document.addEventListener("DOMContentLoaded", function () {
    openAuth();

    @if(old('ten') || old('sdt'))
      switchAuth('register');
    @else
      switchAuth('login');
    @endif
  });
</script>
@endif

  </div>
</div>