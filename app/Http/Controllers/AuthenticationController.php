<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('register');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($attributes);
        Auth::login($user);

        return redirect('/home');
    }

    public function login(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'error' => 'invalid credentials'
            ]);
        }

        return redirect('/home');
    }

    public function logout()
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect("/");
    }
}
