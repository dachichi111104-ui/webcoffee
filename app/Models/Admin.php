<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'idadmin';

    protected $fillable = ['emailadmin', 'passadmin'];
    protected $hidden = ['passadmin'];

    public $timestamps = true;

    public function getAuthPassword()
    {
        return $this->passadmin;
    }
}
