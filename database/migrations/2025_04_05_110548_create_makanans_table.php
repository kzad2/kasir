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
        Schema::create('makanans', function (Blueprint $table) {
            $table->id();
            // $table->string('nama');
            // $table->decimal('harga', 10, 2);
            // $table->unsignedBigInteger('kategori_id');
            // $table->string('foto')->nullable();
            $table->timestamps();

            // $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('makanans');
    }
};
