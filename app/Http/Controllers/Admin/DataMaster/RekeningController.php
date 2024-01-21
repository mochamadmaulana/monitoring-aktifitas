<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\BankDompet;
use App\Models\Rekening;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rekening = Rekening::latest()->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('admin.data-master.rekening.index',compact('rekening'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengguna = User::latest()->get();
        return view('admin.data-master.rekening.create',compact('pengguna'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "jenis" => ["required"],
            "nama_bank_dompet" => ["required","max:50"],
            "pemilik" => ["required"],
            "nomor_rekening" => ["required","max:20"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menyimpan rekening !')->withErrors($validator)->withInput();
        }
        Rekening::create([
            'jenis' => $request->jenis,
            'nama' => $request->nama_bank_dompet,
            'user_id' => $request->pemilik,
            'nomor_rekening' => $request->nomor_rekening,
        ]);
        return back()->with('success','Berhasil menyimpan rekening');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rekening = Rekening::findOrFail($id);
        $pengguna = User::latest()->get();
        return view('admin.data-master.rekening.edit',compact('rekening','pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "jenis" => ["required"],
            "nama_bank_dompet" => ["required","max:50"],
            "pemilik" => ["required"],
            "nomor_rekening" => ["required","max:20"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengedit rekening !')->withErrors($validator)->withInput();
        }
        $bank_dompet = Rekening::findOrFail($id);
        $bank_dompet->update([
            'jenis' => $request->jenis,
            'nama' => $request->nama_bank_dompet,
            'nomor_rekening' => $request->nomor_rekening,
        ]);
        return redirect()->route('admin.data-master.rekening.index')->with('success','Berhasil mengedit rekening');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rekening = Rekening::findOrFail($id);
        $rekening->delete();
        session()->flash('alert_success','Berhasil menghapus : '.$rekening->nama.' '.$rekening->nomor_rekening);
        return response()->json([
            'success' => true,
        ],200);
    }
}
