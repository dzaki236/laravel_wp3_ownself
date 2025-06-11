<?php

namespace App\Http\Controllers\Backend\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function index()
    {
        # code...
        $data['title'] = 'Laporan Transaksi';
        $data['page'] = 'laporan_transaksi';
        return view('backend.laporan.transaksi.index', $data);
    }
    public function generate(Request $request)
    {
        # code...
        $data['title'] = 'Laporan Transaksi';
        $data['page'] = 'laporan_transaksi';
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
    public function generate_pdf(Request $request, $data)
    {
        # code...
        $startDate = $request->start_date . ' 00:00:00';
        $endDate = $request->end_date . ' 23:59:59';
        $tranaksi = Transaksi::whereBetween('created_at', [$startDate, $endDate])->get();
        if ($startDate > $endDate) {
            # code...
            return redirect()->back()->with('error', 'Tanggal awal harus lebih kecil dari tanggal akhir');
        }
        $data['transaksi'] = $tranaksi;
        $data['tgl_awal'] = $request->start_date;
        $data['tgl_akhir'] = $request->end_date;
        $pdf = Pdf::loadView('backend.laporan.transaksi.pdf', $data);
        return $pdf->stream('Transaksi-' . now()->format('Ymd') . '-' . md5(time()) . '.pdf');
    }
    public function generate_csv(Request $request)
    {
        $startDate = $request->start_date . ' 00:00:00';
        $endDate = $request->end_date . ' 23:59:59';

        if ($startDate > $endDate) {
            return redirect()->back()->with('error', 'Tanggal awal harus lebih kecil dari tanggal akhir');
        }

        $transaksi = Transaksi::whereBetween('created_at', [$startDate, $endDate])->get();

        $filename = 'Transaksi-' . now()->format('Ymd') . '-' . md5(time()) . '.csv';

        $callback = function () use ($transaksi) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, ['Id', 'Total Transaksi', 'Status', 'Tanggal Transaksi']);

            // Data baris
            foreach ($transaksi as $item) {
                fputcsv($file, [
                    '#' . $item->transaksi_id,
                    'Rp ' . number_format($item->total_harga_transaksi, 0, ',', '.'),
                    ucfirst($item->status),
                    $item->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ]);
    }
}
