@extends('admin.layout')
@section('title','Sản phẩm')

@section('content')
<h2 class="coffee-title">DANH SÁCH SẢN PHẨM</h2>

<div class="mb-3 d-flex justify-content-between align-items-center">
    <form method="GET" action="{{ route('admin.sanpham.search') }}"
          class="coffee-search">
        <input type="text" name="keyword" placeholder="Tìm sản phẩm...">
        <button class="coffee-btn btn-search">Tìm kiếm</button>
    </form>

   {{-- FILTER BY CATEGORY --}}
<form method="GET"
      action="{{ route('admin.sanpham.filter') }}"
      class="coffee-filter">
    <select name="idloai" onchange="this.form.submit()">
        <option value="">-- Tất cả loại --</option>
        @foreach($loaisp as $loai)
            <option value="{{ $loai->idloai }}"
                {{ request('idloai') == $loai->idloai ? 'selected' : '' }}>
                {{ $loai->tenloai }}
            </option>
        @endforeach
    </select>
</form>

    
    <a href="{{ route('admin.sanpham.create') }}"
       class="coffee-btn btn-add">Thêm sản phẩm</a>
</div>

<table class="table table-bordered coffee-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Loại</th>
            <th>Giá</th>
            <th>SL</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sanpham as $sp)
        <tr>
            <td>{{ $sp->idsp }}</td>
            <td>
                @if($sp->hinhanh)
                    <img src="{{ asset('uploads/'.$sp->hinhanh) }}"
                         class="coffee-img">
                @endif
            </td>
            <td>{{ $sp->tensp }}</td>
            <td>{{ $sp->loai->tenloai ?? '---' }}</td>
            <td>{{ number_format($sp->gia) }}đ</td>
            <td>{{ $sp->soluong }}</td>
            <td>
                <a href="{{ route('admin.sanpham.edit',$sp->idsp) }}"
                   class="coffee-btn btn-edit">Cập nhật</a>

                <form method="POST"
                      action="{{ route('admin.sanpham.destroy',$sp->idsp) }}"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="coffee-btn btn-delete"
                        onclick="return confirm('Xoá sản phẩm?')">
                        Xoá
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
