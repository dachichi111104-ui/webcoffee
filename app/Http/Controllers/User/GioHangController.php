<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GioHangController extends Controller
{
    public function index()
    {
        $cartItems = DB::table('giohang')
            ->join('sanpham', 'giohang.idsp', '=', 'sanpham.idsp')
            ->where('giohang.idnguoidung', Auth::id())
            ->select(
                'giohang.idsp',
                'giohang.soluong',
                'sanpham.tensp',
                'sanpham.gia',
                'sanpham.hinhanh'
            )
            ->get();

        return response()->json([
            'items' => $cartItems,
            'totalQuantity' => $cartItems->sum('soluong'),
            'totalMoney' => $cartItems->sum(fn ($i) => $i->gia * $i->soluong)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idsp' => 'required|integer'
        ]);

        $userId = Auth::id();
        $idsp = $request->idsp;

        $exists = DB::table('giohang')
            ->where('idnguoidung', $userId)
            ->where('idsp', $idsp)
            ->exists();

        if ($exists) {
            DB::table('giohang')
                ->where('idnguoidung', $userId)
                ->where('idsp', $idsp)
                ->increment('soluong');
        } else {
            DB::table('giohang')->insert([
                'idnguoidung' => $userId,
                'idsp' => $idsp,
                'soluong' => 1
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $idsp)
    {
        $request->validate([
            'soluong' => 'required|integer|min:1'
        ]);

        DB::table('giohang')
            ->where('idnguoidung', Auth::id())
            ->where('idsp', $idsp)
            ->update(['soluong' => $request->soluong]);

        return response()->json(['success' => true]);
    }

    public function destroy($idsp)
    {
        DB::table('giohang')
            ->where('idnguoidung', Auth::id())
            ->where('idsp', $idsp)
            ->delete();

        return response()->json(['success' => true]);
    }
}
