<?php

namespace App\Http\Controllers\Auth;

use App\Models\ManageUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function loginPage(Request $request)
    {
        if ($request->session()->has('user_id')) {

            $userRole = $request->session()->get('user_role');
            if ($userRole == 0) {
                return redirect('/Admin');
            } else {
                return redirect('/User');
            }
        }

        // If not logged in, show the login page
        return view('auth.Login');
    }

    public function registerPage(Request $request)
    {
        if ($request->session()->has('user_id')) {

            $userRole = $request->session()->get('user_role');
            if ($userRole == 0) {
                return redirect('/Admin');
            } else {
                return redirect('/User');
            }
        }
        return view('auth.Register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'f_name' => 'required',
            'email' => 'required|email|unique:manage_users',
            'phone_no' => 'required|max:10|unique:manage_users',
            'password' => 'required',
            'c_password' => 'same:password'
        ]);

        // Hash the password
        $f_name = $request->f_name;
        $email = $request->email;
        $phone_no = $request->phone_no;
        $password = bcrypt($request->password);

        $user = ManageUser::create([
            'f_name' => $f_name,
            'email' => $email,
            'phone_no' => $phone_no,
            'password' => $password,
            'user_role' => 1
        ]);

        if ($user) {
            $request->session()->put('user_id', $user->id);
            $request->session()->put('user_role', $user->user_role);
        }  

        return response()->json([
           'success' => true,
           'message' => 'User registered successfully',
            'user' => $user,
            'redirect_url' =>"/User",
        ]);
        


    }

    public function checkLogin(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Fetch user based on email
        $user = ManageUser::where('email', $request->email)->first();
        // dd($user);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ]);
        }

        if ($user) {
            
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('user_id', $user->id);
                $request->session()->put('user_role', $user->user_role);

                return response()->json([
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $user,
                    'redirect_url' => $user->user_role == 0 ? "/Admin" : "/User",

                ]);
                
            } else {
                // return response()->json([
                //     'status' => false,
                //     'message' => 'Password or email is incorrect'
                // ]);
            }
        }
    }

    public function logout(Request $request)
    {
        session()->pull('user_id');
        session()->pull('user_role');
        
        return redirect('/Login')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
       
    }
}
