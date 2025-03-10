<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function userDashBoardPage(){
        return view('User.Dashboard.Home');
    }
}
