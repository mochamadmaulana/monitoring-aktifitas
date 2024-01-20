@extends('layout.app_admin',['title_satu'=>'Form Tambah','title_dua'=>'Rek. Bank/E-Dompet'])

@push('btn-page-header')
<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <a href="{{ route('admin.data-master.rekening-bank-dompet.index') }}" class="btn btn-secondary d-none d-sm-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" /></svg>
            Kembali
        </a>
        <a href="{{ route('admin.data-master.rekening-bank-dompet.index') }}" class="btn btn-secondary d-sm-none btn-icon">
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
<form action="{{ route('admin.data-master.rekening-bank-dompet.store') }}" method="POST" class="card">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 mb-3">
                <div class="form-label required">Bank/E-Dompet</div>
                <select name="bank_dompet" class="form-select @error('bank_dompet') is-invalid @enderror" id="bank-dompet" data-placeholder="pilih bank/e-dompet">
                    <option value=""></option>
                    @foreach ($bank_dompet as $bd)
                    <option value="{{ $bd->id }}" @if(@old('bank_dompet') == $bd->id) selected @endif>{{ $bd->nama }}</option>
                    @endforeach
                </select>
                @error('bank_dompet')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-lg-4 mb-3">
                <div class="form-label required">Pemilik</div>
                <select name="pemilik" class="form-select @error('pemilik') is-invalid @enderror" id="pemilik" data-placeholder="pilih pemilik">
                    <option value=""></option>
                    @foreach ($pengguna as $p)
                    <option value="{{ $p->id }}" @if(@old('pemilik') == $p->id) selected @endif>{{ $p->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('pemilik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-lg-4 mb-3">
                <label class="form-label required">Nomor Rekening</label>
                <div>
                    <input type="text" name="nomor_rekening" class="form-control @error('nomor_rekening') is-invalid @enderror" value="{{ @old('nomor_rekening') }}" placeholder="Nomor Rekening..">
                    @error('nomor_rekening')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
$("#bank-dompet").select2({
    theme: "bootstrap-5",
});
$("#pemilik").select2({
    theme: "bootstrap-5",
});
</script>
@endpush
