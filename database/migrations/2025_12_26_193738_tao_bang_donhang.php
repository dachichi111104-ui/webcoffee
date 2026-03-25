<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->id('iddonhang');
            $table->unsignedBigInteger('idnguoidung');
            $table->decimal('tongtien', 10, 2);
            $table->string('tennguoinhan');
            $table->string('sodienthoainguoinhan');
            $table->string('diachinhanhang');
            $table->text('ghichu')->nullable();
            $table->enum('phuongthucthanhtoan', ['tien_mat','chuyen_khoan','momo'])->default('tien_mat');
            $table->enum('trangthaidonhang', ['cho_xu_ly','dang_giao','hoan_thanh','da_huy'])->default('cho_xu_ly');
            $table->timestamp('ngaydat')->useCurrent();
            $table->timestamps();

            $table->foreign('idnguoidung')->references('idnguoidung')->on('nguoi_dung')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};
