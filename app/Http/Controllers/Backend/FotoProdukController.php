<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\FotoProduk;
use Illuminate\Http\Request;

class FotoProdukController extends Controller
{
    public function store(Request $request, $produk_id)
    {
        //
        $request->validate([
            "galery_foto_produk" => "required|image|mimes:jpeg,jpg,png,gif",
        ]);
        $folder = 'uploads/produk'; // Folder custom (bisa disesuaikan)
        $disk = 'public';
        $produk = new FotoProduk();
        $produk->produk_id = $produk_id;
        if ($request->hasFile('galery_foto_produk')) {
            # code...
            $new_image_name = FileHelper::uploadToStorage(file: $request->file('galery_foto_produk'), folder: $folder, disk: $disk);
            $produk->foto_produk = $new_image_name;
            if ($produk->save()) {
                return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.', 'name' => $new_image_name]);
            } else {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
            }
        }
    }

    public function destroy($id)
    {
        //
        $produk = FotoProduk::find($id);
        if ($produk->foto_produk != null) {
            FileHelper::deleteFromStorage($produk->foto_produk);
        }
        $produk->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}
