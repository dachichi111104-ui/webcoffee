@extends('user.layout')

@section('title', 'Sky Chill Coffee - Tinh Hoa Đất Việt')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<section class="hero-wrapper">
  <div class="hero-title-box">
    <h1>BẠN THUỘC TEAM NÀO?</h1>
    <p>Chọn phe ngay</p>
  </div>

  <div class="cards-container">
    <div class="social-card card-coffee" onclick="scrollToMenu('coffee')">
      <div class="card-header">
        <div class="user-info">
          <img src="uploads/coffee.png" class="avatar" alt="Ava">
          <div class="meta">
            <h4>skychill_coffee</h4>
            <span>Sài Gòn</span>
          </div>
        </div>
        <i class="fa-solid fa-ellipsis"></i>
      </div>
      <div class="card-body"><div class="layer-bg bg-coffee"></div></div>
      <div class="cup-wrapper"><img src="uploads/coffee.png" class="layer-cup" alt="Coffee Cup"></div>
      <div class="card-footer">
        <div class="action-icons">
          <i class="fa-regular fa-heart"></i>
          <i class="fa-regular fa-comment"></i>
          <i class="fa-regular fa-paper-plane"></i>
          <i class="fa-regular fa-bookmark"></i>
        </div>
        <h3 class="card-label">Cà Phê</h3>
      </div>
    </div>

    <div class="social-card card-tea" onclick="scrollToMenu('matcha')">
      <div class="card-header">
        <div class="user-info">
          <img src="uploads/tea.png" class="avatar" alt="Ava">
          <div class="meta">
            <h4>skychill_matcha</h4>
            <span>Sài Gòn</span>
          </div>
        </div>
        <i class="fa-solid fa-ellipsis"></i>
      </div>
      <div class="card-body"><div class="layer-bg bg-tea"></div></div>
      <div class="cup-wrapper"><img src="uploads/tea.png" class="layer-cup" alt="Matcha Cup"></div>
      <div class="card-footer">
        <div class="action-icons">
          <i class="fa-regular fa-heart"></i>
          <i class="fa-regular fa-comment"></i>
          <i class="fa-regular fa-paper-plane"></i>
          <i class="fa-regular fa-bookmark"></i>
        </div>
        <h3 class="card-label">Matcha</h3>
      </div>
    </div>
  </div>
</section>

<section class="menu-section" id="menuTarget">
  <div class="menu-header">
    <h2 style="font-family: var(--font-heading); font-size: 2.5rem; color: #4D301A;">Danh Sách Món</h2>
    <div class="menu-tabs">
      <div class="tab-btn active" data-type="all" onclick="filterMenu('all')">TẤT CẢ</div>
      <div class="tab-btn" data-type="coffee" onclick="filterMenu('coffee')">COFFEE</div>
      <div class="tab-btn" data-type="tea" onclick="filterMenu('tea')">TEA</div>
      <div class="tab-btn" data-type="matcha" onclick="filterMenu('matcha')">MATCHA</div>
      <div class="tab-btn" data-type="freeze" onclick="filterMenu('freeze')">FREEZE</div>
      <div class="tab-btn" data-type="milktea" onclick="filterMenu('milktea')">MILK TEA</div>

    </div>
  </div>
  <div class="menu-grid" id="menuGrid"></div>
</section>
<script>
    window.menuData = @json($menuData);
</script>

<script>
const menuData = window.menuData || [];

if (window.gsap && window.ScrollToPlugin) {
  gsap.registerPlugin(ScrollToPlugin);
}
  const grid = document.getElementById('menuGrid');
  const title = document.querySelector('.menu-header h2');
  const tabs = document.querySelectorAll('.tab-btn');
  const bannerSection = document.querySelector('.hero-wrapper');

  window.scrollToMenu = function(type) {
    filterMenu(type);
  };

window.filterMenu = function(type) {
  // 1. ACTIVE TAB
  tabs.forEach(tab => tab.classList.remove('active'));
  const activeTab = document.querySelector(`.tab-btn[data-type="${type}"]`);
  if (activeTab) activeTab.classList.add('active');

  // 2. ĐỔI TIÊU ĐỀ
  const titleMap = {
    all: 'Danh Sách Món',
    coffee: 'Cà Phê',
    tea: 'Trà',
    matcha: 'Matcha',
    freeze: 'Freeze',
    milktea: 'Milk Tea'
  };
  title.innerText = titleMap[type] || 'Danh Sách Món';

  // 3. FILTER DATA
  const filtered =
    type === 'all'
      ? menuData
      : menuData.filter(i => i.category.replace(/\s+/g,'').toLowerCase() === type);

  // 4. RENDER
  grid.innerHTML = '';

  filtered.forEach(item => {
    grid.insertAdjacentHTML('beforeend', `
  <div class="menu-item" data-link="/products/${item.id}">
    <div class="item-img-box">
      <img src="/uploads/${item.img}">
    </div>

    <div class="item-info">
      <h4>${item.name}</h4>
      <div class="price">${item.price.toLocaleString()} đ</div>

      <button class="add-btn"
              onclick="addToCart(${item.id}, this)">
        THÊM
      </button>
    </div>
  </div>
`);


  });

  // 5. SCROLL ĐẸP
  if (window.gsap && window.ScrollToPlugin) {
    gsap.to(window, {
      duration: 0.6,
      scrollTo: '#menuTarget'
    });
  }
};

document.addEventListener('DOMContentLoaded', () => {
  filterMenu('all');
});

</script>
