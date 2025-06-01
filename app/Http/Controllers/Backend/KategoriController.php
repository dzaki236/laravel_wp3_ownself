<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        //
        $data['title'] = 'Kategori';
        $data['page'] = 'kategori';
        $data['kategori'] = Kategori::latest()->paginate();
        return view('backend.kategori.index', $data);
    }
    public function create()
    {
        //
        $data['title'] = 'Tambah kategori baru';
        $data['page'] = 'kategori';
        return view('backend.kategori.create', $data);
    }

    public function store(Request $request)
    {
        //
        $request->validate(['nama_kategori' => 'required|unique:kategori,nama_kategori']);
        Kategori::create($request->only('nama_kategori'));
        return redirect()->route('backend.kategori.index')->with('success', 'Berhasil menambahkan data baru!');
    }

    public function edit($id)
    {
        //
        $data['title'] = 'Edit kategori baru';
        $data['page'] = 'kategori';
        $kategori = Kategori::find($id);
        $data['kategori'] = $kategori;
        return view('backend.kategori.edit', $data);
    }

    public function update(Request $request, $id)
    {
        //
        $kategori = Kategori::find($id);
        $kategori->update($request->only('nama_kategori'));
        return redirect()->route('backend.kategori.index')->with('success', 'Berhasil melakukan perubahan data!');
    }

    public function destroy($id)
    {
        //
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->route('backend.kategori.index')->with('success', 'Berhasil menghapus data!');
    }
}
