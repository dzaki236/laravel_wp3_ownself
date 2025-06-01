<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__cart">
        @auth
            @if (auth()->user()->role == 'customer')
                <a href="{{ route('cart.index') }}">
                    <div class="offcanvas__cart__item">
                        <a href="#"><img src="{{ asset('frontend/img/icon/cart.png') }}" alt="">
                            <span>{{ auth()->user()->carts->count() }}</span></a>
                        <div class="cart__price">Cart:
                            <span>{{ format_rupiah(auth()->user()->carts->sum('total_harga')) }}</span>
                        </div>
                    </div>
                </a>
            @endif
        @endauth
    </div>
    <div class="offcanvas__logo">
        <a href="/"><img src="{{ asset('frontend/img/logo.png') }}" alt=""></a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="offcanvas__option">
        @guest
            <ul>
                <li>Join <span class="arrow_carrot-down"></span>
                    <ul>
                        <li style="width: 50vw;"><a href="{{ route('auth.redirect') }}" class="text-white">Join Now With
                                Google Account!</a></li>
                    </ul>
                </li>
            </ul>
        @endguest
        @auth
            @if (auth()->user()->role == 'customer')
                <ul>
                    <li>Welcome, {{ auth()->user()->name }} <span class="arrow_carrot-down"></span>
                        <ul>
                            <li><a href="" class="text-white">Profile</a></li>
                            <li><a href="{{ route('auth.logout') }}" class="text-white">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            @endif
        @endauth
    </div>
</div>
<!-- Offcanvas Menu End -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header__top__inner">
                        <div class="header__top__left">
                            @guest
                                <ul>
                                    <li>Join <span class="arrow_carrot-down"></span>
                                        <ul>
                                            <li style="width: 10vw;"><a href="{{ route('auth.redirect') }}"
                                                    class="text-white">Join Now With
                                                    Google Account!</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            @endguest
                            @auth
                                @if (auth()->user()->role == 'customer')
                                    <ul>
                                        <li>Welcome, {{ auth()->user()->name }} <span class="arrow_carrot-down"></span>
                                            <ul>
                                                <li><a href="{{ route('my-profile.index') }}"
                                                        class="text-white">Profile</a></li>
                                                <li><a href="{{ route('auth.logout') }}" class="text-white">Logout</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                @endif
                            @endauth
                        </div>
                        <div class="header__logo">
                            <a href="{{ route('frontend.index') }}"><img src="{{ asset('frontend/img/logo.png') }}"
                                    alt=""></a>
                        </div>
                        @auth
                            @if (auth()->user()->role == 'customer')
                                <div class="header__top__right">
                                    <div class="header__top__right__cart">
                                        <a href="{{ route('cart.index') }}"><img
                                                src="{{ asset('frontend/img/icon/cart.png') }}" alt="">
                                            <span>{{ auth()->user()->carts->count() }}</span></a>
                                        <div class="cart__price">Cart:
                                            <span>{{ format_rupiah(auth()->user()->carts->sum('total_harga')) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
                                <div class="header__top__right">
                                    <div class="header__top__right__social">
                                        <a class="text-dark" href="{{ route('backend.dashboard.index') }}"><i
                                                class="fa fa-user"></i> {{ auth()->user()->name }}</a>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{ $page == 'home' ? 'active' : '' }}"><a
                                href="{{ route('frontend.index') }}">Home</a>
                        </li>
                        <li class="{{ $page == 'produk' ? 'active' : '' }}"><a
                                href="{{ route('produk.index') }}">Product</a></li>
                        <li class="{{ $page == 'transaksi' ? 'active' : '' }}"><a
                                href="{{ route('transaksi.index') }}">Transaksi</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
