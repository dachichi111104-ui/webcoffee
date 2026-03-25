<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Hiển thị form login
    public function loginForm()
    {
        return view('admin.login');
    }
    // Xử lý login
    public function login(Request $request)
    {
        $request->validate([
            'emailadmin' => 'required|email',
            'passadmin'  => 'required'
        ]);
        $credentials = [
            'emailadmin' => $request->emailadmin,
            'password'   => $request->passadmin
        ];
        if (Auth::guard('admin')->attempt($credentials)) {
            // Login thành công
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error','Email hoặc mật khẩu không đúng');
    }

    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
