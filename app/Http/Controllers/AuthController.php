<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    // MENAMPILKAN HALAMAN LOGIN
    public function showLoginForm()
    {
        return view('login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        $data = $request->only('email','password');

        if(Auth::attempt($data)){

            if(Auth::user()->role == 'admin'){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/user/dashboard');
            }

        }

        return back()->with('error','Login gagal');
    }

    // MENAMPILKAN HALAMAN REGISTER
    public function showRegisterForm()
    {
        return view('register');
    }

    // PROSES REGISTER
    public function register(Request $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect('/login');

    }

}