<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }

    public function registerView() {
        return view('guest.register');
    }

    public function register(Request $request) {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role' => 'required'
    ]);

    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->role = $request->input('role');
    $user->save();

    return redirect()->route('login')->with('message', 'successreg');
}

    public function loginView() {
        return view('guest.login');
    }

    public function login(Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        return redirect()->intended('home');
    }

    return redirect()->route('login')->with('message', 'faillogin');
}
}