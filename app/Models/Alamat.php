<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alamat extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'alamat';
    protected $appends = ['city', 'province'];
    public function getCityAttribute()
    {
        # code...
        return $this->cities->name;
    }
    public function getProvinceAttribute()
    {
        # code...
        return $this->provincies->name;
    }

    public function provincies()
    {
        # code...
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }

    public function cities()
    {
        # code...
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }
}
