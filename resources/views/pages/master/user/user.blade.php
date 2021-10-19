@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">

        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
            <ol>
                <a href="{{ route('users.create') }}" class="btn btn-primary" style="font-weight: bold;">
                    Tambah Data
                </a>
            </ol>
        </nav>

        <section class="section">
            <div class="card border border-2">
                <div class="card-header d-flex justify-content-end border-bottom py-0 align-items-center">
                    {{-- Delete All --}}
                    <div class="my-3">
                        <a href="user/konfirmasiAll" class="btn btn-danger">Hapus Semua</a>
                    </div>
                </div>

                <div class="card-body mt-3 table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="col-2">
                                        <div class="d-flex justify-content-around align-items-center">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning rounded-circle text-center" style="width: 35px; height: 35px; padding: 8px">
                                                <i class="bi bi-pencil-square text-white"></i>
                                            </a>
                                            <a href="user/{{ $user->id }}/konfirmasi" class="btn btn-danger rounded-circle" style="width: 35px; height: 35px; padding: 8px">
                                                <i class="bi bi-trash text-white"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('afterScript')
    <script src="{{ asset('dist/assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table = document.querySelector('#table');
        let dataTable = new simpleDatatables.DataTable(table);
    </script>

    <script src="{{ asset('dist/assets/js/extensions/sweetalert2.js') }}"></script>
    <script src="{{ asset('dist/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- Filter --}}
    {{-- <script type="text/javascript">
        let role = $("#filter-role").val()
        $(".filter").on('change',function() {
            role = $("#filter-role").val()
            console.log(role)
        })
    </script> --}}
@endpush

@push('afterCss')
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
