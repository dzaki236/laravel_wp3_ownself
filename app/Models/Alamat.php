<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alamat extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'alamat';
    public function getCityAttribute()
    {
        # code...
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
    public function getProvinceAttribute()
    {
        # code...
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
}
