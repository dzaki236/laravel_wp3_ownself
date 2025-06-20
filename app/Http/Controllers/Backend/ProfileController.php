<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        //
        $data['title'] = 'Profile Admin';
        $data['page'] = 'profile-admin';
        return view('backend.profile.index', $data);
    }

    public function update(Request $request)
    {
        //
        $user_id = $request->has('user_id') ? $request->user_id : auth()->user()->id;
        $request->validate([
            "name" => 'required',
            "email" => "required|email|unique:users,email," . $user_id,
            "phone" => "nullable|numeric|unique:users,phone," . $user_id,
            "password" => "nullable|min:6|confirmed",
        ]);
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->has('user_id')) {
            # code...
            if ($request->role != null) {
                $user->role = $request->role;
            }
            if ($request->status != null) {
                $user->status = $request->status;
            }
        }
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

    public function update_foto_profile(Request $request, $id)
    {
        # code...
        {
            //
            $request->validate([
                "foto_profile" => "required|image|mimes:jpeg,jpg,png,gif",
            ]);
            $folder = 'uploads/user'; // Folder custom (bisa disesuaikan)
            $disk = 'public';
            $user = User::find($id);
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
