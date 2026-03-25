@extends('admin.layout')
@section('title','Thêm sản phẩm')

@section('content')
<div class="coffee-card">
<h2>THÊM SẢN PHẨM</h2>

@if ($errors->any())
<div style="background:#f8d7da;padding:12px;border-radius:10px;margin-bottom:15px">
    @foreach ($errors->all() as $error)
        <div style="color:#721c24">⚠ {{ $error }}</div>
    @endforeach
</div>
@endif

<form method="POST"
      action="{{ route('admin.sanpham.store') }}"
      enctype="multipart/form-data">
@csrf

<select name="idloai" class="form-control mb-3">
@foreach($loaisp as $loai)
    <option value="{{ $loai->idloai }}">{{ $loai->tenloai }}</option>
@endforeach
</select>

<input name="tensp" class="form-control mb-3" placeholder="Tên sản phẩm">

<input type="number" name="gia" class="form-control mb-3" placeholder="Giá">

<input type="number" name="soluong" class="form-control mb-3" placeholder="Số lượng">

<input type="file" name="hinhanh" class="form-control mb-3">

<textarea name="mota" class="form-control mb-3" placeholder="Mô tả"></textarea>

<div class="coffee-actions">
<button class="coffee-btn btn-coffee">THÊM</button>
<a href="{{ route('admin.sanpham.index') }}"
   class="coffee-btn btn-cancel">HỦY</a>
</div>
</form>
</div>
@endsection
