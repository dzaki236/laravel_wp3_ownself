<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Cart;
use App\Models\OngkirTransaksi;
use App\Models\Order;
use App\Models\Transaksi;
use Dzaki236\RajaOngkir\Resources\OngkosKirim;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class TransaksiController extends Controller
{
    //
    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['page'] = 'transaksi';
        $data['transaksi'] = Transaksi::with(['orders', 'ongkir_transaksi'])->where('user_id', auth()->user()->id)->latest()->get();
        return view('frontend.transaksi.index', $data);
    }
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $cart_items = Cart::where('user_id', auth()->user()->id)->get();
        $transaksiId = 'T-' . random_int(1000000000, 9999999999);
        $alamat = Alamat::find($request->alamat_id_val);
        $params = [
            'transaction_details' => [
                'order_id' => $transaksiId,
                'gross_amount' => $request->total_harga_value,
            ],
            'customer_details' => [
                'first_name' => $alamat->nama_penerima,
                'last_name' => '-',
                'email' => auth()->user()->email,
                'phone' => $request->no_hp,
            ],
        ];
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaksi = new Transaksi();
        $transaksi->transaksi_id = $transaksiId;
        $transaksi->user_id = auth()->user()->id;
        $transaksi->total_ongkir = $request->total_ongkir_value;
        $transaksi->total_berat = $request->total_berat_value;
        $transaksi->subtotal_harga = $request->subtotal_harga_value;
        $transaksi->total_harga_transaksi = $request->total_harga_value;
        $transaksi->biaya_admin = $request->biaya_admin_value;
        $transaksi->user_id = auth()->user()->id;
        $transaksi->kode_pembayaran = $snapToken;
        foreach ($cart_items as $item_check) {
            if ($item_check->produk->status == 'archived') {
                return redirect()->back()->with('error', 'Terdapat produk yang sudah tidak aktif.');
            }

            if ($item_check->qty > $item_check->produk->stock) {
                return redirect()->back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
            }
        }
        foreach ($cart_items as $item) {
            Order::create([
                'order_id' => uniqid(),
                'user_id' => auth()->user()->id,
                'produk_id' => $item->produk_id,
                'transaksi_id' => $transaksiId,
                'qty' => $item->qty,
                'harga' => $item->produk->harga,
                'berat' => $item->produk->berat,
                'total_harga' => $item->qty * $item->produk->harga,
                'total_berat' => $item->qty * $item->produk->berat,
                'status' => 'pending',
            ]);
            // $item->produk->update([
            //     'stock' => $item->produk->stock - $item->qty,
            // ]);
        }
        $transaksi->save();
        $ongkir_transaksi = new OngkirTransaksi();
        $ongkir_transaksi->transaksi_id = $transaksi->id;
        $ongkir_transaksi->alamat_id = $alamat->id;
        $ongkir_transaksi->nama_alamat = $alamat->nama_alamat;
        $ongkir_transaksi->no_hp = $alamat->no_hp;
        $ongkir_transaksi->nama_penerima = $alamat->nama_penerima;
        $ongkir_transaksi->province_id = $alamat->province_id;
        $ongkir_transaksi->city_id = $alamat->city_id;
        $ongkir_transaksi->layanan_ongkir = strtoupper($request->kurir_value);
        $ongkir_transaksi->total_berat = $request->total_berat_value;
        $ongkir_transaksi->total_ongkir = $request->total_ongkir_value;
        $ongkir_transaksi->kode_pos = $alamat->kode_pos;
        $ongkir_transaksi->alamat_lengkap = $alamat->alamat_lengkap;
        $ongkir_transaksi->save();
        // clear cart
        Cart::where('user_id', auth()->user()->id)->delete();
        return redirect()->route('transaksi.show', $transaksiId);
        // return view('frontend.transaksi.index', compact('snapToken'));
    }
    public function show($transaksi_id)
    {
        $data['title'] = 'Detail Transaksi';
        $data['page'] = 'transaksi';
        $transaksi = Transaksi::where('transaksi_id', $transaksi_id)->firstOrFail();
        $data['transaksi'] = $transaksi;
        $data['snapToken'] = $transaksi->kode_pembayaran;
        return view('frontend.transaksi.detail', $data);
        // return "test";
    }
    public function notification(Request $request)
    {
        # code...
        $notification_body = json_decode($request->getContent(), true);
        $orderId = $notification_body['order_id'];
        $statusCode = $notification_body['status_code'];
        $grossAmount = $notification_body['gross_amount'];
        $signatureKey = $notification_body['signature_key'];
        $status_transaksi = $notification_body['transaction_status'];
        $status_fraud = $notification_body['fraud_status'] ?? null; // Fraud status bisa null

        // Verifikasi signature key
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $orderId . $statusCode . $grossAmount . $serverKey);

        if ($hashed !== $signatureKey) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Cari order di database Anda
        $order = Transaksi::with('user')->where('transaksi_id', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        if ($status_transaksi == 'capture') {
            if ($status_fraud == 'accept') {
                $order->status = 'success';
                $order->save();
                // update stock produk
                foreach ($order->orders as $item) {
                    $produk = $item->produk;
                    if ($produk) {
                        $produk->stock -= $item->qty;
                        $produk->save();
                    }
                }
                Mail::send('emails.transaksi-berhasil', ['transaksi_id' => $order->transaksi_id, 'user' => $order->user], function ($message) use ($order) {
                    $message->to($order->user->email);
                    $message->subject('Transaksi Berhasil - #' . $order->transaksi_id);
                });
            } else if ($status_fraud == 'challenge') {
                $order->status = 'challenge';
                $order->save();
            }
        } else if ($status_transaksi == 'settlement') {
            $order->status = 'success';
            $order->save();
            foreach ($order->orders as $item) {
                $produk = $item->produk;
                if ($produk) {
                    $produk->stock -= $item->qty;
                    $produk->save();
                }
            }
            Mail::send('emails.transaksi-berhasil', ['transaksi_id' => $order->transaksi_id, 'user' => $order->user], function ($message) use ($order) {
                $message->to($order->user->email);
                $message->subject('Transaksi Berhasil - #' . $order->transaksi_id);
            });
        } else if ($status_transaksi == 'pending') {
            $order->status = 'pending';
            $order->save();
        } else if ($status_transaksi == 'deny') {
            $order->status = 'failed';
            $order->save();
        } else if ($status_transaksi == 'expire') {
            $order->status = 'expired';
            $order->save();
        } else if ($status_transaksi == 'cancel') {
            $order->status = 'failed';
            $order->save();
        }

        // Beri respons ke Midtrans bahwa notifikasi telah diterima
        return response()->json(['message\'s' => 'Notification processed'], 200);
    }

    public function generate($transaksi_id)
    {
        # code...
        $data['title'] = 'Invoice';
        $data['page'] = 'transaksi';
        $path = public_path('frontend/img/logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $datas = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($datas);
        $data['logo'] = $base64;
        $transaksi = Transaksi::with(['orders', 'ongkir_transaksi'])->where('transaksi_id', $transaksi_id)->first();
        $data['transaksi'] = $transaksi;
        $pdf = Pdf::loadView('frontend.transaksi.generate', $data);
        return $pdf->stream('invouce.pdf');
    }
}
