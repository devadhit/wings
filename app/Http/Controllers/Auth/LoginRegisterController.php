<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('username','password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('product.index')->withSuccess('You have successfully registered & logged in!');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authentication(Request $request)
    {
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password]))
        {
            $request->session()->regenerate();
            return redirect()->route('product.index')->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors([
            'username' => 'Your provided credentials do not match in our records.',
        ])->onlyInput('username');
    }

    public function dashboard()
    {
        if(Auth::check())
        {
            return view('layouts.app');
        }

        return redirect()->route('login')
            ->withErrors([
            'username' => 'Please login to access the dashboard.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess('You have logged out successfully!');;
    }
}
