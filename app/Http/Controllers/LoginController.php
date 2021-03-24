<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('modules.auth.dashboard_login');
    }

    public function show()
    {
        return view('modules.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $credentials = $request->only('email', 'password');
        $request->session()->passwordConfirmed();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()
                ->intended('/');
        }
        return back()->withErrors([
            'error' => 'Autentikasi Gagal'
        ]);
    }
}
