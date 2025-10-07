<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|max:50',
            'password' => 'required|string',
        ]);
        //Attempt to log in using provided credentials and the Auth Facade
        if (Auth::attempt($credentials)) {
            //Regenerate the session to prevent session fixation
            $request->session()->regenerate();

            //redirect to intended page
            return redirect()->intended('/');
        }
        //invalid login, gives error
        return back()->withErrors([
            'username' => 'Invalid username or password.',
        ])->withInput();
    }

    //handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        //invalidates session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
