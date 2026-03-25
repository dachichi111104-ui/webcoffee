<div class="detail-info">
  <p><strong>Người nhận:</strong> {{ $donhang->nguoidung->ten ?? 'Guest' }}</p>
  <p><strong>Địa chỉ:</strong> {{ $donhang->diachinhanhang }}</p>
  <p><strong>Ghi chú:</strong> {{ $donhang->ghichu ?? 'Không có' }}</p>
</div>

<div class="detail-products">
@foreach($donhang->chitiet as $ct)
  <div class="detail-product">
    <img src="/uploads/{{ $ct->sanpham->hinhanh ?? 'no-image.png' }}">
    <div>
      <strong>{{ $ct->sanpham->tensp }}</strong><br>
      SL: {{ $ct->soluong }} × {{ number_format($ct->dongia) }} đ
    </div>
  </div>
@endforeach
</div>

<div class="detail-footer">
  <span>Tổng:</span>
  <span>{{ number_format($donhang->tongtien) }} đ</span>
</div>

<form class="detail-actions"
      method="POST"
      action="{{ route('admin.donhang.status',$donhang->iddonhang) }}">
  @csrf
  <select name="trangthaidonhang">
    <option value="cho_xu_ly">Chờ xử lý</option>
    <option value="dang_giao">Đang giao</option>
    <option value="hoan_thanh">Hoàn thành</option>
    <option value="da_huy">Đã hủy</option>
  </select>
  <button class="pill-btn">Cập nhật</button>
</form>
