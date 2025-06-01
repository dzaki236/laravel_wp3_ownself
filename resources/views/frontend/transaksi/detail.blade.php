@extends('frontend.layouts.master')
@section('title', $title)
@section('content')
    <div class="container mt-5">
        <div class="col-md-12">
            <div class="invoice">
                <!-- begin invoice-company -->
                <div class="invoice-company text-inverse f-w-600">
                    <span class="pull-right hidden-print">
                        <a href="{{ route('transaksi.generate', $transaksi->transaksi_id) }}"
                            class="btn btn-sm btn-white m-b-10 p-l-5" onclick="generatePDF()">
                            <i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF
                        </a>
                    </span>
                </div>
                <!-- end invoice-company -->
                <!-- begin invoice-header -->
                <div class="invoice-header row">
                    <div class="invoice-from col-12 col-sm-12 col-md-4">
                        <strong class="text-inverse">Layanan: </strong><br>
                        {{ $transaksi->ongkir_transaksi->layanan_ongkir }}<br>{{ $transaksi->ongkir_transaksi->total_berat }}Gram
                        / {{ $transaksi->ongkir_transaksi->total_berat / 1000 }}Kg
                        </address>
                    </div>
                    <div class="invoice-to col-12 col-sm-12 col-md-4">
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">Address: </strong><br>{{ $transaksi->ongkir_transaksi->province }},
                            {{ $transaksi->ongkir_transaksi->city }}<br>{{ $transaksi->ongkir_transaksi->alamat_lengkap }},
                            {{ $transaksi->ongkir_transaksi->kode_pos }}<br>penerima :
                            {{ $transaksi->ongkir_transaksi->nama_penerima }}({{ $transaksi->ongkir_transaksi->no_hp }})
                        </address>
                    </div>
                    <div class="invoice-date col-12 col-sm-12 col-md-4">
                        <small>Invoice / July period</small>
                        <div class="date text-inverse m-t-5">{{ $transaksi->created_at }}</div>
                        <div class="invoice-detail">
                            #{{ $transaksi->transaksi_id }}<br>
                            Status Pembayaran : {{ strtoupper($transaksi->status) }}
                        </div>
                    </div>
                </div>
                <!-- end invoice-header -->
                <!-- begin invoice-content -->
                <div class="invoice-content">
                    <!-- begin table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>PRODUCT DESCRIPTION</th>
                                    <th class="text-center" width="10%">QTY</th>
                                    <th class="text-center" width="10%">PRICE</th>
                                    <th class="text-right" width="20%">TOTAL PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi->orders as $item_order)
                                    <tr>
                                        <td class="text-inverse"><b>{{ $item_order->produk->nama_produk }}</b> <br>
                                            <small>Berat :
                                                {{ $item_order->produk->berat }}Gram/{{ $item_order->produk->berat / 1000 }}Kg</small>
                                        </td>
                                        <td class="text-center">{{ $item_order->qty }}</td>
                                        <td class="text-center">{{ format_rupiah($item_order->produk->harga) }}</td>
                                        <td class="text-right">{{ format_rupiah($item_order->total_harga) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                    <!-- begin invoice-price -->
                    <div class="invoice-price d-flex justify-content-between">
                        <div class="invoice-price-left">
                            <small>SUBTOTAL</small>
                        </div>
                        <div class="invoice-price-right"><b
                                class="f-w-600">{{ format_rupiah($transaksi->subtotal_harga) }}</b>
                        </div>
                    </div>
                    <div class="invoice-price d-flex justify-content-between">
                        <div class="invoice-price-left">
                            <small>TOTAL ONGKIR</small>
                        </div>
                        <div class="invoice-price-right"><b
                                class="f-w-600">{{ format_rupiah($transaksi->total_ongkir) }}</b>
                        </div>
                    </div>
                    <div class="invoice-price d-flex justify-content-between">
                        <div class="invoice-price-left">
                            <small>BIAYA ADMIN</small>
                        </div>
                        <div class="invoice-price-right"><b
                                class="f-w-600">{{ format_rupiah($transaksi->biaya_admin) }}</b>
                        </div>
                    </div>
                    <div class="invoice-price d-flex justify-content-between">
                        <div class="invoice-price-left">
                            <small>TOTAL</small>
                        </div>
                        <div class="invoice-price-right">
                            <b class="f-w-600">
                                {{ format_rupiah($transaksi->total_harga_transaksi) }}</b>
                        </div>
                    </div>
                    <!-- end invoice-price -->
                </div>
                <!-- end invoice-content -->
                <!-- begin invoice-footer -->
                <div class="invoice-footer">
                    <p class="text-center m-b-5 f-w-600">
                        THANK YOU FOR YOUR ORDER
                    </p>
                </div>
                <!-- end invoice-footer -->
            </div>
            @if (in_array($transaksi->status, ['pending', 'failed', 'expired', 'failed']))
                <button id="pay-button" class="btn btn-success mb-4"><i class="fa fa-money" aria-hidden="true"></i> Bayar
                    Sekarang</button>
            @endif

        </div>
    </div>
    <!-- end invoice -->
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
@endpush
@push('js')
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        async function generatePDF() {
            const {
                jsPDF
            } = window.jspdf;

            // Hide buttons
            document.querySelectorAll('.hidden-print').forEach(el => el.style.display = 'none');

            const invoice = document.querySelector('.invoice');
            const canvas = await html2canvas(invoice, {
                scale: 2,
                useCORS: true,
            });

            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF('p', 'mm', 'a4');

            const pageWidth = pdf.internal.pageSize.getWidth();
            const pageHeight = pdf.internal.pageSize.getHeight();

            const margin = 10; // ← Change this to 15 or more if you want
            const imgProps = pdf.getImageProperties(imgData);

            // Adjust width and height to fit within margins
            const pdfWidth = pageWidth - margin * 2;
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            // Add the image with margin
            pdf.addImage(imgData, 'PNG', margin, margin, pdfWidth, pdfHeight);

            pdf.save('invoice.pdf');

            // Show buttons again
            document.querySelectorAll('.hidden-print').forEach(el => el.style.display = '');
        }
    </script>
    <script type="text/javascript"
        src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        var payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', function() {
                // Tampilkan Snap popup
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        /* Anda bisa menangani hasil sukses di sini */
                        console.log(result);
                        alert("Pembayaran berhasil!");
                        // Sebaiknya, biarkan notifikasi server yang mengubah status.
                        // Client-side callback ini lebih untuk UX.
                        // Refresh halaman untuk melihat status terbaru dari server.
                        window.location.reload();
                    },
                    onPending: function(result) {
                        /* Tangani jika pembayaran pending */
                        console.log(result);
                        alert("Pembayaran tertunda!");
                        window.location.reload();
                    },
                    onError: function(result) {
                        /* Tangani jika terjadi error */
                        console.log(result);
                        alert("Pembayaran gagal!");
                        window.location.reload();
                    },
                    onClose: function() {}
                });
            });
        }
    </script>
@endpush
