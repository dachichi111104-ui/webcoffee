<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id('idsp');
            $table->unsignedBigInteger('idloai');
            $table->string('tensp');
            $table->decimal('gia', 10, 2);
            $table->integer('soluong');
            $table->string('hinhanh')->nullable();
            $table->text('mota')->nullable();
            $table->timestamps();

            $table->foreign('idloai')->references('idloai')->on('loaisp')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
