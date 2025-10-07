<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        //retrieve the authenticated account details
        $account = Auth::user();
        //return the home view with the account details
        return view('layouts.home',['account'=>$account]);
    }
}
