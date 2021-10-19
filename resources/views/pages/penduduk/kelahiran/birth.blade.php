@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">

        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Kelahiran</li>
            </ol>
            @if(Auth::user()->role != 'Watcher')
                <ol>
                    <a href="{{ route('births.create') }}" class="btn btn-primary" style="font-weight: bold;">
                        Tambah Data
                    </a>
                </ol>
            @endif
        </nav>

        <section class="section">
            <div class="card border border-2">
                <div class="card-header py-0 border-bottom d-flex align-items-center justify-content-between">
                    {{-- Export & Import --}}
                    <div class="my-3">
                        <a class="btn btn-secondary" href="{{ route('birth.print') }}" target="_blank">Print PDF</a>
                        <a class="btn btn-success" href="{{ route('birth.export') }}">Export</a>
                        <a class="btn btn-success" href="{{ route('birth.exportTemplate') }}">Export Template</a>
                        {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('birth.import') }}" method="post" enctype="multipart/form-data">
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
                        </div> --}}
                    </div>
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center" style="margin-right: 10px" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                            <i class="bi bi-funnel-fill" style="margin-right: 10px"></i>
                            <span>Filter</span>
                        </button>

                        <!--  Filter Modal -->
                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white" id="exampleModalLabel">~~ Filter Data Kelahiran ~~</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="GET">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                    <select name="gender" class="form-select">
                                                        <option selected value="{{ null }}">~~ Jenis Kelamin ~~</option>
                                                        <option value="Pria" {{ request()->get('gender') == 'Pria' ? 'selected' :''  }}>Pria</option>
                                                        <option value="Wanita" {{ request()->get('gender') == 'Wanita' ? 'selected' :''  }}>Wanita</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary" formaction="{{ route('births.index') }}">Terapkan</button>
                                            <div>
                                                <button type="submit" class="btn btn-danger" formaction="{{ route('filter-resetBirth') }}">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>

                        @if(Auth::user()->role != 'Watcher')
                            {{-- Delete All --}}
                            <a class="btn btn-danger" href="{{ route('birth.deleteAll') }}">Hapus Semua</a>
                        @endif
                    </div>
                </div>

                <div class="card-body mt-3 table-responsive">
                    <table class="table table-striped mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Keterangan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($births as $birth)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $birth->name }}</td>
                                    <td>{{ $birth->birth }}</td>
                                    <td>{{ $birth->gender }}</td>
                                    <td>
                                        @foreach ($dies as $die)
                                            @if($birth->resident_id === $die->resident_id)
                                                <span class="badge bg-warning">Meninggal</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around align-items-center">
                                            <div>
                                                <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#example{{ $birth->id }}" style="width: 35px; height: 35px; padding: 8px">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>

                                                <div class="modal fade" id="example{{ $birth->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header bg-primary">
                                                            <h5 class="modal-title text-white" id="ModalLabel">Detail Kelahiran : </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered table-striped">
                                                                <tr>
                                                                    <th>Nama Lengkap</th>
                                                                    <td>{{ $birth->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tempat / Tanggal Lahir</th>
                                                                    <td>{{ $birth->place_birth }}, {{ $birth->birth }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Jenis Kelamin</th>
                                                                    <td>{{ $birth->gender }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Nama Ayah</th>
                                                                    <td>{{ $birth->father }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Nama Ibu</th>
                                                                    <td>{{ $birth->mother }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Berat badan</th>
                                                                    <td>{{ $birth->weight }} kg</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tinggi badan</th>
                                                                    <td>{{ $birth->width }} cm</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(Auth::user()->role != 'Watcher')
                                                <a href="birth/{{ $birth->id }}/konfirmasi" class="btn btn-danger rounded-circle" style="width: 35px; height: 35px; padding: 8px">
                                                    <i class="bi bi-trash text-white"></i>
                                                </a>

                                                <a href="{{ route('births.edit', $birth->id) }}" class="btn btn-warning text-center rounded-circle" style="width: 35px; height: 35px; padding: 8px">
                                                    <i class="bi bi-pencil-square text-white"></i>
                                                </a>
                                            @endif
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
@endpush
