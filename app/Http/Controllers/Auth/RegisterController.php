<?php

namespace App\Http\Controllers\Auth;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //show registration form
    public function showRegisterForm()
    {
        return view('auth.registration');
    }

    //handle registration
    public function register(Request $request)
    {
        //validates request data
        $data = $request->validate([
            'username' => 'required|string|max:50|unique:accounts',
            'email' => 'required|string|email|max:50|unique:accounts',
            'password' => 'required|string|min:8',
        ]);

        //create new account
        $account = Account::create([
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        ]);

        //Authenticate the new account
        Auth::login($account);

        //redirect to homepage
        return redirect()->route('home');
    }
}
