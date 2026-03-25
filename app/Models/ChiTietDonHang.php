<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    protected $table = 'chitietdonhang';
    public $timestamps = false;

    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'iddonhang',
        'idsp',
        'soluong',
        'dongia'
    ];

    public function sanpham()
    {
        return $this->belongsTo(SanPham::class, 'idsp');
    }
}
