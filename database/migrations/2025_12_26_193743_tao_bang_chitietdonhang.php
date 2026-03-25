<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->unsignedBigInteger('iddonhang');
            $table->unsignedBigInteger('idsp');
            $table->integer('soluong');
            $table->decimal('dongia', 10, 2);

            // KHÓA CHÍNH KÉP
            $table->primary(['iddonhang', 'idsp']);

            $table->foreign('iddonhang')
                ->references('iddonhang')
                ->on('donhang')
                ->onDelete('cascade');

            $table->foreign('idsp')
                ->references('idsp')
                ->on('sanpham')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chitietdonhang');
    }
};
