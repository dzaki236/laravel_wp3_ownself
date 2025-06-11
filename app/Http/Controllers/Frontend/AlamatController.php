<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Province;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    //
    public function index()
    {
        # code...
        $data['title'] = 'Alamat';
        $data['page'] = 'alamat';
        $data['alamat'] = Alamat::where('user_id', auth()->user()->id)->get();
        return view('frontend.alamat.index', $data);
    }
    public function create()
    {
        # code...
        $data['title'] = 'Alamat';
        $data['page'] = 'alamat';
        $data['province'] = Province::all();
        return view('frontend.alamat.create', $data);
    }
    public function store(Request $request)
    {
        # code...
        $this->validate($request, [
            '*' => 'required',
            'no_hp' => 'numeric|regex:/^[0-9]{8,16}$/',
            'kode_pos' => 'numeric',
        ]);
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        Alamat::create($data);
        return redirect()->route('alamat.index')->with('success', 'Berhasil menambah data!');
    }
    public function update(Request $request, $id)
    {
        # code...
        $this->validate($request, [
            '*' => 'required',
            'no_hp' => 'numeric|regex:/^[0-9]{8,16}$/',
            'kode_pos' => 'numeric',
        ]);
        $data = $request->all();
        $alamat = Alamat::find($id);
        $alamat->update($data);
        return redirect()->route('alamat.index')->with('success', 'Berhasil mengubah data!');
    }
    public function edit($id)
    {
        # code...
        $data['title'] = 'Alamat';
        $data['page'] = 'alamat';
        $data['province'] = Province::all();
        $data['alamat'] = Alamat::find($id);
        return view('frontend.alamat.edit', $data);
    }
    public function destroy($id)
    {
        # code...
        $alamat = Alamat::find($id);
        $alamat->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}
