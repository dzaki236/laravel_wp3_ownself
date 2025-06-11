<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //
    public function index()
    {

        $data['title'] = 'Produk';
        $data['page'] = 'produk';
        $data['kategori'] = Kategori::all();
        $produk_query = Produk::query();
        $data['data_produk'] = $produk_query->where('status', 'active')->latest()->with(['kategori', 'by'])->when(request()->get('kategori'), function ($query) {
            return $query->whereHas('kategori', function ($q) {
                $q->where('nama_kategori', request()->get('kategori'));
            });
        })->when(request()->get('search'), function ($query) {
            return $query->where('nama_produk', 'like', '%' . request()->get('search') . '%');
        })->paginate()->appends(request()->all());
        return view('frontend.produk.index', $data);
    }
    public function detail($slug)
    {
        # code...
        $data['title'] = 'Detail Produk';
        $data['page'] = '';
        $data['produk'] = Produk::with(['foto', 'kategori'])->where('slug_produk', $slug)->firstOrFail();
        return view('frontend.produk.detail', $data);
    }
}
