<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Dzaki236\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $sql = file_get_contents(database_path('wilayah/structure.sql'));
        $sql2 = file_get_contents(database_path('wilayah/data.sql'));
        // DB::unprepared($sql);
        DB::unprepared($sql2);
    }
}
