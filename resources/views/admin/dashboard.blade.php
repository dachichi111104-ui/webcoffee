@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')

{{-- CONTENT --}}

    <div class="admin-header">
        <h2>Quản trị quán cà phê</h2>

        {{-- Logout chuẩn --}}
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                Đăng xuất
            </button>
        </form>
    </div>

    <div class="dashboard-cards">

        <a href="{{ route('admin.dashboard') }}"
           class="dashboard-card {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <h4>Trang chủ</h4>
            <p>Tổng quan hệ thống</p>
        </a>

        <a href="{{ route('admin.loaisp.index') }}"
           class="dashboard-card">
            <h4>Danh mục</h4>
            <p>Quản lý menu</p>
        </a>

        <a href="{{ route('admin.sanpham.index') }}"
           class="dashboard-card">
            <h4>Sản phẩm</h4>
            <p>Cà phê & đồ uống</p>
        </a>

        <a href="{{ route('admin.donhang.index') }}"
           class="dashboard-card">
            <h4>Đơn hàng</h4>
            <p>Theo dõi bán hàng</p>
        </a>

        <a href="{{ route('admin.nguoidung.index') }}"
           class="dashboard-card">
            <h4>Người dùng</h4>
            <p>Khách hàng</p>
        </a>

        <a href="{{ route('admin.thongke.index') }}"
           class="dashboard-card">
            <h4>Thống kê</h4>
            <p>Thống kê doanh thu</p>
        </a>
    </div>

</div>
@endsection
