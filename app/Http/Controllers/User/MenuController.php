<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SanPham;

class MenuController extends Controller
{
    public function index()
    {
        $products = SanPham::with('loai')
            ->where('soluong', '>', 0)
            ->get()
            ->map(function ($sp) {
                $category = '';
                if ($sp->loai) {
                    $category = match (strtolower($sp->loai->tenloai)) {
                        'coffee', 'cà phê' => 'coffee',
                        'tea', 'trà'      => 'tea',
                        'matcha'          => 'matcha',
                        'freeze' => 'freeze',
                        'milktea', 'trà sữa', 'milk tea', 'Milk Tea' => 'milktea',
                        default           => 'other',
                    };
                }
                return [
                    'id'       => $sp->idsp,
                    'name'     => $sp->tensp,
                    'price'    => (int) $sp->gia,
                    'img'      => $sp->hinhanh,
                    'category' => $category,
                ];
            });
        return view('user.menu', [
            'menuJson' => $products->toJson()
        ]);
    }
}

