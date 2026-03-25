<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'emailadmin' => 'admin@example.com',
            'passadmin' => Hash::make('123456'), // mật khẩu: 123456
        ]);
    }
}
