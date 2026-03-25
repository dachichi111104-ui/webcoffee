@extends('user.layout')

@section('title', 'Sky Chill Coffee - Tinh Hoa Đất Việt')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

{{-- HERO SLIDER --}}
<section class="hero" id="hero">
  <div class="hero-track" id="heroTrack"></div>

  <div class="hero-dots" id="heroDots"></div>
  <button class="hero-arrow left" id="heroPrev">&#10094;</button>
  <button class="hero-arrow right" id="heroNext">&#10095;</button>
</section>



{{-- STORY --}}
<section class="story-section">

  <div class="story-row">
    <div class="story-content">
      <h3>Bản Lĩnh Trong Từng Giọt Đắng</h3>
      <h2>Gu Đậm Đúng Chất - Tỉnh Táo Đúng Tầm</h2>
      <p>
        Chúng tôi tin rằng, một tách cà phê "chuẩn gu" không chỉ là thức uống, đó là tuyên ngôn của phong cách sống.
      </p>
      <button class="btn-primary"
              onclick="window.location.href='{{ route('menu') }}'">
        Khám Phá Gu Của Bạn
      </button>
    </div>
    <div class="story-image">
      <img src="{{ asset('uploads/content-1.jpg') }}" alt="Cà phê chuẩn gu">
    </div>
  </div>

  <div class="story-row reverse">
    <div class="story-content">
      <h3>Nơi Cảm Xúc Được Vỗ Về</h3>
      <h2>Trạm Sạc Năng Lượng Giữa Phố Thị</h2>
      <p>
        Sky Chill Coffee – nơi bạn tạm dừng để nạp lại năng lượng.
      </p>
      <button class="btn-primary"
              onclick="window.location.href='{{ route('store') }}'">
        Tìm Góc Trú Ẩn
      </button>
    </div>
    <div class="story-image">
      <img src="{{ asset('uploads/content-2.jpg') }}" alt="Không gian chill">
    </div>
  </div>

  <div class="story-row">
    <div class="story-content">
      <h3>Sự Tử Tế Trong Từng Chiết Xuất</h3>
      <h2>Những Câu Chuyện Kể Bằng Hương Vị</h2>
      <p>
        Mỗi hạt cà phê là một câu chuyện.
      </p>
      <button class="btn-primary"
              onclick="window.location.href='{{ route('story') }}'">
        Đọc Tiếp Hành Trình
      </button>
    </div>
    <div class="story-image">
      <img src="{{ asset('uploads/content-3.jpg') }}" alt="Barista pha chế">
    </div>
  </div>

</section>

@endsection
