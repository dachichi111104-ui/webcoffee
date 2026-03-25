<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;

class SanPhamController extends Controller
{
    public function index()
{
    $sanpham = SanPham::with('loai')->get();

    $menuData = $sanpham->map(function ($sp) {
        return [
            'id'       => $sp->idsp,
            'name'     => $sp->tensp,
            'price'    => (int) $sp->gia,
            'img'      => $sp->hinhanh,
            'category' => strtolower($sp->loai->slug ?? $sp->loai->tenloai),
        ];
    });

    return view('user.menu', compact('menuData'));
}
public function show($idsp)
{
    $product = SanPham::findOrFail($idsp);

    // lấy sản phẩm cùng loại
    $related = SanPham::where('idloai', $product->idloai)
        ->where('idsp', '!=', $product->idsp)
        ->limit(4)
        ->get();

    return view('user.show', compact('product', 'related'));
}


public function search(Request $request)
{
    $keyword = $request->q;

    $products = SanPham::where('tensp', 'ILIKE', "%{$keyword}%")
        ->orWhere('mota', 'ILIKE', "%{$keyword}%")
        ->orWhereHas('loai', function ($q) use ($keyword) {
            $q->where('tenloai', 'ILIKE', "%{$keyword}%");
        })
        ->paginate(12)
        ->withQueryString();

    return view('user.search', compact('products', 'keyword'));
}
}
