<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login()
    {
        # code...
        return view('backend.auth.login');
    }
    public function logout(Request $request)
    {
        # code...
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('backend.auth');
    }
    public function login_process(Request $request)
    {
        # code...
        $this->validate($request, ['*' => 'required'], ['*.required' => 'Field tidak boleh kosong!']);
        $user = User::where('email', $request->email)->where('status', 'aktif')->whereIn('role', ['admin', 'super_admin'])->first();
        if (!$user) {
            # code...
            return redirect()->back()->with('error', 'User tidak ditemukan!')->withInput();
        }
        if (!Hash::check($request->password, $user->password)) {
            # code...
            return redirect()->back()->with('error', 'Password salah!')->withInput();
        }
        if (Auth::login($user, remember: true)) {
            # code...
            request()->session()->regenerate();
            return redirect()->intended(route('backend.dashboard.index'));
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan!')->withInput();
        }
    }
}
