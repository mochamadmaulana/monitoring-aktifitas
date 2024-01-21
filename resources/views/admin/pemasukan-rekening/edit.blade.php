@extends('layout.app_admin',['title_satu'=>'Form Edit','title_dua'=>'Pemasukan Rekening'])

@push('btn-page-header')
<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <a href="{{ route('admin.pemasukan.rekening.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
            Kembali
        </a>
        <a href="{{ route('admin.pemasukan.rekening.index') }}" class="btn btn-secondary d-sm-none btn-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
        </a>
    </div>
</div>
@endpush
@section('page-body')
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul>
        @foreach ($errors->all() as $error)
            <li class="fst-italic">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('admin.pemasukan.rekening.update',$pemasukan_rekening->id) }}" method="POST" class="card">
    @csrf
    @method('put')
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <div class="form-label">
                    Rekening Debit
                    <span class="text-yellow" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Rekening Penerima"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor" /></svg></span>
                </div>
                <select name="rekening_debit" class="form-select @error('rekening_debit') is-invalid @enderror" id="rekening-debit" data-placeholder="pilih rekening debit">
                    <option value=""></option>
                    @foreach ($rekening as $rbd)
                    <option value="{{ $rbd->id }}" @if(@old('rekening_debit',$pemasukan_rekening->rekening_id) == $rbd->id) selected @endif>{{ $rbd->nomor_rekening }} - {{ $rbd->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 mb-3">
                <label class="form-label required">
                    Rekening Kredit
                    <span class="text-yellow" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Rekening Pengirim"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor" /></svg></span>
                </label>
                <div>
                    <input type="text" name="rekening_kredit" class="form-control @error('rekening_kredit') is-invalid @enderror" value="{{ @old('rekening_kredit',$pemasukan_rekening->rekening_kredit) }}" placeholder="Rekening Kredit..">
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <label class="form-label required">Nominal</label>
                <div>
                    <input type="text" name="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ @old('nominal',$pemasukan_rekening->nominal) }}" placeholder="Nominal..">
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="form-label required">Tanggal</label>
                        <div>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ @old('tanggal',$pemasukan_rekening->tanggal) }}" placeholder="Tanggal..">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label required">Waktu</label>
                        <div>
                            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ @old('waktu',substr($pemasukan_rekening->waktu,0,5)) }}" placeholder="Waktu..">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="col-lg-6">
                    <label class="form-label">Deskripsi</label>
                    <div>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" cols="5" rows="5" placeholder="Untuk uang jajan selama 1 bulan...">{{ @old('deskripsi',$pemasukan_rekening->deskripsi) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
            Simpan
        </button>
    </div>
</form>
@endsection

@push('js')
<script>
$("#rekening-debit").select2({
    theme: "bootstrap-5",
});
</script>
@endpush
