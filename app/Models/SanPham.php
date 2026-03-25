<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'sanpham';
    protected $primaryKey = 'idsp';

    protected $fillable = [
        'idloai','tensp','gia',
        'soluong','hinhanh','mota'
    ];

    public function loai()
    {
        return $this->belongsTo(LoaiSP::class, 'idloai', 'idloai');
    }
}

