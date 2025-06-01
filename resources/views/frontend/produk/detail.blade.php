@extends('frontend.layouts.master')
@section('title', $title)
@section('content')
    <!-- Shop Details Section Begin -->
    <section class="product-details spad mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__img">
                        <div class="product__details__big__img">
                            <img class="big_img" src="{{ $produk->url_foto_produk }}" alt="">
                        </div>
                        <div class="product__details__thumb">
                            <div class="pt__item">
                                <img data-imgbigurl="{{ $produk->url_foto_produk }}" src="{{ $produk->url_foto_produk }}"
                                    alt="">
                            </div>
                            @foreach ($produk->foto as $item_foto_produk)
                                <div class="pt__item {{ $loop->first ? 'active' : '' }}">
                                    <img data-imgbigurl="{{ $item_foto_produk->url_foto_produk }}"
                                        src="{{ $item_foto_produk->url_foto_produk }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <div class="product__label">{{ $produk->kategori->nama_kategori }}</div>
                        <h4>{{ $produk->nama_produk }}</h4>
                        <h5>{{ format_rupiah($produk->harga) }}</h5>
                        <div style="height: 5em;"></div>
                        <ul>
                            <li>Stok Produk: <span>{{ $produk->stock }}</span></li>
                            <li>Berat: <span>{{ $produk->berat }} Gram</span></li>
                            <li>Category: <span>{{ $produk->kategori->nama_kategori }}</span></li>
                        </ul>
                        <div class="product__details__option">
                            <form action="{{ route('cart.add_to_cart', $produk->id) }}" method="post">
                                @csrf
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="number" value="1" name='qty' min="1" max="{{ $produk->stock }}">
                                    </div>
                                </div>
                                @if (auth()->check() && auth()->user()->role == 'customer')
                                    <button type="submit" class="btn primary-btn">Add to cart</button>
                                @else
                                    <div class="btn btn-secondary btn-lg">Unable add to cart</div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product__details__tab">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    {!! $produk->detail !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->
@endsection
@push('js')
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
@endpush
