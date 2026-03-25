@extends('admin.auth')

@section('title', 'Admin Login')

@section('content')
<div class="admin-login-wrapper">
    <div class="admin-login-card">
        <div class="admin-close">&times;</div>
        <h2 class="admin-login-title">CHÀO BẠN</h2>
        <p class="admin-login-sub">
            Đăng nhập để quản lý quán cà phê
        </p>
        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-3">
                <input type="email"
                       name="emailadmin"
                       class="form-control admin-input"
                       placeholder="Email quản trị"
                       required>
            </div>
            <div class="mb-4">
                <input type="password"
                       name="passadmin"
                       class="form-control admin-input"
                       placeholder="Mật khẩu"
                       required>
            </div>
            <button type="submit" class="btn admin-login-btn w-100">
                Đăng nhập
            </button>
        </form>
    </div>
</div>
@endsection
