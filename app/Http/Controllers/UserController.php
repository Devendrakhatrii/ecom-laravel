<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(User::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedCredentials = $request->validate([
            'first_name' => ['required'],
            'middle_name' => [],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'address' => ['max:50'],
            'password' => ['required', 'confirmed', Password::min(6)->numbers()->letters()],
        ]);

        $user = User::create($validatedCredentials);
        Auth::login($user);
        if (Auth::user()) {
            if ((new CartController)->create()) {

                return redirect('/dashboard');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::id() == $id) {
            $user = Auth::user();
            return view('profile', ['data' => $user]);
        }

        return redirect('/login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
