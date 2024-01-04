<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = User::latest()->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('data-master.pengguna.index',compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-master.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama_lengkap" => ["required"],
            "username" => ["required","unique:users,username"],
            "email" => ["required","email"],
            "password" => ["required","min:3"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal, Periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        if($request->username != trim(strtolower($request->username))){
            return back()->with('error','Gagal, Format username tidak sesuai!')->withErrors($validator)->withInput();
        }
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => strtolower($request->username),
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        $alert = 'Berhasil menyimpan : ' . $request->role . ' ' . $request->nama_lengkap;
        return back()->with('success',$alert);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return back()->with('error','Feature is under maintenance!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return back()->with('error','Feature is under maintenance!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return back()->with('error','Feature is under maintenance!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return back()->with('error','Feature is under maintenance!');
    }
}
