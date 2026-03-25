<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiSP extends Model
{
    use HasFactory;

    protected $table = 'loaisp';       // tên bảng
    protected $primaryKey = 'idloai';  // khóa chính của bảng
    public $timestamps = false;        // nếu không có created_at/updated_at

protected $fillable = ['tenloai', 'slug'];
}
