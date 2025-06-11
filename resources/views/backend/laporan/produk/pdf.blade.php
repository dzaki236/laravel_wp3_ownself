<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h3>{{ $title }} {{ $tgl_awal }} - {{ $tgl_akhir }}</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk Name</th>
                <th>Date</th>
                <th>Sales Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk_terjual as $item)
                <tr>
                    <td>{{ $item->produk_name }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->sales_count }} items</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
