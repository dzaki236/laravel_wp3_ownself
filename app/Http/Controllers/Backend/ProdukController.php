<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\FotoProduk;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProdukController extends Controller
{

    public function index()
    {
        //
        $data['title'] = 'Produk';
        $data['page'] = 'produk';
        $data['produk'] = Produk::with(['kategori', 'by'])->latest()->paginate();
        return view('backend.produk.index', $data);
    }

    public function create()
    {
        //
        $data['title'] = 'Tambah produk baru';
        $data['page'] = 'produk';
        $data['kategori'] = Kategori::all();
        return view('backend.produk.create', $data);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            "nama_produk" => 'required',
            "kategori" => "required",
            "detail" => "nullable",
            "harga" => "required|numeric",
            "stock" => "required|numeric",
            "berat" => "required|numeric",
            "status" => "required",
        ]);
        // if ($request->hasFile('foto_produk')) {
        //     # code...
        //     $foto_produk = FileHelper::uploadToStorage($request->file('foto_produk'));
        // }
        $produk = new Produk([
            "nama_produk" => $request->nama_produk,
            // 'slug_produk' => Str::slug($request->nama_produk),
            "kategori_id" => $request->kategori,
            "detail" => $request->detail,
            "harga" => $request->harga,
            "stock" => $request->stock,
            "berat" => $request->berat,
            "status" => $request->status,
            "user_id" => auth()->user()->id,
            // "foto_produk" => $foto_produk,
        ]);
        $produk->save();
        return redirect()->route('backend.produk.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        //
        $data['title'] = 'Edit produk';
        $data['page'] = 'produk';
        $data['kategori'] = Kategori::all();
        $data['produk'] = Produk::with('foto')->where('id', $id)->firstOrFail();
        return view('backend.produk.edit', $data);
    }

    public function update(Request $request, $id)
    {
        //
        //
        $request->validate([
            "nama_produk" => 'required',
            "kategori" => "required",
            "detail" => "nullable",
            "harga" => "required",
            "stock" => "required",
            "berat" => "required",
            "status" => "required",
            "foto_produk" => "nullable|image|mimes:jpeg,jpg,png,gif",
        ]);
        $produk = Produk::find($id);
        $produk->update([
            "nama_produk" => $request->nama_produk,
            "kategori_id" => $request->kategori,
            "detail" => $request->detail,
            "harga" => $request->harga,
            "stock" => $request->stock,
            "berat" => $request->berat,
            'status' => $request->status,
            "user_id" => auth()->user()->id,
        ]);
        if ($request->hasFile('foto_produk')) {
            # code...
            $foto_produk = FileHelper::uploadToStorage($request->file('foto_produk'));
            FileHelper::deleteFromStorage($produk->foto_produk);
            $produk->update([
                "foto_produk" => $foto_produk,
            ]);
        }
        return redirect()->route('backend.produk.index')->with('success', 'Data melakukan perubahan data!');
    }

    public function destroy($id)
    {
        //
        $produk = Produk::find($id);
        if ($produk->foto_produk != null) {
            FileHelper::deleteFromStorage($produk->foto_produk);
        }
        $foto_produk = FotoProduk::where('produk_id', $id)->get();
        foreach ($foto_produk as $item) {
            # code...
            FileHelper::deleteFromStorage($item->foto_produk);
        }
        $produk->foto()->delete();
        $produk->delete();
        return redirect()->route('backend.produk.index')->with('success', 'Berhasil menghapus data!');
    }
    public function update_foto_produk(Request $request, $id)
    {
        //
        $request->validate([
            "foto_produk" => "required|image|mimes:jpeg,jpg,png,gif",
        ]);
        $folder = 'uploads/produk'; // Folder custom (bisa disesuaikan)
        $disk = 'public';
        $produk = Produk::find($id);
        if ($request->hasFile('foto_produk')) {
            # code...
            if ($produk->foto_produk != null) {
                # code...
                FileHelper::deleteFromStorage($produk->foto_produk);
            }
            $new_image_name = FileHelper::uploadToStorage(file: $request->file('foto_produk'), folder: $folder, disk: $disk);
            $produk->foto_produk = $new_image_name;
            if ($produk->save()) {
                return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.', 'name' => $new_image_name]);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
            }
        }
    }
}
