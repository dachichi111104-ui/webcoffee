<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ThongKeController extends Controller
{
    public function index(Request $request)
{
    $year = $request->input('year', date('Y'));
    $month = $request->input('month', null);
    $type = $request->input('type', 'ngay'); // ngày / tháng / năm

  // Base query cho chart và summary hợp lệ
$baseQuery = DonHang::whereIn('trangthaidonhang',['cho_xu_ly', 'dang_giao', 'hoan_thanh']);
if($year) $baseQuery->whereYear('ngaydat', $year);
if($month) $baseQuery->whereMonth('ngaydat', $month);

// --- Summary ---
$tongDon = (clone $baseQuery)->count();
$tongDoanhThu = (clone $baseQuery)->where('trangthaidonhang','hoan_thanh')->sum('tongtien');

// --- Số đơn theo trạng thái (tách riêng) ---
$donChoXuLy = DonHang::where('trangthaidonhang','cho_xu_ly')
    ->when($year, fn($q) => $q->whereYear('ngaydat',$year))
    ->when($month, fn($q) => $q->whereMonth('ngaydat',$month))
    ->count();

$dangGiao = DonHang::where('trangthaidonhang','dang_giao')
    ->when($year, fn($q) => $q->whereYear('ngaydat',$year))
    ->when($month, fn($q) => $q->whereMonth('ngaydat',$month))
    ->count();

$donHoanThanh = DonHang::where('trangthaidonhang','hoan_thanh')
    ->when($year, fn($q) => $q->whereYear('ngaydat',$year))
    ->when($month, fn($q) => $q->whereMonth('ngaydat',$month))
    ->count();

$donDaHuy = DonHang::where('trangthaidonhang','da_huy')
    ->when($year, fn($q) => $q->whereYear('ngaydat',$year))
    ->when($month, fn($q) => $q->whereMonth('ngaydat',$month))
    ->count();

$statusData = [
    'labels' => ['Chờ xử lý','Đang giao', 'Hoàn thành','Đã hủy'],
    'data' => [$donChoXuLy, $dangGiao, $donHoanThanh, $donDaHuy],
];


    // --- Thống kê theo thời gian ---
    switch($type){
        case 'thang':
            $thongKe = (clone $baseQuery)
                ->select(DB::raw("DATE_TRUNC('month', ngaydat) as time"),
                         DB::raw("COUNT(*) as sodon"),
                         DB::raw("SUM(tongtien) as doanhthu"))
                ->groupBy('time')->orderBy('time')->get();
            $labels = $thongKe->pluck('time')->map(fn($d)=>\Carbon\Carbon::parse($d)->format('m/Y'))->toArray();
            break;
        case 'nam':
            $thongKe = (clone $baseQuery)
                ->select(DB::raw("DATE_TRUNC('year', ngaydat) as time"),
                         DB::raw("COUNT(*) as sodon"),
                         DB::raw("SUM(tongtien) as doanhthu"))
                ->groupBy('time')->orderBy('time')->get();
            $labels = $thongKe->pluck('time')->map(fn($d)=>\Carbon\Carbon::parse($d)->format('Y'))->toArray();
            break;
        case 'ngay':
        default:
            $thongKe = (clone $baseQuery)
                ->select(DB::raw("DATE(ngaydat) as time"),
                         DB::raw("COUNT(*) as sodon"),
                         DB::raw("SUM(tongtien) as doanhthu"))
                ->groupBy('time')->orderBy('time')->get();
            $labels = $thongKe->pluck('time')->map(fn($d)=>\Carbon\Carbon::parse($d)->format('d/m'))->toArray();
            break;
    }

    $soDonData = $thongKe->pluck('sodon')->toArray();
    $doanhThuData = $thongKe->pluck('doanhthu')->toArray();

    $years = DonHang::selectRaw('EXTRACT(YEAR FROM ngaydat) as year')
        ->distinct()->orderBy('year','desc')->pluck('year')->toArray();

    $months = range(1,12);

    return view('admin.thongke.index', compact(
        'tongDon','tongDoanhThu','labels','soDonData','doanhThuData','type','year','month','years','months','statusData'
    ));
    }
}
