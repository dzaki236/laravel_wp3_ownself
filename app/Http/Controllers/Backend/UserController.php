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
    public function create()
    {
        $data['title'] = 'Create User';
        $data['page'] = 'user';
        return view('backend.user_management.user.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,super_admin', // Adjust roles as needed
            'status' => 'required|in:active,inactive', // Optional status field
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->status = $request->status ?? 'active'; // Default to active if not provided
        if ($user->save()) {
            return redirect()->route('backend.user.index')->with('success', 'Berhasil menambahkan user baru!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan user baru!');
        }
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
