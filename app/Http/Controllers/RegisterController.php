<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('modules.register.register');
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = new User;
        $user->email = $email;
        // Hasher dapat diganti di app config->Hashing
        $user->password = Hash::make($password);
        $user->username = 'faris';
        $user->name = 'faris';
        $user->save();

        return redirect()
            ->route('auth.login');
    }
}
