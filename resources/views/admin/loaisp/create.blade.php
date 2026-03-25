@extends('admin.layout')
@section('title','Thêm danh mục')

@section('content')
<div class="coffee-card">
    <h2>THÊM DANH MỤC</h2>

    <form method="POST" action="{{ route('admin.loaisp.store') }}">
        @csrf
        <div class="mb-3">
            <label>Tên danh mục</label>
            <input type="text" name="tenloai" class="form-control" required>
        </div>

        <div class="coffee-actions">
            <button class="coffee-btn btn-coffee">THÊM</button>
            <a href="{{ route('admin.loaisp.index') }}" class="coffee-btn btn-cancel">HỦY</a>
        </div>
    </form>
</div>
@endsection
