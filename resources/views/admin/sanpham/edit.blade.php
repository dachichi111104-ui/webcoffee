@extends('admin.layout')
@section('title','Sửa sản phẩm')

@section('content')
<div class="coffee-card">
<h2>CẬP NHẬT THÔNG TIN SẢN PHẨM</h2>

<form method="POST"
      action="{{ route('admin.sanpham.update',$sanpham->idsp) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<select name="idloai" class="form-control mb-3">
@foreach($loaisp as $loai)
<option value="{{ $loai->idloai }}"
 @selected($sanpham->idloai==$loai->idloai)>
 {{ $loai->tenloai }}
</option>
@endforeach
</select>

<input name="tensp" class="form-control mb-3"
       value="{{ $sanpham->tensp }}">
<input name="gia" class="form-control mb-3"
       value="{{ $sanpham->gia }}">
<input name="soluong" class="form-control mb-3"
       value="{{ $sanpham->soluong }}">

<input type="file" name="hinhanh" class="form-control mb-3">

<textarea name="mota" class="form-control mb-3">
{{ $sanpham->mota }}
</textarea>

<div class="coffee-actions">
<button class="coffee-btn btn-coffee">CẬP NHẬT</button>
<a href="{{ route('admin.sanpham.index') }}"
   class="coffee-btn btn-cancel">HỦY</a>
</div>
</form>
</div>
@endsection
