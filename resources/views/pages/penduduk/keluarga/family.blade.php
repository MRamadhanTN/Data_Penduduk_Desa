@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">

        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Keluarga</li>
            </ol>
            @if(Auth::user()->role != 'Watcher')
                <ol>
                    <a href="{{ route('families.create') }}" class="btn btn-primary" style="font-weight: bold;">
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
                        <a class="btn btn-secondary" href="{{ route('family.print') }}" target="_blank">Print PDF</a>
                        <a class="btn btn-success" href="{{ route('family.export') }}">Export</a>
                        <a class="btn btn-success" href="{{ route('family.exportTemplate') }}">Export Template</a>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('family.import') }}" method="post" enctype="multipart/form-data">
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
                    @if(Auth::user()->role != 'Watcher')
                        <div class="d-flex">
                            {{-- Delete All --}}
                            <a class="btn btn-danger" href="{{ route('family.deleteAll') }}">Hapus Semua</a>
                        </div>
                    @endif
                </div>

                <div class="card-body mt-3 table-responsive">
                    <table class="table table-striped mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nomor KK</th>
                                <th>NIK</th>
                                <th>Kepala Keluarga</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($families as $family)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $family->no_kk }}</td>
                                    <td>{{ $family->NIK }}</td>
                                    <td>{{ $family->kepala_keluarga }}</td>
                                    <td class="d-flex justify-content-around">
                                        <div>
                                            <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#example{{ $family->id }}" style="width: 35px; height: 35px; padding: 8px">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>

                                            <div class="modal fade" id="example{{ $family->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white" id="ModalLabel">Detail Keluarga</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered table-striped">
                                                            <tr>
                                                                <th>Nomor Kartu Keluarga</th>
                                                                <td>{{ $family->no_kk }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>NIK</th>
                                                                <td>{{ $family->NIK }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kepala Keluarga</th>
                                                                <td>{{ $family->kepala_keluarga }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Anggota Keluarga</th>
                                                                <td>
                                                                    @forelse ($Detail as $a)
                                                                        @if($a->family_id == $family->id)
                                                                            @if($a->hubungan=='Ibu')
                                                                                <div>{{ $a->resident }}<span style="margin-left: 5px" class="badge bg-success">Ibu</span></div>
                                                                            @elseif($a->hubungan=='Anak')
                                                                                <div>{{ $a->resident }}<span style="margin-left: 5px" class="badge bg-success">Anak</span><div>
                                                                            @endif
                                                                        @endif
                                                                    @empty
                                                                        <span style="margin-left: 5px" class="badge bg-danger">Kosong</span>
                                                                    @endforelse
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        @if(Auth::user()->role != 'Watcher')
                                                            <a href="{{ route('familyDetails.show', $family->id) }}" class="btn btn-primary text-center px-4">
                                                                Tambah Anggota
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if(Auth::user()->role != 'Watcher')
                                            <a href="{{ route('families.edit', $family->id) }}" class="btn btn-warning rounded-circle text-center" style="width: 35px; height: 35px; padding: 8px">
                                                <i class="bi bi-pencil-square text-white"></i>
                                            </a>
                                            <a href="family/{{ $family->id }}/konfirmasi" class="btn btn-danger rounded-circle" style="width: 35px; height: 35px; padding: 8px;">
                                                <i class="bi bi-trash text-white"></i>
                                            </a>
                                        @endif
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
