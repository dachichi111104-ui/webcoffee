@extends('admin.layout')

@section('content')
<h2 class="section-title">Người dùng</h2>

<div class="coffee-search" style="margin-bottom:20px">
  <form method="GET" style="display:flex;gap:10px">
    <input type="text" name="keyword" placeholder="Tên người dùng..." value="{{ request('keyword') }}">
    <button class="pill-btn">Tìm kiếm</button>
  </form>
</div>

<div class="recent-orders">
  @foreach($users as $user)
    <a href="{{ route('admin.nguoidung.show', $user->idnguoidung) }}" class="order-item">
      <div>
        <span class="order-id">#{{ $user->idnguoidung }}</span>
        <div style="margin-top:6px;font-size:13px">
          <i class="fa-solid fa-user"></i> {{ $user->ten }}
        </div>
        <div style="margin-top:4px;font-size:13px;color:#666">
          <i class="fa-solid fa-envelope"></i> {{ $user->email }}
        </div>
        <div style="margin-top:2px;font-size:13px;color:#666">
          <i class="fa-solid fa-phone"></i> {{ $user->sdt }}
        </div>
      </div>
      <div class="order-right">
        <div class="order-count">
          {{ $user->donHang->count() }} đơn
        </div>
      </div>
    </a>
  @endforeach
</div>

{{ $users->links() }}
@endsection
