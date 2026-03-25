@extends('user.layout')

@section('content')
<section class="menu-section" id="menuTarget">
  <div class="menu-header">
    <h2>Kết quả tìm kiếm</h2>
    <p>Từ khóa: <strong>"{{ $keyword }}"</strong></p>
  </div>

  @if($products->count() === 0)
    <p style="text-align:center;">Không tìm thấy sản phẩm phù hợp</p>
  @else
  <div class="menu-grid">
    @foreach($products as $sp)
     <div class="menu-item" data-link="{{ route('products.show', $sp->idsp) }}">
  <div class="item-img-box">
    <img src="/uploads/{{ $sp->hinhanh }}"
         onerror="this.src='/uploads/no-image.png'">
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

  <div class="pagination">
    {{ $products->links() }}
  </div>
  @endif
</section>
@endsection
