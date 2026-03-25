@extends('user.layout')

@section('content')
<section class="menu-section product-detail">
<button class="btn-back-page" onclick="goBackPage()">
  ← Quay lại
</button>
  <div class="product-detail-wrapper">
    {{-- ẢNH --}}
    <div class="product-img-box">
      <img src="/uploads/{{ $product->hinhanh }}"
           onerror="this.src='/uploads/no-image.png'">
    </div>

    {{-- INFO --}}
    <div class="product-info-box">
      <h2>{{ $product->tensp }}</h2>

      <div class="product-price">
        {{ number_format($product->gia) }} đ
      </div>

      @if($product->mota)
        <p class="product-desc">{{ $product->mota }}</p>
      @endif

      <button class="add-btn big"
              onclick="addToCart({{ $product->idsp }}, this)">
        THÊM VÀO GIỎ
      </button>
    </div>
  </div>

  {{-- SẢN PHẨM LIÊN QUAN --}}
  @if($related->count())
  <div class="menu-header" style="margin-top:60px;">
    <h2>Món cùng loại</h2>
  </div>

  <div class="menu-grid">
    @foreach($related as $sp)
      <div class="menu-item">
        <div class="item-img-box">
          <a href="{{ route('products.show', $sp->idsp) }}">
            <img src="/uploads/{{ $sp->hinhanh }}"
                 onerror="this.src='/uploads/no-image.png'">
          </a>
        </div>

        <div class="item-info">
          <h4>{{ $sp->tensp }}</h4>
          <div class="price">{{ number_format($sp->gia) }} đ</div>
          <button class="add-btn"
                  onclick="addToCart({{ $sp->idsp }}, this)">
            THÊM
          </button>
        </div>
      </div>
    @endforeach
  </div>
  @endif

</section>
@endsection
