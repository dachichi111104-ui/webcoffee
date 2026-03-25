<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;

class DonHangController extends Controller
{
    public function index(Request $request)
    {
        $query = DonHang::with('nguoidung');

        // lọc trạng thái
        if ($request->filled('status')) {
            $query->where('trangthaidonhang', $request->status);
        }
        // lọc phương thức thanh toán
        if ($request->filled('payment')) {
        $query->where('phuongthucthanhtoan', $request->payment);
        }

        // tìm kiếm
       if ($request->filled('keyword')) {
    $keyword = strtolower($request->keyword);
    $query->where(function($q) use ($keyword) {
        $q->whereRaw('LOWER(iddonhang::text) LIKE ?', ["%{$keyword}%"])
          ->orWhereRaw('LOWER(tennguoinhan) LIKE ?', ["%{$keyword}%"])
          ->orWhereRaw('LOWER(sodienthoainguoinhan) LIKE ?', ["%{$keyword}%"])
          ->orWhereRaw('LOWER(diachinhanhang) LIKE ?', ["%{$keyword}%"]);
    });
}
        $donhang = $query
            ->orderByDesc('ngaydat')
            ->paginate(10);
        return view('admin.donhang.index', compact('donhang'));
    }

    // Xem chi tiết
    public function show($id)
    {
        $donhang = DonHang::with([
            'chitiet.sanpham',
            'nguoidung'
        ])->findOrFail($id);

        return view('admin.donhang.show', compact('donhang'));
    }

    // Cập nhật trạng thái
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'trangthaidonhang' => 'required|in:cho_xu_ly,dang_giao,hoan_thanh,da_huy'
        ]);
        $donhang = DonHang::findOrFail($id);
        $donhang->update([
            'trangthaidonhang' => $request->trangthaidonhang
        ]);
        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}
