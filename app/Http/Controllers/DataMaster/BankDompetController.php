<?php

namespace App\Http\Controllers\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\BankDompet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankDompetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bank_dompet = BankDompet::latest()->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('data-master.bank-dompet.index',compact('bank_dompet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-master.bank-dompet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nama_bank_dompet" => ["required","max:100"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal, Periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        BankDompet::create([
            'jenis' => $request->jenis,
            'nama_bank_dompet' => $request->nama_bank_dompet,
        ]);
        $alert = 'Berhasil menyimpan : ' . $request->jenis . ' ' . $request->nama_bank_dompet;
        return back()->with('success',$alert);
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
        $bank_dompet = BankDompet::findOrFail($id);
        return view('data-master.bank-dompet.edit',compact('bank_dompet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "nama_bank_dompet" => ["required","max:100"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal, Periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        $bank_dompet = BankDompet::findOrFail($id);
        $bank_dompet->jenis = $request->jenis;
        $bank_dompet->nama_bank_dompet = $request->nama_bank_dompet;
        $bank_dompet->update();
        $alert = 'Berhasil mengedit menjadi : ' . $request->jenis . ' ' . $request->nama_bank_dompet;
        return redirect()->route('data-master.bank-dompet.index')->with('success',$alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bank_dompet = BankDompet::findOrFail($id);
        $bank_dompet->delete();
        session()->flash('success','Berhasil menghapus : '.$bank_dompet->nama_bank_dompet);
        return response()->json([
            'success' => true,
        ],200);
    }
}
