<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;

class MainController extends Controller
{
    //
    public function __invoke()
    {
        $data['title'] = 'Home';
        $data['page'] = 'home';
        $data['kategori'] = Kategori::all();
        $data['data_produk'] = Produk::with(['kategori', 'by'])->where('status', 'active')->latest()->limit(12)->get();
        return view('frontend.index', $data);
    }
}
