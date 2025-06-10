<?php

namespace App\Http\Controllers\Backend\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    //
    public function index()
    {
        # code...
        $data['title'] = 'Laporan Produk';
        $data['page'] = 'laporan_produk';
        return view('backend.laporan.produk.index', $data);
    }

    public function generate_pdf(Request $request)
    {
        # code...
        $data['title'] = 'Laporan Produk';
        $data['page'] = 'laporan_produk';

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $produkTerjual = Order::with(['produk', 'transaksi'])
            ->whereHas('transaksi', function ($query) {
                $query->where('status', 'success');
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('produk_id, DATE(created_at) as date, SUM(qty) as sales_count')
            ->groupBy('produk_id', DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'produk_name' => $item->produk->name ?? '-',
                    'date' => $item->date,
                    'sales_count' => $item->sales_count,
                ];
            });

        $data['produk_terjual'] = $produkTerjual;
        return view('backend.laporan.produk.pdf', $data);
    }
}
