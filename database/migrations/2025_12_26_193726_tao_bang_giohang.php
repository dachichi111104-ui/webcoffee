<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('giohang', function (Blueprint $table) {
            $table->unsignedBigInteger('idnguoidung');
            $table->unsignedBigInteger('idsp');
            $table->integer('soluong')->default(1);

            // KHÓA CHÍNH KÉP
            $table->primary(['idnguoidung', 'idsp']);

            $table->foreign('idnguoidung')
                ->references('idnguoidung')
                ->on('nguoi_dung')
                ->onDelete('cascade');

            $table->foreign('idsp')
                ->references('idsp')
                ->on('sanpham')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('giohang');
    }
};
