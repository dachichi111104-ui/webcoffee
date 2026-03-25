<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="admin-wrapper">

    {{-- SIDEBAR --}}
    <div class="admin-sidebar">
        <div class="admin-logo">Sky Chill</div>

        <div class="admin-menu">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Trang chủ</a>
            <a href="{{ route('admin.loaisp.index') }}"class="{{ request()->routeIs('admin.loaisp.*') ? 'active' : '' }}">Danh mục</a>
            <a href="{{ route('admin.sanpham.index') }}"class="{{ request()->routeIs('admin.sanpham.*') ? 'active' : '' }}">Sản phẩm</a>
            <a href="{{ route('admin.donhang.index') }}"class="{{ request()->routeIs('admin.donhang.*') ? 'active' : '' }}">Đơn hàng</a>
            <a href="{{ route('admin.nguoidung.index') }}"class="{{ request()->routeIs('admin.nguoidung.*') ? 'active' : '' }}">Khách hàng</a>
            <a href="{{ route('admin.thongke.index') }}"class="{{ request()->routeIs('admin.thongke.*') ? 'active' : '' }}">Thống kê</a>
        </div>

        <div class="sidebar-footer">
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="logout-btn">
            Đăng xuất
        </button>
    </form>
</div>

    </div>

    {{-- MAIN CONTENT --}}
    <div class="admin-content">
        @yield('content')
    </div>

</div>
    <script src="{{ asset('js/admin.js') }}"></script>
@yield('scripts')

</body>
</html>
