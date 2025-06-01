<?php

use App\Models\City;
use App\Models\Produk;
use App\Models\Province;

if (!function_exists('format_rupiah')) {
    function format_rupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('province')) {
    function province($province = null)
    {
        if ($province) {
            return Province::where('province_id', $province)->orderBy('name', 'asc')->limit(1)->first();
        }
        return Province::orderBy('name', 'asc')->get();
    }
}

if (!function_exists('cities')) {
    # code...
    // return City
    function cities($cities = null)
    {
        // return City::orderBy('name', 'asc')->get();
        if ($cities) {
            return City::where('city_id', $cities)->orderBy('name', 'asc')->limit(1)->first();
        }
        return City::orderBy('name', 'asc')->get();
    }
}
// if (!function_exists('data_produk')) {
//     function data_produk()
//     {
//         return
//     }
// }

// if (!function_exists('total_harga_cart')) {
//     function total_harga_cart()
//     {
//         return auth()->user() ? auth()->user()->carts->sum('total_harga') : 0;
//     }
// }

// if (!function_exists('total_berat_cart')) {
//     function total_berat_cart()
//     {
//         return auth()->user() ? auth()->user()->carts->sum('berat') : 0;
//     }
// }

// if (!function_exists('total_qty_cart')) {
//     function total_qty_cart()
//     {
//         return auth()->user() ? auth()->user()->carts->sum('qty') : 0;
//     }
// }

// if (!function_exists('total_cart')) {
//     function total_cart()
//     {
//         return auth()->user() ? auth()->user()->carts->count() : 0;
//     }
// }
