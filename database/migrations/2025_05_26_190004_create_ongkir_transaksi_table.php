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
        Schema::create('ongkir_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('alamat_id')->constrained('alamat', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_alamat');
            $table->string('no_hp');
            $table->string('nama_penerima');
            $table->string('province_id');
            $table->string('city_id');
            $table->string('layanan_ongkir');
            $table->unsignedBigInteger('total_berat'); //gram
            $table->unsignedBigInteger('total_ongkir');
            $table->string('kode_pos');
            $table->longText('alamat_lengkap');
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
        Schema::dropIfExists('ongkir_transaksi');
    }
};
