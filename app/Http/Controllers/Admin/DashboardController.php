<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tongDonHang = DonHang::count();
        $tongDoanhThu = DonHang::sum('tongtien');
        return view('admin.dashboard', compact('tongDonHang', 'tongDoanhThu'));
    }

    public function statistics(Request $request)
    {
        $from = $request->from ?? now()->startOfMonth();
        $to = $request->to ?? now()->endOfMonth();

        $doanhThu = DonHang::whereBetween('ngaydat', [$from, $to])->sum('tongtien');
        $soDonHang = DonHang::whereBetween('ngaydat', [$from, $to])->count();

        return view('admin.statistics', compact('doanhThu', 'soDonHang', 'from', 'to'));
    }
}
