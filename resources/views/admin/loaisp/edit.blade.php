@extends('admin.layout')
@section('title','Sửa danh mục')

@section('content')
<div class="coffee-card">
    <h2>CẬP NHẬT THÔNG TIN DANH MỤC</h2>

    <form method="POST" action="{{ route('admin.loaisp.update',$loai->idloai) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tên danh mục</label>
            <input type="text" name="tenloai" class="form-control"
                   value="{{ $loai->tenloai }}" required>
        </div>

        <div class="coffee-actions">
            <button class="coffee-btn btn-coffee">CẬP NHẬT</button>
            <a href="{{ route('admin.loaisp.index') }}" class="coffee-btn btn-cancel">HỦY</a>
        </div>
    </form>
</div>
@endsection
