<?php

use App\Models\Kategori;
use App\Models\User;
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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kategori::class, 'kategori_id')->constrained('kategori', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(User::class, 'user_id')->constrained('users', 'id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('nama_produk');
            $table->string('slug_produk')->unique();
            $table->string('foto_produk')->nullable();
            $table->unsignedBigInteger('harga');
            $table->unsignedBigInteger('stock');
            $table->unsignedBigInteger('berat');
            $table->longText('detail')->nullable();
            $table->enum('status', ['active', 'archived'])->default('active');
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
        Schema::dropIfExists('produk');
    }
};
