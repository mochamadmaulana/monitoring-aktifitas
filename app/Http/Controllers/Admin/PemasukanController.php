<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\RekeningBankDompet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasukan = Pemasukan::latest()->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('admin.pemasukan.index',compact('pemasukan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rek_bank_dompet = RekeningBankDompet::where('user_id',1)->latest()->get();
        return view('admin.pemasukan.create',compact('rek_bank_dompet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "rekening_bank_dompet" => ['required_if:jenis,Transfer'],
            "nominal" => ["required","numeric"],
            "tanggal" => ["required"],
            "waktu" => ["required"],
            "deskripsi" => ["required","max:200"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal, Periksa kembali inputan!')->withErrors($validator)->withInput();
        }
        $rek_bank_dompet = $request->jenis == 'Cash' ? NULL : $request->rekening_bank_dompet;
        Pemasukan::create([
            'jenis' => $request->jenis,
            'user_id' => 1, //Auth::user()->id
            'rekening_bank_dompet_id' => $rek_bank_dompet,
            'deskripsi' => $request->deskripsi,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu . ':' . 00,
        ]);
        return back()->with('success','Berhasil menyimpan pemasukan Rp. '.number_format($request->nominal,0).' '.$request->jenis);
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
        return view('admin.pemasukan.edit',compact('rek_bank_dompet','bank_dompet','pengguna'));
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
        return redirect()->route('admin.pemasukan.index')->with('success','Berhasil mengedit rekening bank/e-dompet');
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
