<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        # code...
        $data['title'] = 'User List';
        $data['page'] = 'user';
        $data['users'] = User::where('role', '!=', 'customer')->where('id', '!=', auth()->user()->id)->get(); // Exclude customers
        return view('backend.user_management.user.index', $data);
    }
    public function edit($id)
    {
        $data['title'] = 'Edit User';
        $data['page'] = 'user';
        $data['user'] = User::findOrFail($id);
        return view('backend.user_management.user.edit', $data);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return redirect()->route('backend.user.index')->with('success', 'Berhasil menghapus data!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
    }
}
