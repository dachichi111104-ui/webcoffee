<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;

class DonHangController extends Controller
{
    // Xử lý checkout / đặt hàng
   public function store(Request $request)
{
    $request->validate([
        'tennguoinhan' => 'required|string|max:255',
        'sdt' => 'required|string|max:20',
        'diachi' => 'required|string|max:500',
        'payment' => 'required|in:tien_mat,chuyen_khoan,momo',
        'ghichu' => 'nullable|string|max:1000'
    ]);

    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'Chưa đăng nhập'
        ], 401);
    }

$userId = Auth::id();
    try {
        DB::beginTransaction();

        // Lấy giỏ hàng
        $cartItems = DB::table('giohang')
            ->join('sanpham', 'giohang.idsp', '=', 'sanpham.idsp')
            ->where('giohang.idnguoidung', $userId)
            ->select('giohang.*', 'sanpham.gia')
            ->get();

        if ($cartItems->isEmpty()) {
            throw new \Exception('Giỏ hàng trống');
        }

        $tongTien = $cartItems->sum(fn ($i) => $i->gia * $i->soluong);

        // Tạo đơn hàng
        $donHang = DonHang::create([
            'idnguoidung' => $userId,
            'tongtien' => $tongTien,
            'tennguoinhan' => $request->tennguoinhan,
            'sodienthoainguoinhan' => $request->sdt,
            'diachinhanhang' => $request->diachi,
            'ghichu' => $request->ghichu,
            'phuongthucthanhtoan' => $request->payment,
            'trangthaidonhang' => 'cho_xu_ly',
            'ngaydat' => now()
        ]);

        // 4️⃣ Chi tiết đơn hàng
        foreach ($cartItems as $item) {
            ChiTietDonHang::create([
                'iddonhang' => $donHang->iddonhang,
                'idsp' => $item->idsp,
                'soluong' => $item->soluong,
                'dongia' => $item->gia
            ]);
        }

        // 5️⃣ Xóa giỏ hàng
        DB::table('giohang')
            ->where('idnguoidung', $userId)
            ->delete();

        DB::commit();

        return response()->json([
            'success' => true,
            'redirect' => route('user.dashboard') . '#section-orders'
        ]);

    } catch (\Throwable $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
public function cancel($id)
    {
        $user = Auth::user();
        $order = DonHang::where('iddonhang', $id)
            ->where('idnguoidung', $user->idnguoidung)
            ->first();
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng không tồn tại'
            ]);
        }
        if ($order->trangthaidonhang !== 'cho_xu_ly') {
            return response()->json([
                'success' => false,
                'message' => 'Đơn hàng không thể hủy'
            ]);
        }
        $order->trangthaidonhang = 'da_huy';
        $order->save();

        return response()->json([
            'success' => true
        ]);
    }
}