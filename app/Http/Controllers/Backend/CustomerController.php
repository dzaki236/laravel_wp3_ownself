<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $data['title'] = 'Customer Management';
        $data['page'] = 'customer';
        $data['customers'] = User::where('role', 'customer')->get();
        return view('backend.customer.index', $data);
    }
    public function edit($id)
    {
        $data['title'] = 'Edit Customer';
        $data['page'] = 'customer';
        $data['customer'] = User::findOrFail($id);
        return view('backend.customer.edit', $data);
    }
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        if ($customer->delete()) {
            return redirect()->route('backend.customer.index')->with('success', 'Berhasil menghapus data!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus customer!');
        }
    }
}
