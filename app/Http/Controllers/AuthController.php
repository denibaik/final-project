<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login_page()
    {
        return view('auth.login');
    }

    function register_page()
    {
        return view('auth.register');
    }

    function register_process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password)
        ];

        try {
            User::create($data);
            return redirect(route('login'))->with('success', 'Akun dibuat');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sisi server');
        }
    }

    function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::user()->role == 'Admin')
                    return redirect(route('admin'))->with('success', 'Selamat datang Admin');
                else
                    return redirect('/')->with('success', 'Selamat datang ' . Auth::user()->name);
            } else {
                return redirect()->back()->with('error', 'Akun tidak ditemukan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sisi server');
        }
    }

    function logout_process()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
