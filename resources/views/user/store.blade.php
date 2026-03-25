@extends('user.layout')

@section('title', 'Sky Chill Coffee - Tinh Hoa Đất Việt')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

<section class="store-layout">

  <aside class="store-sidebar">
    <h1 class="sidebar-title">Góc Quen</h1>

    <div class="store-list-container">

      <div class="store-item active" onclick="updateMap('220 Nguyễn Văn Lượng, Phường 17, Gò Vấp, Hồ Chí Minh', this)">
        <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?q=80&w=600" class="store-img" alt="Store Park">

        <div class="store-info">
          <div class="store-name">Sky Chill Signature</div>
          <div class="store-address">220 Nguyễn Văn Lượng, P.17, Gò Vấp, TP.HCM</div>

          <div class="store-meta-row">
            <span class="store-time">07:00 - 22:00</span>
            <span class="store-status status-open">Đang mở cửa</span>
          </div>

          <a href="https://www.google.com/maps/search/?api=1&query=220+Nguyen+Van+Luong+Go+Vap" target="_blank" class="btn-pill">
            Chỉ đường
          </a>
        </div>
      </div>

      <div class="store-item" onclick="updateMap('415 Trường Chinh, Phường 14, Tân Bình, Hồ Chí Minh', this)">
        <img src="https://images.unsplash.com/photo-1521017432531-fbd92d768814?q=80&w=600" class="store-img" alt="Store Hideout">

        <div class="store-info">
          <div class="store-name">Sky Chill Hideout</div>
          <div class="store-address">415 Trường Chinh, P.14, Tân Bình, TP.HCM</div>

          <div class="store-meta-row">
            <span class="store-time">07:00 - 22:30</span>
            <span class="store-status status-open">Đang mở cửa</span>
          </div>

          <a href="https://www.google.com/maps/search/?api=1&query=415+Truong+Chinh+Tan+Binh" target="_blank" class="btn-pill">
            Chỉ đường
          </a>
        </div>
      </div>

    </div>
  </aside>

  <main class="store-map">
    <iframe class="map-iframe"
            id="google-map"
            src="https://maps.google.com/maps?q=220%20Nguy%E1%BB%85n%20V%C4%83n%20L%C6%B0%E1%BB%A3ng%2C%20G%C3%B2%20V%E1%BA%A5p&t=&z=16&ie=UTF8&iwloc=&output=embed"
            allowfullscreen=""
            loading="lazy">
    </iframe>
  </main>
</section>
