@extends('admin.layout')

@section('content')
<h2 class="section-title">Chi tiết đơn hàng #{{ $donhang->iddonhang }}</h2>

<!-- Nút quay lại danh sách đơn hàng người dùng -->
<a href="{{ route('admin.nguoidung.show', $donhang->idnguoidung) }}" class="pill-btn" style="margin-bottom:15px; display:inline-block;">
    <i class="fa-solid fa-arrow-left"></i> Quay lại
</a>

<!-- Thông tin đơn hàng -->
<div class="order-summary" style="margin-bottom:20px;">
    <div><i class="fa-regular fa-clock"></i> Ngày đặt: {{ $donhang->ngaydat->format('d/m/Y H:i') }}</div>
    <div><i class="fa-solid fa-credit-card"></i> Thanh toán: {{ str_replace('_',' ', $donhang->phuongthucthanhtoan) }}</div>
    <div style="font-weight:500; margin-top:6px;">Tổng tiền: {{ number_format($donhang->tongtien) }} đ</div>
</div>
<!-- Trạng thái đơn hàng -->
<div style="margin-top:15px; margin-bottom: 15px;">
    <span class="order-status
        @if($donhang->trangthaidonhang=='hoan_thanh') status-done
        @elseif($donhang->trangthaidonhang=='da_huy') status-cancel
        @else status-pending @endif">
        {{ str_replace('_',' ', $donhang->trangthaidonhang) }}
    </span>
</div>
<!-- Chi tiết sản phẩm -->
<h3>Chi tiết sản phẩm</h3>
<div class="recent-orders">
    @foreach($donhang->chitiet ?? [] as $ct)
        <div class="order-item">
            <div>
                <span>{{ $ct->sanpham->tensp }}</span>
                <div style="margin-top:4px;font-size:13px;color:#666">
                    Giá: {{ number_format($ct->dongia) }} đ – Số lượng: {{ $ct->soluong }}
                </div>
            </div>
            <div class="order-right">
                <div class="order-price">
                    {{ number_format($ct->dongia * $ct->soluong) }} đ
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
