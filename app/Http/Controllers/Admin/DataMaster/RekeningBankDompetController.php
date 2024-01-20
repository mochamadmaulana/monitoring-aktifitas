<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\BankDompet;
use App\Models\RekeningBankDompet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekeningBankDompetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rek_bank_dompet = RekeningBankDompet::latest()->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('admin.data-master.rekening-bank-dompet.index',compact('rek_bank_dompet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bank_dompet = BankDompet::latest()->get();
        $pengguna = User::latest()->get();
        return view('admin.data-master.rekening-bank-dompet.create',compact('bank_dompet','pengguna'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "bank_dompet" => ["required"],
            "pemilik" => ["required"],
            "nomor_rekening" => ["required","max:25"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal, Periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        RekeningBankDompet::create([
            'bank_dompet_id' => $request->bank_dompet,
            'user_id' => $request->pemilik,
            'nomor_rekening' => $request->nomor_rekening,
        ]);
        return back()->with('success','Berhasil menyimpan rekening bank/e-dompet');
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
        $rek_bank_dompet = RekeningBankDompet::findOrFail($id);
        $bank_dompet = BankDompet::latest()->get();
        $pengguna = User::latest()->get();
        return view('admin.data-master.rekening-bank-dompet.edit',compact('rek_bank_dompet','bank_dompet','pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "bank_dompet" => ["required"],
            "pemilik" => ["required"],
            "nomor_rekening" => ["required","max:25"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal, Periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        $bank_dompet = RekeningBankDompet::findOrFail($id);
        $bank_dompet->update([
            'bank_dompet_id' => $request->bank_dompet,
            'user_id' => $request->pemilik,
            'nomor_rekening' => $request->nomor_rekening,
        ]);
        return redirect()->route('admin.data-master.rekening-bank-dompet.index')->with('success','Berhasil mengedit rekening bank/e-dompet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rek_bank_dompet = RekeningBankDompet::findOrFail($id);
        $rek_bank_dompet->delete();
        session()->flash('success','Berhasil menghapus : '.$rek_bank_dompet->bank_dompet->nama.' '.$rek_bank_dompet->nomor_rekening);
        return response()->json([
            'success' => true,
        ],200);
    }
}
