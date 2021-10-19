@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        <div id="flash" data-alert="{{ session()->get('create') }}"></div>

        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4 d-flex">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Pekerjaan</li>
            </ol>
        </nav>

        <div class="create card p-4 border border-2">
            <h4 class="text-center text-primary pb-3">Pekerjaan Baru</h4>
            <form action="{{ route('jobs.store') }}" method="post">
                @csrf
                @method('POST')
                <div class="d-flex justify-content-between">
                    <input type="text" style="width: 825px" name="name" class="form-control border-2 @error('name') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Masukan Pekerjaan Baru">
                    <button class="btn btn-primary rounded-lg px-4">Submit</button>
                </div>
                <div class="">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>
        </div>

        <section class="section">
            <div class="card border border-2">
                <div class="card-header d-flex justify-content-between border-bottom py-0 align-items-center">
                    {{-- Export & Import --}}
                    <div class="my-3">
                        <a class="btn btn-secondary" href="{{ route('job.print') }}" target="_blank">Print PDF</a>
                        <a class="btn btn-success" href="{{ route('jobExport') }}">Export</a>
                        <a class="btn btn-success" href="{{ route('jobExportTemplate') }}">Export Template</a>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('jobImportExcel') }}" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="file" name="file" required="required">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete All --}}
                    <div>
                        <a href="job/konfirmasiAll" class="btn btn-danger">Hapus Semua</a>
                    </div>
                </div>

                <div class="card-body mt-3 table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">No</th>
                                <th class="col-5">Pekerjaan</th>
                                <th class="text-center col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $job->name }}</td>
                                    <td class="col-2">
                                        <div class="d-flex justify-content-around align-items-center">
                                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning rounded-circle text-center" style="width: 35px; height: 35px; padding: 8px">
                                                <i class="bi bi-pencil-square text-white"></i>
                                            </a>
                                            <a href="job/{{ $job->id }}/konfirmasi" class="btn btn-danger rounded-circle" style="width: 35px; height: 35px; padding: 8px">
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
@endpush

@push('afterCss')
    <link rel="stylesheet" href="{{ asset('dist/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
@endpush
