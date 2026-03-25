@extends('admin.layout')

@section('content')
<h2 class="section-title">
    Chi tiết người dùng #{{ $user->idnguoidung }}
</h2>

<!-- Nút quay lại -->
<a href="{{ route('admin.nguoidung.index') }}" class="pill-btn" style="margin-bottom:15px; display:inline-block;">
    <i class="fa-solid fa-arrow-left"></i> Quay lại
</a>

<div class="user-detail" style="margin-bottom:20px">
  <div style="font-size:16px"><i class="fa-solid fa-user"></i> Tên: {{ $user->ten }}</div>
  <div style="font-size:16px"><i class="fa-solid fa-envelope"></i> Email: {{ $user->email }}</div>
  <div style="font-size:16px"><i class="fa-solid fa-phone"></i> SĐT: {{ $user->sdt }}</div>
</div>

<h3>Đơn hàng của người dùng</h3>
<div class="recent-orders">
  @foreach($user->donHang as $dh)
    <!-- order-item là <a> luôn -->
    <a href="{{ route('admin.donhang.show', $dh->iddonhang) }}" class="order-item">
        <div>
          <span class="order-id">#DH{{ $dh->iddonhang }}</span>
          <div style="margin-top:4px;font-size:13px;color:#666">
            {{ str_replace('_',' ', $dh->phuongthucthanhtoan) }} – {{ number_format($dh->tongtien) }} đ
          </div>
        </div>
        <span class="order-status
          @if($dh->trangthaidonhang=='hoan_thanh') status-done
          @elseif($dh->trangthaidonhang=='da_huy') status-cancel
          @else status-pending @endif">
          {{ str_replace('_',' ', $dh->trangthaidonhang) }}
        </span>
    </a>
  @endforeach
</div>



@endsection
