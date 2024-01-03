@extends('layout.app',['title_satu'=>'View','title_dua'=>'Bank/E-Dompet'])

@push('btn-page-header')
<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <a href="{{ route('data-master.bank-dompet.create') }}" class="btn btn-primary d-none d-sm-inline-block" >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            Bank/E-Dompet
        </a>
        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
        </a>
    </div>
</div>
@endpush
@section('page-body')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="col-12">
    <div class="card">
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="ms-auto text-muted">
                    Search:
                    <div class="mx-2 d-inline-block">
                        <input type="search" name="search" class="form-control form-control-md" placeholder="Cari disini..">
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-vcenter table-mobile-md card-table table-hover">
                <thead>
                    <tr>
                        <th>Bank/E-Dompet</th>
                        <th>Jenis</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bank_dompet as $bd)
                    <tr>
                        <td>{{ $bd->nama_bank_dompet }}</td>
                        <td>{{ $bd->jenis }}</td>
                        <td>
                            <div class="btn-list flex-nowrap float-end">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('data-master.bank-dompet.edit',$bd->id) }}">
                                            Edit
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        {{-- <td>
                            <a href="#" class="fs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                Edit
                            </a>
                            <a href="#" class="mx-1 fs-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                Hapus
                            </a>
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
