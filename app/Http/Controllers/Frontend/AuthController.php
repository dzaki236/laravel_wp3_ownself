<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //
    public function redirect(Request $request)
    {
        return Socialite::driver('secure-google')->redirect();
    }
    public function callback()
    {
        # code...
        try {
            //code...
            $user = Socialite::driver('secure-google')->stateless()->user();
            $checkUser = \App\Models\User::where('email', $user->email)->first();
            if ($checkUser) {
                $checkUser->google_id = $user->id;
                $checkUser->google_token = $user->token;
                $checkUser->save();
                Auth::login($checkUser);
                alert('Success!', 'Login Successfully', 'success');
                return redirect('/')->with('success', 'Login Successfully');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'google_token' => $user->token,
                    'password' => encrypt('123456dummy'),
                ]);
                Auth::login($newUser);
                alert('Success!', 'Login Successfully', 'success');
                return redirect('/')->with('success', 'Login Successfully');
            }
        } catch (\Exception $e) {
            return redirect('/');
            // return response()->json([
            //     'status' => false,
            //     'message' => $e->getMessage(),
            // ], 500);
        }
    }
    public function logout(Request $request)
    {
        # code...
        if ($request->ajax()) {
            # code...
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            alert('Success!', 'Logout Successfully', 'success');
            return response()->json(['status' => true, 'message' => 'Logout Successfully']);
        }
        return response()->json(['status' => false, 'message' => 'Logout Failed']);
    }
}
