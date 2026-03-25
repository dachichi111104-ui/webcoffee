<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GioHang extends Model
{
    protected $table = 'giohang';

    public $timestamps = false;

    // BẮT BUỘC
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'idnguoidung',
        'idsp',
        'soluong'
    ];
}
