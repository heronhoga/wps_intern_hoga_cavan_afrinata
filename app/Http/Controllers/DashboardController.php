<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $email = session('email');
    $userRole = User::where('email', $email)->value('role');
    return view('dashboard.index', ['role' => $userRole]);
}

    public function users() {
    $email = session('email');
    $userRole = User::where('email', $email)->value('role');
    $users = User::all();
    return view('dashboard.users', ['users' => $users] , ['role' => $userRole]);
}
    
}
