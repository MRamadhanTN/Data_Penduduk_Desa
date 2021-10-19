@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">

        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Kematian</li>
            </ol>
            @if(Auth::user()->role != 'Watcher')
                <ol>
                    <a href="{{ route('dies.create') }}" class="btn btn-primary" style="font-weight: bold;">
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
                        <a class="btn btn-secondary" href="{{ route('die.print') }}" target="_blank">Print PDF</a>
                        <a class="btn btn-success" href="{{ route('die.export') }}">Export</a>
                        <a class="btn btn-success" href="{{ route('die.exportTemplate') }}">Export Template</a>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('die.import') }}" method="post" enctype="multipart/form-data">
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
                                        <h5 class="modal-title text-white" id="exampleModalLabel">~~ Filter Data Kematian ~~</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="GET">

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                        <select name="gender" class="form-select">
                                                            <option selected value="{{ null }}">~~ Jenis Kelamin ~~</option>
                                                            <option value="Pria" {{ request()->get('gender') == 'Pria' ? 'selected' :''  }}>Pria</option>
                                                            <option value="Wanita" {{ request()->get('gender') == 'Wanita' ? 'selected' :''  }}>Wanita</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Agama</label>
                                                        <select name="religion" class="form-select">
                                                            <option selected value="{{ null }}">~~ Agama ~~</option>
                                                            <option value="Islam" {{ request()->get('religion') == 'Islam' ? 'selected' :''  }}>Islam</option>
                                                            <option value="Kristen" {{ request()->get('religion') == 'Kristen' ? 'selected' :''  }}>Kristen</option>
                                                            <option value="Hindu" {{ request()->get('religion') == 'Hindu' ? 'selected' :''  }}>Hindu</option>
                                                            <option value="Buddha" {{ request()->get('religion') == 'Buddha' ? 'selected' :''  }}>Budha</option>
                                                            <option value="Katolik" {{ request()->get('religion') == 'Katolik' ? 'selected' :''  }}>Katolik</option>
                                                            <option value="Konghucu" {{ request()->get('religion') == 'Konghucu' ? 'selected' :''  }}>Konghucu</option>
                                                            <option value="Atheis" {{ request()->get('religion') == 'Atheis' ? 'selected' :''  }}>Atheis</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Kewarganegaraan</label>
                                                        <select name="kewarganegaraan" class="form-select">
                                                            <option selected value="{{ null }}">~~ Kewarganegaraan ~~</option>
                                                            <option value="WNI" {{ request()->get('kewarganegaraan') == 'WNI' ? 'selected' :''  }}>WNI</option>
                                                            <option value="WNA" {{ request()->get('kewarganegaraan') == 'WNA' ? 'selected' :''  }}>WNA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="submit" class="btn btn-primary" formaction="{{ route('dies.index') }}">Terapkan</button>
                                                <div>
                                                    <button type="submit" class="btn btn-danger" formaction="{{ route('filter-resetDie') }}">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @if(Auth::user()->role != 'Watcher')
                            {{-- Delete All --}}
                            <a href="die/konfirmasiAll" class="btn btn-danger">Hapus Semua</a>
                        @endif
                    </div>
                </div>

                <div class="card-body mt-3 table-responsive">
                    <table class="table table-striped mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Wafat</th>
                                <th>Tempat</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dies as $die)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $die->name }}</td>
                                    <td>{{ $die->date }}</td>
                                    <td>{{ $die->place }}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#example{{ $die->id }}" style="width: 35px; height: 35px; padding: 8px">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>

                                            <div class="modal fade" id="example{{ $die->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white" id="ModalLabel">Detail Kematian</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered table-striped">
                                                            <tr>
                                                                <th>NIK</th>
                                                                <td>{{ $die->NIK }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Nama Lengkap</th>
                                                                <td>{{ $die->name }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Jenis Kelamin</th>
                                                                <td>{{ $die->gender }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>TTGL</th>
                                                                <td>{{ $die->place_birth }}, {{ $die->birth_date }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Pekerjaan</th>
                                                                <td>{{ $die->job }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Agama</th>
                                                                <td>{{ $die->religion }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Kewarganegaraan</th>
                                                                <td>{{ $die->citizenship }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Tanggal Wafat</th>
                                                                <td>{{ $die->date }}</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Waktu</th>
                                                                <td>{{ $die->time }} WIB</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Umur</th>
                                                                <td>{{ $die->age }} Tahun</td>
                                                            </tr>

                                                            <tr>
                                                                <th>Tempat</th>
                                                                <td>{{ $die->place }}</td>
                                                            </tr>

                                                            <tr>
                                                                <div>
                                                                    <th class="align-top">Penyebab</th>
                                                                    <td>{!! $die->penyebab !!}</td>
                                                                </div>
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
                                            <a href="{{ route('dies.edit', $die->id) }}" class="btn btn-warning rounded-circle text-center" style="width: 35px; height: 35px; padding: 8px">
                                                <i class="bi bi-pencil-square text-white"></i>
                                            </a>
                                            <a href="die/{{ $die->id }}/konfirmasi" class="btn btn-danger rounded-circle" style="width: 35px; height: 35px; padding: 8px;">
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
