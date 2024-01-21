<?php

namespace App\Http\Controllers\Admin\Pemasukan;

use App\Http\Controllers\Controller;
use App\Models\PemasukanRekening;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasukan_rekening = PemasukanRekening::where('user_id',Auth::user()->id)->latest()->search(request('search'))->paginate(10)->onEachSide(0)->withQueryString();
        return view('admin.pemasukan-rekening.index',compact('pemasukan_rekening'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rekening = Rekening::where('user_id',Auth::user()->id)->latest()->get();
        return view('admin.pemasukan-rekening.create',compact('rekening'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "rekening_debit" => ['required'],
            "rekening_kredit" => ['required'],
            "nominal" => ["required","numeric"],
            "tanggal" => ["required"],
            "waktu" => ["required"],
            "deskripsi" => ["nullable","max:200"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal menyimpan pemasukan rekening !')->withErrors($validator)->withInput();
        }
        PemasukanRekening::create([
            'user_id' => Auth::user()->id,
            'rekening_id' => $request->rekening_debit,
            'rekening_kredit' => $request->rekening_kredit,
            'deskripsi' => $request->deskripsi,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu.date(':s',time()) ,
        ]);
        return back()->with('success','Berhasil menyimpan pemasukan Rp.'.number_format($request->nominal,0));
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
        $pemasukan_rekening = PemasukanRekening::findOrFail($id);
        $rekening = Rekening::where('user_id',Auth::user()->id)->latest()->get();
        return view('admin.pemasukan-rekening.edit',compact('pemasukan_rekening','rekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "rekening_debit" => ['required'],
            "rekening_kredit" => ['required'],
            "nominal" => ["required","numeric"],
            "tanggal" => ["required"],
            "waktu" => ["required"],
            "deskripsi" => ["nullable","max:200"],
        ]);
        if ($validator->fails()) {
            return back()->with('error','Gagal mengedit pemasukan rekening !')->withErrors($validator)->withInput();
        }
        $pemasukan_rekening = PemasukanRekening::findOrFail($id);
        $pemasukan_rekening->update([
            'rekening_id' => $request->rekening_debit,
            'rekening_kredit' => $request->rekening_kredit,
            'deskripsi' => $request->deskripsi,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu.date(':s',time()) ,
        ]);
        return redirect()->route('admin.pemasukan.rekening.index')->with('success','Berhasil mengedit pemasukan rekening');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemasukan_rekening = PemasukanRekening::findOrFail($id);
        $pemasukan_rekening->delete();
        $nominal = '(Rp.'.number_format($pemasukan_rekening->nominal,0).')';
        session()->flash('alert_success','Berhasil menghapus pemasukan '.$nominal.' pada '.$pemasukan_rekening->rekening->nama .' '.$pemasukan_rekening->rekening->nomor_rekening);
        return response()->json([
            'success' => true,
        ],200);
    }
}
