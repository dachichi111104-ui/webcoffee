<header class="header">
  <a href="{{ route('home') }}" class="header-logo">
    <h2>SKY CHILL</h2>
    <span>COFFEE®</span>
  </a>

  <nav class="header-nav">
    <a href="{{ route('menu') }}"class="{{ request()->routeIs('menu') ? 'active' : '' }}">Thực Đơn</a>
    <a href="{{ route('story') }}"class="{{ request()->routeIs('story') ? 'active' : '' }}">Câu Chuyện</a>
    <a href="{{ route('store') }}"class="{{ request()->routeIs('store') ? 'active' : '' }}">Cửa Hàng</a>
  </nav>
@if(auth()->check())
  <h3 class="users-name">
    Xin chào, {{ auth()->user()->ten }}
  </h3>
@endif

  <div class="header-actions">
    <div class="search-box">
      <input type="text" class="search-input" placeholder="Tìm món yêu thích...">
      <button class="icon-btn search-btn">
        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
      </button>
    </div>

    <a href="{{ auth()->check() ? route('user.dashboard') : '#' }}" class="icon-btn" onclick="{{ auth()->check() ? '' : 'openAuth()' }}">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"></path>
  </svg>
</a>


    <button class="icon-btn cart-btn" onclick="toggleCart()">
      <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
  <span id="cartBadge" class="cart-badge">0</span>

    </button>

  </div>
</header>
