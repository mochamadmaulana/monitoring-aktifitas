<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\BankDompet;
use App\Models\User;
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
        return view('admin.data-master.bank-dompet.index',compact('bank_dompet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data-master.bank-dompet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "jenis" => ["required"],
            "bank_dompet" => ["required","max:50"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menyimpan Bank/E-Dompet !')->withErrors($validator)->withInput();
        }
        BankDompet::create([
            'jenis' => $request->jenis,
            'nama' => $request->bank_dompet,
        ]);
        return back()->with('success','Berhasil menyimpan Bank/E-Dompet');
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
        return view('admin.data-master.bank-dompet.edit',compact('bank_dompet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "jenis" => ["required"],
            "bank_dompet" => ["required","max:50"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengedit Bank/E-Dompet !')->withErrors($validator)->withInput();
        }
        $bank_dompet = BankDompet::findOrFail($id);
        $bank_dompet->update([
            'jenis' => $request->jenis,
            'nama' => $request->bank_dompet,
        ]);
        return redirect()->route('admin.data-master.bank-dompet.index')->with('success','Berhasil mengedit Bank/E-Dompet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bank_dompet = BankDompet::findOrFail($id);
        $bank_dompet->delete();
        session()->flash('alert_success','Berhasil menghapus Bank/E-Dompet '.$bank_dompet->nama);
        return response()->json([
            'success' => true,
        ],200);
    }
}
