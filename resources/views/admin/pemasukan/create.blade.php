@extends('layout.app_admin',['title_satu'=>'Form Tambah','title_dua'=>'Pemasukan'])

@push('btn-page-header')
<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <a href="{{ route('admin.pemasukan.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
            Kembali
        </a>
        <a href="{{ route('admin.pemasukan.index') }}" class="btn btn-secondary d-sm-none btn-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
        </a>
    </div>
</div>
@endpush
@section('page-body')
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<form action="{{ route('admin.pemasukan.store') }}" method="POST" class="card">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <label class="form-label required">Jenis</label>
                <div class="form-selectgroup">
                    <label class="form-selectgroup-item">
                        <input type="radio" name="jenis" value="Transfer" class="form-selectgroup-input" @if(@old('jenis') == 'Transfer') checked @endif checked>
                        <span class="form-selectgroup-label">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transfer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 10h-16l5.5 -6" /><path d="M4 14h16l-5.5 6" /></svg>
                            <span class="p-auto">Transfer</span>
                        </span>
                    </label>
                    <label class="form-selectgroup-item">
                        <input type="radio" name="jenis" value="Cash" class="form-selectgroup-input" @if(@old('jenis') == 'Cash') checked @endif>
                        <span class="form-selectgroup-label">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" /><path d="M12 7v10" /></svg>
                            <span class="p-auto">Cash</span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="form-label">
                    Rek. Bank/E-Dompet
                    <span class="text-yellow" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Isi jika kolom jenis : Transfer"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor" /></svg></span>
                </div>
                <select name="rekening_bank_dompet" class="form-select @error('rekening_bank_dompet') is-invalid @enderror" id="rekening-bank-dompet" data-placeholder="pilih rek. bank/e-dompet">
                    <option value=""></option>
                    @foreach ($rek_bank_dompet as $rbd)
                    <option value="{{ $rbd->id }}" @if(@old('rekening_bank_dompet') == $rbd->id) selected @endif>{{ $rbd->nomor_rekening }} - {{ $rbd->bank_dompet->nama }}</option>
                    @endforeach
                </select>
                @error('rekening_bank_dompet')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-lg-3 mb-3">
                <label class="form-label required">Nominal</label>
                <div>
                    <input type="text" name="nominal" class="form-control @error('nominal') is-invalid @enderror" value="{{ @old('nominal') }}" placeholder="Nominal..">
                    @error('nominal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="row">
                    <div class="col-lg-6">
                        <label class="form-label required">Tanggal</label>
                        <div>
                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ @old('tanggal',date('Y-m-d')) }}" placeholder="Tanggal..">
                            @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-label required">Waktu</label>
                        <div>
                            <input type="time" name="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ @old('waktu',date('H:i')) }}" placeholder="Waktu..">
                            @error('waktu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="col-lg-6">
                    <label class="form-label required">Deskripsi</label>
                    <div>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" cols="5" rows="5" placeholder="Di transfer oleh...">{{ @old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
$("#rekening-bank-dompet").select2({
    theme: "bootstrap-5",
});
</script>
@endpush
