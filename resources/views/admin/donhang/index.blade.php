@extends('admin.layout')

@section('content')
<h2 class="section-title">Đơn hàng</h2>

<div class="coffee-search" style="margin-bottom:20px">
  <form method="GET" style="display:flex;gap:10px">
    <input type="text" name="keyword" placeholder="Tên người nhận..." value="{{ request('keyword') }}">
    <select name="status">
      <option value="">-- Trạng thái --</option>
      <option value="cho_xu_ly" @selected(request('status')=='cho_xu_ly')>Chờ xử lý</option>
      <option value="dang_giao" @selected(request('status')=='dang_giao')>Đang giao</option>
      <option value="hoan_thanh" @selected(request('status')=='hoan_thanh')>Hoàn thành</option>
      <option value="da_huy" @selected(request('status')=='da_huy')>Đã hủy</option>
    </select>
    <select name="payment">
  <option value="">-- Thanh toán --</option>
  <option value="tien_mat" @selected(request('payment')=='tien_mat')>Tiền mặt</option>
  <option value="chuyen_khoan" @selected(request('payment')=='chuyen_khoan')>Chuyển khoản</option>
  <option value="momo" @selected(request('payment')=='momo')>MoMo</option>
</select>

    <button class="pill-btn">Lọc</button>
  </form>
</div>

<div class="recent-orders">
@foreach($donhang as $dh)
  <div class="order-item">
    <div>
      <span class="order-id">#DH{{ $dh->iddonhang }}</span>
      <span class="payment-badge">
  {{ str_replace('_',' ', $dh->phuongthucthanhtoan) }}
</span>

      <div class="order-date">
        <i class="fa-regular fa-clock"></i>
        {{ $dh->ngaydat->format('d/m/Y H:i') }}
      </div>
   <div style="margin-top:6px;font-size:13px">
  <i class="fa-solid fa-user"></i> {{ $dh->tennguoinhan }} – {{ $dh->sodienthoainguoinhan }}
</div>

<div style="margin-top:4px;font-size:13px;color:#666">
  <i class="fa-solid fa-credit-card"></i> {{ str_replace('_',' ', $dh->phuongthucthanhtoan) }}
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
      <button class="btn-detail"
        onclick="toggleOrderDetail({{ $dh->iddonhang }})">
        Chi tiết
      </button>
    </div>
  </div>

  {{-- DETAIL --}}
  <div id="order-detail-{{ $dh->iddonhang }}" class="order-detail">
    @include('admin.donhang.partials.detail', ['donhang'=>$dh])
  </div>
@endforeach
</div>

{{ $donhang->links() }}
@endsection
