<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Format;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __invoke()
    {
        $data['page'] = 'dashboard';
        $data['title'] = 'Dashboard Admin';
        $data['total_customer'] = User::where('role', 'customer')->count();
        $data['total_produk'] = Produk::count();
        $data['customers'] = User::where('role', 'customer')->latest()->take(10)->paginate(3);
        $data['total_kategori'] = Kategori::count();
        $data['total_transaksi'] = Transaksi::where('status', 'success')->count();
        $data['total_penjualan_bulan_ini'] = Format::rupiah(Transaksi::where('status', 'success')->whereMonth('created_at', date('m'))->sum('total_harga_transaksi'));
        return view('backend.dashboard.index', $data);
    }
}
