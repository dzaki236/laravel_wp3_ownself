<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $appends = [
        'total_berat',
        'total_harga'
    ];
    public function getTotalBeratAttribute()
    {
        # code...
        return $this->qty * $this->produk->berat;
    }
    public function getTotalHargaAttribute()
    {
        # code...
        return $this->qty * $this->produk->harga;
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
