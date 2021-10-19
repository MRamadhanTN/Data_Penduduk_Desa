@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">

        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penduduk Tetap</li>
            </ol>
        </nav>

        <section class="section">
            <div class="card border border-2">
                <div class="card-header py-0 border-bottom d-flex align-items-center justify-content-between">
                    {{-- Export & Import --}}
                    <div class="my-3">
                        <a class="btn btn-secondary" href="{{ route('tetap.print') }}" target="_blank">Print PDF</a>
                        <a class="btn btn-success" href="{{ route('tetap.export') }}">Export</a>
                        <a class="btn btn-success" href="{{ route('tetap.exportTemplate') }}">Export Template</a>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</a>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('tetap.import') }}" method="post" enctype="multipart/form-data">
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
                                <h5 class="modal-title text-white" id="exampleModalLabel">~~ Filter Penduduk Tetap ~~</h5>
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
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Status</label>
                                                    <select name="status" class="form-select">
                                                        <option selected value="{{ null }}">~~ Status ~~</option>
                                                        <option value="Pelajar" {{ request()->get('status') == 'Pelajar' ? 'selected' :''  }}>Pelajar</option>
                                                        <option value="Menikah" {{ request()->get('status') == 'Menikah' ? 'selected' :''  }}>Kawin</option>
                                                        <option value="Cerai Mati" {{ request()->get('status') == 'Cerai Mati' ? 'selected' :''  }}>Cerai Mati</option>
                                                        <option value="Cerai Hidup" {{ request()->get('status') == 'Cerai Hidup' ? 'selected' :''  }}>Cerai Hidup</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
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
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Pendidikan</label>
                                                    <select name="education" class="form-select">
                                                        <option selected value="{{ null }}">~~ Pendidikan ~~</option>
                                                        <option value="SD"{{ request()->get('education') ===  'SD'  ? 'selected': '' }}>SD</option>
                                                        <option value="SMP"{{ request()->get('education') ===  'SMP'  ? 'selected': '' }}>SMP</option>
                                                        <option value="SMA"{{ request()->get('education') ===  'SMA'  ? 'selected': '' }}>SMA</option>
                                                        <option value="D1"{{ request()->get('education') ===  'D1'  ? 'selected': '' }}>D1</option>
                                                        <option value="D2"{{ request()->get('education') ===  'D2'  ? 'selected': '' }}>D2</option>
                                                        <option value="D3"{{ request()->get('education') ===  'D3'  ? 'selected': '' }}>D3</option>
                                                        <option value="D4"{{ request()->get('education') ===  'D4'  ? 'selected': '' }}>D4</option>
                                                        <option value="S1"{{ request()->get('education') ===  'S1'  ? 'selected': '' }}>S1</option>
                                                        <option value="S2"{{ request()->get('education') ===  'S2'  ? 'selected': '' }}>S2</option>
                                                        <option value="S3"{{ request()->get('education') ===  'S3'  ? 'selected': '' }}>S3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Golongan Darah</label>
                                                    <select name="blood_group" class="form-select">
                                                        <option selected value="{{ null }}">~~ Golongan Darah ~~</option>
                                                        <option value="A"{{ request()->get('blood_group') ===  'A'  ? 'selected': '' }}>A</option>
                                                        <option value="B"{{ request()->get('blood_group') ===  'B'  ? 'selected': '' }}>B</option>
                                                        <option value="AB"{{ request()->get('blood_group') ===  'AB'  ? 'selected': '' }}>AB</option>
                                                        <option value="O"{{ request()->get('blood_group') ===  'O'  ? 'selected': '' }}>O</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary" formaction="{{ route('tetaps.index') }}">Terapkan</button>
                                            <div>
                                                <button type="submit" class="btn btn-danger" formaction="{{ route('filter-reset-tetap') }}">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body mt-3 table-responsive">
                    <table class="table table-striped mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>Keterangan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($residents as $resident)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $resident->NIK }}</td>
                                    <td>{{ $resident->name }}</td>
                                    <td>
                                        @if($resident->gender == 'Pria')
                                            <span>Pria</span>
                                        @elseif($resident->gender == 'Wanita')
                                            <span>Wanita</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($econ->count()==0)
                                            <span class="badge bg-danger">Kosong</span>
                                        @else
                                            @if($families->resident_id == $resident->id)
                                                <span class="badge bg-success">Kepala Keluarga</span>
                                            @else
                                                <span class="badge bg-danger">Kosong</span>
                                            @endif
                                        @endif

                                        @foreach($dies as $death)
                                            @if($resident->id == $death->resident_id)
                                                <span class="badge bg-warning">Meninggal</span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around align-items-center">

                                            <button type="button" class="btn btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#example{{ $resident->id }}" style="width: 35px; height: 35px; padding: 8px">
                                                <i class="bi bi-eye-fill"></i>
                                            </button>

                                            <div class="modal fade" id="example{{ $resident->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title text-white" id="ModalLabel">Detail Penduduk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered table-striped">
                                                            <tr>
                                                                <th>Nomor Kartu Keluarga</th>
                                                                <td>
                                                                    @if($econ->count()==0)
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @else
                                                                        @if($families->resident_id == $resident->id)
                                                                            <span class="badge bg-success">{{ $families->no_kk }}</span>
                                                                        @else
                                                                            <span class="badge bg-danger">Kosong</span>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Keterangan</th>
                                                                <td>
                                                                    @if($econ->count()==0)
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @else
                                                                        @if($families->resident_id == $resident->id)
                                                                            <span class="badge bg-success">Kepala Keluarga</span>
                                                                        @elseif($resident->kepala_keluarga == 'Ibu')
                                                                            <span class="badge bg-success">Ibu</span>
                                                                        @elseif($resident->kepala_keluarga == 'Anak')
                                                                            <span class="badge bg-success">Anak</span>
                                                                        @else
                                                                            <span class="badge bg-danger">Kosong</span>
                                                                        @endif
                                                                    @endif

                                                                    @foreach($dies as $death)
                                                                        @if($resident->id == $death->resident_id)
                                                                            <span class="badge bg-warning">Meninggal</span>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>NIK</th>
                                                                <td>{{ $resident->NIK }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nama Lengkap</th>
                                                                <td>{{ $resident->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tempat Lahir</th>
                                                                <td>{{ $resident->place_birth }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tanggal Lahir</th>
                                                                <td>{{ $resident->birth }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Pekerjaan</th>
                                                                <td>
                                                                    @if($resident->job)
                                                                        {{ $resident->job }}
                                                                    @else
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Jenis Kelamin</th>
                                                                <td>{{ $resident->gender }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>RT</th>
                                                                <td>{{ $resident->RT }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>RW</th>
                                                                <td>{{ $resident->RW }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td>{{ $resident->address }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Provinsi</th>
                                                                <td>
                                                                    @if($resident->provinces)
                                                                        {{ $resident->provinces }}
                                                                    @else
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kabupaten</th>
                                                                <td>
                                                                    @if($resident->regencies)
                                                                        {{ $resident->regencies }}
                                                                    @else
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kecamatan</th>
                                                                <td>
                                                                    @if($resident->districts)
                                                                        {{ $resident->districts }}
                                                                    @else
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kelurahan / Desa </th>
                                                                <td>
                                                                    @if($resident->villages )
                                                                        {{ $resident->villages }}
                                                                    @else
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Agama</th>
                                                                <td>{{ $resident->religion }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Golongan Darah</th>
                                                                <td>
                                                                    @if( $resident->blood_group )
                                                                        {{ $resident->blood_group }}
                                                                    @else
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <td>{{ $resident->status }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Pendidikan</th>
                                                                <td>
                                                                    @if( $resident->education )
                                                                        {{ $resident->education }}
                                                                    @else
                                                                        <span class="badge bg-danger">Kosong</span>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Kewarganegaraan</th>
                                                                <td>{{ $resident->kewarganegaraan }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        @if(Auth::user()->role != 'Watcher')
                                                            <a href="{{ route('tetaps.edit', $resident->id) }}" class="btn btn-warning text-center px-4">
                                                                Edit
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
