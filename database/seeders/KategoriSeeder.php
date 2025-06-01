<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Kategori::create(['nama_kategori' => 'Cake']);
        Kategori::create(['nama_kategori' => 'Cookies']);
        Kategori::create(['nama_kategori' => 'Bread']);
        Kategori::create(['nama_kategori' => 'Beverage']);
    }
}
