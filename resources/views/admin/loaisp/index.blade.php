@extends('admin.layout')
@section('title','Danh mục')
@section('content')

<h2>DANH SÁCH DANH MỤC</h2>

<div class="mb-3 d-flex justify-content-between">
    <form method="GET" action="{{ route('admin.loaisp.search') }}" class="coffee-search">
        <input type="text" name="keyword" placeholder="Tìm kiếm danh mục">
        <button class="coffee-btn btn-search">Tìm kiếm</button>
    </form>
    <a href="{{ route('admin.loaisp.create') }}" class="coffee-btn btn-add">Thêm danh mục</a>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    @foreach($loaisp as $loai)
        <tr>
            <td>{{ $loai->idloai }}</td>
            <td>{{ $loai->tenloai }}</td>
            <td>
                <a href="{{ route('admin.loaisp.edit',$loai->idloai) }}" class="coffee-btn btn-edit">Cập nhật</a>
                <form method="POST" action="{{ route('admin.loaisp.destroy',$loai->idloai) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="coffee-btn btn-delete" onclick="return confirm('Xác nhận xoá?')">Xoá</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
