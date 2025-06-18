<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Transaksi Berhasil #{{ $transaksi_id }}</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin:12px; padding:12px;">
    <h1>Transaksi Berhasil #{{ $transaksi_id }}</h1>
    <p>Terima kasih telah melakukan transaksi. Berikut adalah detail transaksi Anda:</p>
    <ul>
        <li>ID Transaksi: #{{ $transaksi_id }}</li>
        <li>Nama: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
    </ul>
    <hr>
    <center><a href="{{ route('transaksi.generate', $transaksi_id) }}">Download PDF</a></center>
</body>

</html>
