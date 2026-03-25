<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class DonHang extends Model
{
    protected $table = 'donhang';
    protected $primaryKey = 'iddonhang';

    protected $fillable = [
        'idnguoidung',
        'tongtien',
        'tennguoinhan',
        'sodienthoainguoinhan',
        'diachinhanhang',
        'ghichu',
        'phuongthucthanhtoan',
        'trangthaidonhang',
        'ngaydat'
    ];

    protected $casts = [
        'ngaydat' => 'datetime',
    ];

    public function chitiet()
    {
        return $this->hasMany(ChiTietDonHang::class, 'iddonhang');
    }

    public function nguoidung()
    {
        return $this->belongsTo(NguoiDung::class, 'idnguoidung');
    }
}
