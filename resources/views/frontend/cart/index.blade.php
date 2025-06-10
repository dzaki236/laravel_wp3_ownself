@extends('frontend.layouts.master')
@section('title', $title)
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__text">
                        <h2>Shopping cart</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="breadcrumb__links">
                        <a href="/">Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ route('cart.update_cart') }}" method="post">
                        <button type="submit" class="btn btn-dark mb-5"><i class="fa fa-spinner"></i> Update
                            cart</button>
                        @csrf
                        @method('PUT')
                        <div class="shopping__cart__table">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Product Image</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cart as $item_cart)
                                            <tr
                                                class="py-4 {{ $item_cart->produk->status == 'archived' ? 'bg-danger ' : '' }}">
                                                <td class="w-25">
                                                    <img class="p-3 d-block" src="{{ $item_cart->produk->url_foto_produk }}"
                                                        alt="">
                                                </td>
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__text">
                                                        <h6>{{ $item_cart->produk->nama_produk }}</h6>
                                                        <p>Stok : {{ $item_cart->produk->stock }} <br>Berat :
                                                            {{ $item_cart->produk->berat }} Gram</p>
                                                        <h5>{{ format_rupiah($item_cart->produk->harga) }}</h5>
                                                    </div>
                                                </td>
                                                @if ($item_cart->produk->status != 'archived')
                                                    <input type="hidden" name="produk_id[]"
                                                        value="{{ $item_cart->produk->id }}">
                                                    <input type="hidden" name="cart_id[]" value="{{ $item_cart->id }}">
                                                    <td class="quantity__item">
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <input type="number"
                                                                    {{ $item_cart->produk->status == 'archived' ? 'disabled readonly' : '' }}
                                                                    value="{{ $item_cart->qty }}" name="qty[]"
                                                                    min="1" max="{{ $item_cart->produk->stock }}">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="cart__price">
                                                        {{ $item_cart->total_berat }} Gram<br>
                                                        {{ format_rupiah($item_cart->total_harga) }}
                                                    </td>
                                                @else
                                                    <td class="text-white" colspan="2">
                                                        <p>Produk sudah tidak aktif!</p>
                                                    </td>
                                                @endif
                                                <td class="cart__close btn"><span class="delete-cart-item"
                                                        data-produk-id={{ $item_cart->produk->id }}><i
                                                            class="icon_close"></i></span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">
                                                    <h5>Keranjang kosong!</h5>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="{{ route('produk.index') }}">Continue Shopping</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <button type="submit" class="btn btn-dark"><i class="fa fa-spinner"></i> Update
                                        cart</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Address</h6>
                        <div class="table-responsive" style="height:20em;">
                            @forelse (auth()->user()->alamat as $alamat)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="alamat_id"
                                                value="{{ $alamat->id }}" id="alamat-{{ $alamat->id }}" />
                                            <label class="form-check-label" for="alamat-{{ $alamat->id }}">
                                                <h5 class="card-title">{{ $alamat->nama_alamat }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted ">
                                                    {{ $alamat->nama_penerima }} | {{ $alamat->no_hp }}</h6>
                                                <div class="card-text">
                                                    <q>{{ $alamat->alamat_lengkap }}</q>
                                                    <ul>
                                                        <li>Provinsi : {{ province($alamat->province_id)->name }}</li>
                                                        <li>Kota : {{ cities($alamat->city_id)->name }}</li>
                                                        <li>Kode POS : {{ $alamat->kode_pos }}</li>
                                                    </ul>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning text-center">
                                    <strong>Oops!</strong> Alamat tidak ditemukan.
                                </div>
                            @endforelse
                        </div>
                        {{-- <form action="#">
                            <button type="submit">Apply</button>
                        </form> --}}
                    </div>
                    <div class="mb-4">
                        <div class="mb-3">
                            <select class="w-100" name="kurir" id="kurir" disabled>
                                <option selected disabled>Pilih Kurir</option>
                                <option value="jne">Jne</option>
                                <option value="tiki">Tiki</option>
                                <option value="pos">POS</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="mb-4" id="layanan">
                    </div>
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total Berat : <span id="total_berat">{{ $total_berat_cart }} Gram /
                                    {{ $total_berat_cart / 1000 }}
                                    KG</span>
                            </li>
                            <li>Subtotal : <span>{{ format_rupiah($subtotal_harga_cart) }}</span>
                            </li>
                            <li>Total Ongkir : <span id="total_ongkir">{{ format_rupiah(0) }}</span>
                            </li>
                            @if (auth()->user()->carts->count())
                                <li>Biaya Admin : <span>{{ format_rupiah(env('BIAYA_ADMIN')) }}</span>
                                </li>
                            @endif
                            <li>
                                <hr>
                            </li>
                            <li>Total Harga : <span id="total_harga">{{ format_rupiah($total_harga_cart) }}</span></li>
                        </ul>
                        <form action="{{ route('transaksi.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="total_berat_value" id="total_berat_value"
                                value="{{ $total_berat_cart }}">
                            <input type="hidden" name="subtotal_harga_value" id="subtotal_harga_value"
                                value="{{ $subtotal_harga_cart }}">
                            <input type="hidden" name="total_ongkir_value" id="total_ongkir_value">
                            <input type="hidden" name="biaya_admin_value" id="biaya_admin_value"
                                value="{{ env('BIAYA_ADMIN') }}">
                            <input type="hidden" name="total_harga_value" id="total_harga_value"
                                value="{{ $total_harga_cart }}">
                            <input type="hidden" name="kurir_value" id="kurir_value">
                            <input type="hidden" name="alamat_id_val" id="alamat_id_val">
                            <button id="checkout-btn" type="submit" class="primary-btn btn">Proceed to checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

@endsection
@push('js')
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        document.querySelectorAll('.delete-cart-item').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus data ini?',
                    text: "Aksi ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const produk_id = this.dataset.produkId;
                        const form = document.getElementById('delete-form');
                        form.action = `/cart/${produk_id}`;
                        form.submit();
                    }
                });
            });
        });
    </script>
    <script>
        $('#checkout-btn').off('click').on('click', function(e) {
            e.preventDefault();
            const alamatDipilih = $('input[name="alamat_id"]:checked');
            if (!alamatDipilih.length) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silakan pilih alamat pengiriman terlebih dahulu!',
                });
                return;
            }

            const hargaLayanan = $('input[name="layanan"]:checked');
            if (!hargaLayanan.length) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Silakan pilih layanan pengiriman terlebih dahulu!',
                });
                return;
            }
            this.form.submit();
        });
    </script>
    <script>
        document.querySelectorAll('input[name="alamat_id"]').forEach(input => {
            input.addEventListener('change', function() {
                $('#kurir').prop('disabled', false).val('Pilih Kurir').niceSelect('update');
                $('#layanan').html('');
                $('#alamat_id_val').val(this.value);
                $('#total_ongkir').html('{{ format_rupiah(0) }}');
                $('#total_harga').html('{{ format_rupiah($total_harga_cart) }}');
            });
        });
        $(document).ready(function() {
            $('#kurir').on('change', function() {
                const selectedKurir = $(this).val();
                $("#kurir_value").val(selectedKurir);
                const alamatId = $('input[name="alamat_id"]:checked').val();

                if (!alamatId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Silakan pilih alamat pengiriman terlebih dahulu!',
                    });
                    return;
                }

                $.ajax({
                    url: `/check_ongkir`,
                    type: 'GET',
                    data: {
                        kurir: selectedKurir,
                        alamat_id: alamatId,
                        total_berat: {{ $total_berat_cart }}
                    },
                    beforeSend: function() {
                        $("#preloder").css("display", "block");
                        $(".loader").css("display", "block");
                    },
                    success: function(response) {
                        const layananSelect = $('#layanan');
                        layananSelect.html('');
                        response.forEach(kurir => {
                            kurir.costs.forEach(cost => {
                                const radio = `<div class="form-check">
                                    <input class="form-check-input" type="radio" name="layanan" id="${kurir.code}-${cost.service}" value="${cost.cost[0].value}" />
                                    <label class="form-check-label" for="${kurir.code}-${cost.service}">
                                        ${cost.service} (${cost.description}) - ${(cost.cost[0].value)} - Estimasi: ${cost.cost[0].etd} hari
                                    </label>
                                </div>`;
                                layananSelect.append(radio);
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching shipping cost:', error);
                    },
                    complete: function() {
                        $("#preloder").css("display", "none");
                        $(".loader").css("display", "none");

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#kurir').on('change', function() {
                $('#layanan').html('');
                $('#total_ongkir').html('{{ format_rupiah(0) }}');
                $('#total_harga').html('{{ format_rupiah($total_harga_cart) }}');
            });

            $(document).on('change', 'input[name="layanan"]', function() {
                const ongkir = parseInt($(this).val());
                const totalHargaCart = parseInt({{ $total_harga_cart }});

                const ongkirFormatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(ongkir);

                const totalFormatted = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(ongkir + totalHargaCart);

                $('#total_ongkir').html(ongkirFormatted);
                $('#total_harga').html(totalFormatted);
                $('#total_ongkir_value').val(ongkir);
                $('#total_harga_value').val(ongkir + totalHargaCart);
                $("#alamat_id_value").val($('input[name="alamat_id"]:checked').val());
            });
        });
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
@endpush
