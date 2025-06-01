<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Produk extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'produk';
    protected $appends = ['url_foto_produk'];
    public function sluggable(): array
    {
        return [
            'slug_produk' => [
                'source' => 'nama_produk',
                'onUpdate' => true,
            ]
        ];
    }

    public function kategori()
    {
        # code...
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function by()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function foto()
    {
        # code...
        return $this->hasMany(FotoProduk::class, 'produk_id', 'id');
    }
    public function getUrlFotoProdukAttribute()
    {
        # code...
        if ($this->foto_produk == null) {
            return "https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg";
        }
        return asset(Storage::url($this->foto_produk));
    }
}
