<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    //
    public function get_cities_origin($province_id)
    {
        # code...
        $cities = City::where('province_id', $province_id)->get();
        return response()->json($cities);
    }
}
