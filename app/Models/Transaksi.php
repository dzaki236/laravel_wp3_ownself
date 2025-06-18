<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    public function orders()
    {
        return $this->hasMany(Order::class, 'transaksi_id', 'transaksi_id');
    }
    public function ongkir_transaksi()
    {
        # code...
        return $this->hasOne(OngkirTransaksi::class, 'transaksi_id', 'id');
    }

    public function user()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
