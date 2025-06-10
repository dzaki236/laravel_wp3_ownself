@extends('backend.layouts.master')
@section('title', $title)
@section('content')
    {{-- {{ auth()->user() }} --}}
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 mb-4">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 mb-4">
                    <div class="bg-dark p-10 text-white text-center">
                        <i class="mdi mdi-account fs-3 mb-1 font-16"></i>
                        <h5 class="mb-0 mt-1">{{ $total_customer }}</h5>
                        <small class="font-light">Total Customer</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 mb-4">
                    <div class="bg-dark p-10 text-white text-center">
                        <i class="mdi mdi-tag fs-3 mb-1 font-16"></i>
                        <h5 class="mb-0 mt-1">{{ $total_kategori }}</h5>
                        <small class="font-light">Total Kategori</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 mb-4">
                    <div class="bg-dark p-10 text-white text-center">
                        <i class="mdi mdi-table fs-3 mb-1 font-16"></i>
                        <h5 class="mb-0 mt-1">{{ $total_transaksi }}</h5>
                        <small class="font-light">Total Transaksi</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 mb-4">
                    <div class="bg-dark p-10 text-white text-center">
                        <i class="mdi mdi-web fs-3 mb-1 font-16"></i>
                        <h5 class="mb-0 mt-1">{{ $total_penjualan_bulan_ini }}</h5>
                        <small class="font-light">Total Penjualan Bulan Ini</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 mb-4">
                    <div class="bg-dark p-10 text-white text-center">
                        <i class="mdi mdi-cart fs-3 mb-1 font-16"></i>
                        <h5 class="mb-0 mt-1">{{ $total_produk }}</h5>
                        <small class="font-light">Total Produk</small>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 mb-4">
                    <div class="card card-hover">
                        <div class="box bg-secondary text-center">
                            <h1 class="font-light text-white">
                                <i class="mdi mdi-receipt"></i>
                            </h1>
                            <h6 class="text-white">Report</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Latest User</h4>
                </div>
                <div class="comment-widgets scrollable ps-container ps-theme-default"
                    data-ps-id="bdb1bcbc-44e1-e0bc-fea0-661a926c2d82">
                    @foreach ($customers as $customer_terakhir)
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row mt-0">
                            <div class="p-2">
                                <img src="{{ $customer_terakhir->url_foto_profile }}" alt="user" width="50"
                                    class="rounded-circle">
                            </div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">{{ $customer_terakhir->email }} | {{ $customer_terakhir->name }}
                                </h6>
                                <span class="text-muted ">{{ $customer_terakhir->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                    <div class="m-4">
                        {{ $customers->links() }}
                    </div>
                    <div class="ps-scrollbar-x-rail" style="width: 30px; left: 0px; bottom: 0px;">
                        <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 5px;"></div>
                    </div>
                    <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                        <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
