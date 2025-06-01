@extends('frontend.layouts.master')
@section('title', $title)
@section('content')
    {{-- {{ auth()->user() }} --}}
    <div class="m-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Transaksi Saya</h5>
                        <div class="table-responsive">
                            <table class="table table-hover" id="zero_config">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Total Item</th>
                                        <th scope="col">Nominal</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $item_transaksi)
                                        <tr class="">
                                            <td scope="row"><a href="{{ route('transaksi.show', $item_transaksi->transaksi_id) }}"> {{ $item_transaksi->transaksi_id }} <i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                            <td>{{ $item_transaksi->orders->count() }} Item</td>
                                            <td>{{ format_rupiah($item_transaksi->total_harga_transaksi) }}</td>
                                            <td>
                                                {{ $item_transaksi->created_at }}
                                            </td>
                                            <td>{{ $item_transaksi->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
@endpush
@push('js')
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
@endpush
