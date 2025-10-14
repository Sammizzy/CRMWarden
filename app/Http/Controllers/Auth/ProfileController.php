<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        //get the authenticated user details
        $account = Auth::user();

        //return the profile view with the authenticated user details
        return view('auth.profile', ['account'=>$account]);

    }
}
