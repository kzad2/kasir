<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailtransaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('meja_id')->constrained('mejas')->onDelete('cascade');
            $table->foreignId('menu_id')->nullable()->constrained('menus');
            $table->foreignId('transaksi_id')->nullable()->constrained('transaksis');
            $table->integer('qty');
            $table->enum('status_pesanan', ['diproses', 'selesai', 'batal'])->default('diproses');
            $table->enum('status', ['keranjang','checkout']);
            $table->integer('totalharga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailtransaksis');
    }
};
