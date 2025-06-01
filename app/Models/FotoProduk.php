<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Database\Eloquent\Model;

class FotoProduk extends Model
{
    use HasFactory;
    protected $table = 'foto_produk';
    protected $appends = ['url_foto_produk'];
    public function getUrlFotoProdukAttribute()
    {
        # code...
        return asset(Storage::url($this->foto_produk));
    }
    public function produk()
    {
        # code...
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
