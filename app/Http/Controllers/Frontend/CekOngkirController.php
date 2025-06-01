<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alamat;
use Dzaki236\RajaOngkir\Facades\RajaOngkir;

class CekOngkirController extends Controller
{
    //
    public function check_ongkir(Request $request)
    {
        $alamat_id = $request->alamat_id;
        $alamat = Alamat::find($alamat_id);
        if (!$alamat) {
            return response()->json(['error' => 'Alamat tidak ditemukan'], 404);
        }
        $cost = RajaOngkir::ongkir([
            'origin'        => env('RAJAONGKIR_CITY_FROM'), // ID kota/kabupaten asal
            'originType' => "city",
            'destination'   => intval($alamat->city_id), // ID kota/kabupaten tujuan
            'weight'        => intval($request->total_berat), // berat barang dalam gram
            'destinationType' => "city",
            'courier' => $request->kurir,
        ])->get();
        return response()->json($cost);
    }
}
