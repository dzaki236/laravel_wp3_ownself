@extends('frontend.layouts.master')
@section('title', $title)
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/hero/hero-1.jpg') }}">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2>Making your life sweeter one bite at a time!</h2>
                                <a href="#" class="primary-btn">Our cakes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/about-video.jpg') }}">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2>Making your life sweeter one bite at a time!</h2>
                                <a href="#" class="primary-btn">Our cakes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="about__text">
                        <div class="section-title">
                            <span>About Cake shop</span>
                            <h2>Cakes and bakes from the house of Queens!</h2>
                        </div>
                        <p>The "Cake Shop" is a Jordanian Brand that started as a small family business. The owners are
                            Dr. Iyad Sultan and Dr. Sereen Sharabati, supported by a staff of 80 employees.</p>
                    </div>
                </div>
                {{-- <div class="col-lg-6 col-md-6">
                <div class="about__bar">
                    <div class="about__bar__item">
                        <p>Cake design</p>
                        <div id="bar1" class="barfiller">
                            <div class="tipWrap"><span class="tip"></span></div>
                            <span class="fill" data-percentage="95"></span>
                        </div>
                    </div>
                    <div class="about__bar__item">
                        <p>Cake Class</p>
                        <div id="bar2" class="barfiller">
                            <div class="tipWrap"><span class="tip"></span></div>
                            <span class="fill" data-percentage="80"></span>
                        </div>
                    </div>
                    <div class="about__bar__item">
                        <p>Cake Recipes</p>
                        <div id="bar3" class="barfiller">
                            <div class="tipWrap"><span class="tip"></span></div>
                            <span class="fill" data-percentage="90"></span>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Categories Section Begin -->
    <div class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($kategori as $item_kategori)
                        <div class="">
                            <div class="">
                                <h5 class="font-weight-bold">{{ strtoupper($item_kategori->nama_kategori) }}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                @foreach ($data_produk as $item_produk)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <a href="{{ route('produk.detail', $item_produk->slug_produk) }}">
                                <div class="product__item__pic set-bg" data-setbg="{{ $item_produk->url_foto_produk }}">
                                    <div class="product__label">
                                        <span>{{ $item_produk->kategori->nama_kategori }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $item_produk->nama_produk }}</a></h6>
                                <div class="product__item__price">{{ format_rupiah($item_produk->harga) }}</div>
                                @auth
                                    @if (auth()->user()->role == 'customer')
                                        <div class="cart_add">
                                            <form action="{{ route('cart.add_to_cart', $item_produk->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-light">Add to cart</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="cart_add">
                                            <a href="#" class="btn btn-light">Unable add product to cart</a>
                                        </div>
                                    @endif
                                @endauth
                                @guest
                                    <div class="cart_add">
                                        <a href="#" class="btn btn-light">Unable add product to cart</a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
@push('js')
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
@endpush
