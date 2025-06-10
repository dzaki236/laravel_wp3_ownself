<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function index()
    {
        # code...
        $data['title'] = 'Profile';
        $data['page'] = 'profile';
        return view('frontend.profile.index', $data);
    }
    public function update(Request $request)
    {
        //
        $request->validate([
            "name" => 'required',
            // "email" => "required|email|unique:users,email," . auth()->user()->id,
            "phone" => "nullable|numeric|unique:users,phone," . auth()->user()->id,
            "password" => "nullable|min:6|confirmed",
        ]);
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        // $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->password != null) {
            # code...
            $user->password = bcrypt($request->password);
        }
        if ($user->save()) {
            return redirect()->back()->with('success', 'Berhasil melakukan perubahan data!');
        } else {
            return redirect()->back()->with('error', 'Gagal melakukan perubahan data!');
        }
    }

    public function update_foto_profile(Request $request)
    {
        # code...
        {
            //
            $request->validate([
                "foto_profile" => "required|image|mimes:jpeg,jpg,png,gif",
            ]);
            $folder = 'uploads/user'; // Folder custom (bisa disesuaikan)
            $disk = 'public';
            $user = User::find(auth()->user()->id);
            if ($request->hasFile('foto_profile')) {
                # code...
                if ($user->foto_profile != null) {
                    # code...
                    FileHelper::deleteFromStorage($user->foto_profile);
                }
                $new_image_name = FileHelper::uploadToStorage(file: $request->file('foto_profile'), folder: $folder, disk: $disk);
                $user->foto_profile = $new_image_name;
                if ($user->save()) {
                    return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.', 'name' => $new_image_name]);
                } else {
                    return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
                }
            }
        }
    }
}
