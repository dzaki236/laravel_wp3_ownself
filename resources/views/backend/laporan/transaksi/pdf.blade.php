<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h3>{{ $title }} {{ $tgl_awal }} - {{ $tgl_akhir }}</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Total Transaksi</th>
                <th>Status</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
                <tr>
                    <td>#{{ $item->transaksi_id }}</td>
                    <td>{{ format_rupiah($item->total_harga_transaksi) }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
