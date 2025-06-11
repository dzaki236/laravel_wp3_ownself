<?php

namespace App\Http\Controllers\Backend\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function generate(Request $request)
    {
        # code...
        $data['title'] = 'Laporan Produk';
        $data['page'] = 'laporan_produk';
        $type = strtolower($request->type);
        if ($type == 'pdf') {
            # code...
            return $this->generate_pdf($request, $data);
        }
        if ($type == 'csv') {
            # code...
            return $this->generate_csv($request, $data);
        }
    }
    public function generate_csv(Request $request)
    {
        $startDate = $request->start_date . ' 00:00:00';
        $endDate = $request->end_date . ' 23:59:59';

        $produkTerjual = DB::table('order')
            ->join('produk', 'order.produk_id', '=', 'produk.id')
            ->join('transaksi', 'order.transaksi_id', '=', 'transaksi.transaksi_id')
            ->select(
                'produk.nama_produk as produk_name',
                DB::raw('DATE(order.created_at) as date'),
                DB::raw('SUM(order.qty) as sales_count')
            )
            ->where('transaksi.status', 'success')
            ->whereBetween('order.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk', DB::raw('DATE(order.created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        // Header CSV
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=laporan-produk-" . now()->format('Ymd') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Callback stream
        $callback = function () use ($produkTerjual) {
            $file = fopen('php://output', 'w');
            // Baris header
            fputcsv($file, ['Produk Name', 'Date', 'Sales Count']);

            // Data isi
            foreach ($produkTerjual as $item) {
                fputcsv($file, [
                    $item->produk_name,
                    $item->date,
                    $item->sales_count . ' items',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function generate_pdf(Request $request, $data)
    {
        # code...
        $startDate = $request->start_date . ' 00:00:00';
        $endDate = $request->end_date . ' 23:59:59';
        $produkTerjual = DB::table('order')
            ->join('produk', 'order.produk_id', '=', 'produk.id')
            ->join('transaksi', 'order.transaksi_id', '=', 'transaksi.transaksi_id')
            ->select(
                'produk.nama_produk as produk_name',
                DB::raw('DATE(order.created_at) as date'),
                DB::raw('SUM(order.qty) as sales_count')
            )
            ->where('transaksi.status', 'success')
            ->whereBetween('order.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk', DB::raw('DATE(order.created_at)'))
            ->orderBy('date', 'asc')
            ->get();
        if ($startDate > $endDate) {
            # code...
            return redirect()->back()->with('error', 'Tanggal awal harus lebih kecil dari tanggal akhir');
        }
        $data['produk_terjual'] = $produkTerjual;
        $data['tgl_awal'] = $request->start_date;
        $data['tgl_akhir'] = $request->end_date;
        $pdf = Pdf::loadView('backend.laporan.produk.pdf', $data);
        return $pdf->stream(md5(time()) . '.pdf');
    }
}
