<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ===== ĐĂNG KÝ =====
   public function register(Request $request)
{
    $request->validate([
        'ten' => 'required|string|max:255',
        'email' => 'required|email|unique:nguoi_dung,email',
        'password' => 'required|min:6|confirmed',
        'sdt' => 'required',
    ], [
        'ten.required' => 'Vui lòng nhập họ tên',
        'email.unique' => 'Email đã tồn tại',
            'sdt.unique' => 'Số điện thoại đã tồn tại',
        'password.confirmed' => 'Mật khẩu nhập lại không khớp'
    ]);

    $user = NguoiDung::create([
        'ten'        => $request->ten,
        'email'        => $request->email,
        'password'     => Hash::make($request->password),
        'sdt'  => $request->sdt,
    ]);

    return redirect('/')
        ->with('showLogin', true)
        ->with('success', 'Đăng ký thành công');
}

    // ===== ĐĂNG NHẬP =====
  public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ], [
        'email.required' => 'Vui lòng nhập email hoặc số điện thoại',
        'password.required' => 'Vui lòng nhập mật khẩu'
    ]);

    $loginInput = $request->email; // ô input đang dùng chung

if (
    Auth::attempt(['email' => $loginInput, 'password' => $request->password]) ||
    Auth::attempt(['sdt'   => $loginInput, 'password' => $request->password])
) {
    $request->session()->regenerate();
    return redirect()->route('home')->with('success', 'Đăng nhập thành công');
}

    return back()
        ->withErrors(['login' => 'Email hoặc mật khẩu không đúng'])
        ->withInput();
}

    // ===== ĐĂNG XUẤT =====
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
