<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DonHang;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('home', ['login' => 1]);

        // Lấy danh sách đơn hàng (có chi tiết sản phẩm)
        $donhangs = DonHang::with('chitiet.sanpham')
            ->where('idnguoidung', $user->idnguoidung)
            ->orderBy('ngaydat', 'desc')
            ->get();

        return view('user.dashboard', compact('user', 'donhangs'));
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'ten' => 'required|string|max:255',
            'sdt' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:password',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->ten = $request->ten;
        $user->sdt = $request->sdt;

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng'])
                    ->withInput()
                    ->with('stay', 'settings-account');
            }
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with([
            'success' => 'Cập nhật thông tin thành công',
            'stay' => 'settings-account'
        ]);
    }
}
