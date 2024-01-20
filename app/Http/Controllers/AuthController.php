<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal, Harap periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        $pengguna = User::where('username',$request->username)->first();
        if (!empty($pengguna) ) {
            if (!empty($pengguna) && Hash::check($request->password, $pengguna->password)) {
                if ($pengguna->role === 'Admin') {
                    Auth::login($pengguna);
                    return redirect()->route('admin.dashboard')->with('success', 'Berhasil, Selamat beraktifitas..');
                }else{
                    // Auth::login($pengguna);
                    // return redirect()->route('dashboard')->with('success', 'Login berhasil, Selamat beraktifitas..');
                    return back()->with('error', 'Fitur Role'.$pengguna->role.' sedang dikembangkan!');
                }
            }else {
                return back()->with('error','Gagal, Harap periksa kembali inputan!')->withErrors($validator)->withInput();
            }
        } else {
            return back()->with('error','Gagal, Harap periksa kembali inputan!')->withErrors($validator)->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login')->with("success", "Berhasil, sampai jumpa kembali..");
    }
}
