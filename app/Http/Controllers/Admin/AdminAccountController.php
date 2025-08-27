<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminAccountController extends Controller
{
    public function adminProfile()
    {
        $user = User::find(Auth::user()->user_id);
        return view('admin.admin_account.admin_profile', compact('user'));
    }

    public function AdminProfileUpdate(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:user,email,' . Auth::user()->user_id . ',user_id',

        ];
        if (!empty($request->img)) {
            $rules['img'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.admin.profile')->withInput()->withErrors($validator);
        }

        $user = User::find(Auth::user()->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        if (!empty($request->img)) {
            File::delete('uploads/profile/' . $user->img);
            File::delete('uploads/profile/thumb/' . $user->img);
            $img = $request->img;
            $ext = $img->getClientOriginalExtension();
            $imgName = time() . '.' . $ext;
            $img->move(public_path('uploads/profile'), $imgName);
            $user->img = $imgName;
            $user->save();
            $manager = new ImageManager(Driver::class);
            $image = $manager->read(public_path('uploads/profile/' . $imgName));
            $image->cover(150, 150);
            $image->save('uploads/profile/thumb/' . $imgName);
        }
        return redirect()->route('admin.admin.profile')->with('success', 'Profile updated successfully.');
    }
}
