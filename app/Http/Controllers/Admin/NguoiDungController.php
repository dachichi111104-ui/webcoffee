<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NguoiDung;

class NguoiDungController extends Controller
{
    public function index(Request $request)
    {
        $query = NguoiDung::query();

     if ($request->filled('keyword')) {
    $keyword = strtolower($request->keyword);
    $query->where(function($q) use ($keyword) {
        $q->whereRaw('LOWER(idnguoidung::text) LIKE ?', ["%{$keyword}%"])
          ->orWhereRaw('LOWER(ten) LIKE ?', ["%{$keyword}%"])
          ->orWhereRaw('LOWER(sdt) LIKE ?', ["%{$keyword}%"])
          ->orWhereRaw('LOWER(email) LIKE ?', ["%{$keyword}%"]);
    });
    }

        $users = $query->orderBy('idnguoidung', 'desc')->paginate(20);

        return view('admin.nguoidung.index', compact('users'));
    }

    // Trang chi tiết người dùng
    public function show($id)
    {
        $user = NguoiDung::with('donHang')->findOrFail($id);
        return view('admin.nguoidung.show', compact('user'));
    }
}
