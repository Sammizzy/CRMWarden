<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {

        $lists = \App\Models\Lists::with('tasks')
            ->where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('auth.profile', compact('lists'));

        //get the authenticated user details
//        $account = Auth::user();

        //return the profile view with the authenticated user details
//        return view('auth.profile', ['account'=>$account]);





    }
}
