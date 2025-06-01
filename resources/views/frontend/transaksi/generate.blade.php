<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            padding: 30px;
            max-width: 800px;
            margin: auto;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #007BFF;
        }

        .company-details {
            text-align: right;
        }

        .info-table {
            width: 100%;
            margin: 20px 0;
        }

        .info-table td {
            padding: 5px 0;
        }

        .items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .items th,
        .items td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .items th {
            background-color: #f4f4f4;
            text-align: left;
        }

        .total {
            text-align: right;
            padding-top: 20px;
        }

        .footer {
            margin-top: 50px;
            font-size: 12px;
            text-align: center;
            color: #999;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="header">
            <div>
                <img src="{{ $logo }}" alt="Logo" style="width: 100px;">
            </div>
            <div class="company-details">
                <div>Transaksi Id : {{ $transaksi->transaksi_id }}</div>
                <div>Timestamp : {{ $transaksi->created_at }}</div>
                <h5>Status Pembayaran : {{ strtoupper($transaksi->status) }}</h5>

            </div>
        </div>

        <table class="info-table">
            <tr>
                <td><strong>Layanan
                        :</strong><br>{{ $transaksi->ongkir_transaksi->layanan_ongkir }}<br>{{ $transaksi->ongkir_transaksi->total_berat }}Gram
                    / {{ $transaksi->ongkir_transaksi->total_berat / 1000 }}Kg</td>
                <td><strong>Addres:</strong><br>{{ $transaksi->ongkir_transaksi->province }},
                    {{ $transaksi->ongkir_transaksi->city }}<br>{{ $transaksi->ongkir_transaksi->alamat_lengkap }},
                    {{ $transaksi->ongkir_transaksi->kode_pos }}<br>penerima :
                    {{ $transaksi->ongkir_transaksi->nama_penerima }}({{ $transaksi->ongkir_transaksi->no_hp }})</td>
            </tr>
        </table>

        <table class="items">
            <thead>
                <tr>
                    <th>Product & Description</th>
                    <th>Qty</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->orders as $item_order)
                    <tr>
                        <td><b>{{ $item_order->produk->nama_produk }}</b> <br> <small>Berat :
                                {{ $item_order->produk->berat }}Gram/{{ $item_order->produk->berat / 1000 }}Kg</small>
                        </td>
                        <td>{{ $item_order->qty }}</td>
                        <td>{{ format_rupiah($item_order->produk->harga) }}</td>
                        <td>{{ format_rupiah($item_order->total_harga) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <h3>Subtotal : {{ format_rupiah($transaksi->subtotal_harga) }}</h3>
            <h3>Total ongkir : {{ format_rupiah($transaksi->total_ongkir) }}</h3>
            <h3>Biaya admin : {{ format_rupiah($transaksi->biaya_admin) }}</h3>
            <h3>Total : {{ format_rupiah($transaksi->total_harga_transaksi) }}</h3>
        </div>

        <div class="footer">
            Thank you for your order!
        </div>
    </div>
</body>

</html>
