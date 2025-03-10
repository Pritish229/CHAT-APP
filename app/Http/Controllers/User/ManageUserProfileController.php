<?php

namespace App\Http\Controllers\User;

use App\Models\ManageUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManageUserProfileController extends Controller
{
    public function profilePage()
    {
        return view('User.Profile.Manage-Profile');
    }
    public function profileDetails($id)
    {
        if (is_numeric($id)) {
            $user = ManageUser::find($id);
            $profile_image = asset('storage/' . $user->image);
            if ($user) {
                return response()->json([
                    'data' => $user,
                    'profile_image' => $profile_image
                ]);
            }
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $user = ManageUser::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Update name and email
        $user->f_name = $request->f_name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->password !== null && $request->c_password !== null ) {
            
            
            if ($request->password === $request->c_password) {
                $user->password = Hash::make($request->password);
            } else {
                return response()->json(['error' => 'Passwords do not match'], 400);
            }
        }

        
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();
            $fileName = 'UserProfile/' . rand(10, 100000000) . time() . '.' . $extension;
            $file->storeAs('public', $fileName);
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
            $user->image = $fileName;
        }
        $user->save();

        return response()->json([
            'data' => $user,
            'status' => 'success',
        ]);
    }
}
