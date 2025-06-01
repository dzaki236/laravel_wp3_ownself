<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        # code...
        $data['title'] = 'Keranjang Belanja';
        $data['page'] = 'keranjang';
        $cart_query = auth()->user()->carts;
        $cart = $cart_query;
        $data['cart'] = $cart;
        $total_harga = 0;
        foreach ($cart as $item_cart) {
            # code...
            $total_harga += $item_cart->total_harga;
        }
        $total_berat_cart = 0;
        foreach ($cart as $item_cart) {
            # code...
            $total_berat_cart += $item_cart->total_berat;
        }
        $biaya_admin = 0;
        if (auth()->user()->carts->count() > 0) {
            # code...
            $biaya_admin = 1000;
        }
        $data['total_harga_cart'] = $total_harga + $biaya_admin;
        $data['subtotal_harga_cart'] = $total_harga;
        $data['total_berat_cart'] = $total_berat_cart;
        return view('frontend.cart.index', $data);
    }
    public function add_to_cart($produk_id, Request $request)
    {
        # code...
        $produk = Produk::findOrFail($produk_id);
        if ($produk->status == 'archived') {
            # code...
            return redirect()->back()->with('error', 'Produk tidak aktif.');
        }
        $cart = Cart::where('produk_id', $produk->id)->where('user_id', auth()->id())->first();
        if ($cart) {
            // Jika produk sudah ada di keranjang, tambahkan jumlahnya
            $cart->qty += $request->input('qty', 1); // Ambil qty dari request, default 1
            // Simpan perubahan pada keranjang
            if ($cart->qty < 1) {
                return redirect()->back()->with('error', 'Jumlah produk tidak boleh kurang dari 1.');
            }

            if ($request->input('qty', 1) < 1) {
                return redirect()->back()->with('error', 'Jumlah produk tidak boleh kurang dari 1.');
                # code...
            }
            if ($request->input('qty', 1) > $produk->stock || $cart->qty > $produk->stock) {
                return redirect()->back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
            }

            $cart->save();
        } else {
            // Jika produk belum ada di keranjang, buat entri baru
            Cart::create([
                'user_id' => auth()->user()->id,
                'produk_id' => $produk->id,
                'qty' => $request->input('qty', 1), // Ambil qty dari request, default 1
            ]);
        }
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }
    public function delete_item_cart($produk_id)
    {
        # code...
        $cart = Cart::where('produk_id', $produk_id)->where('user_id', auth()->user()->id)->first();
        if ($cart) {
            $cart->delete();
            return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
        }
        return redirect()->back()->with('error', 'Produk tidak ditemukan di keranjang.');
    }
    public function update_cart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|array',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
        ]);
        foreach ($request->cart_id as $index => $cart_id) {
            $cart = Cart::where('id', $cart_id)->first();
            if ($cart && $cart->user_id == auth()->user()->id) {
                $qty = $request->qty[$index];
                if ($qty < 1) {
                    return redirect()->back()->with('error', 'Jumlah produk tidak boleh kurang dari 1.');
                }
                if ($qty > $cart->produk->stock) {
                    return redirect()->back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
                }
                $cart->qty = $qty;
                $cart->save();
            }
        }
        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui.');
    }
}
