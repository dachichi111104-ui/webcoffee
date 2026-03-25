<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable
{
    use Notifiable;

    protected $table = 'nguoi_dung';
    protected $primaryKey = 'idnguoidung';

    protected $fillable = [
        'ten',
        'email',
        'password',
        'sdt',
    ];

    protected $hidden = [
        'password',
    ];

    // Quan hệ với đơn hàng
    public function donHang()
    {
        return $this->hasMany(DonHang::class, 'idnguoidung');
    }
}
