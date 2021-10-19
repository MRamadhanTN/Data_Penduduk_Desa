@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="my-4 d-flex">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('families.index') }}">Data Keluarga</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Anggota Keluarga</li>
            </ol>
        </nav>

        <div class="create card p-4 border border-2">
            <div class="title text-center py-3" style="line-height: 7px">
                <h2 class="text-primary">Data Anggota Keluarga</h2>
                <p>( Isi data sesuai dengan Kartu Keluarga )</p>
            </div>
            <form class="form" method="post" id="locations" action="{{ route('familyDetails.store') }}">
                @csrf
                @method('POST')
                    <div class="row">
                        <input type="hidden" value="{{ $family->id }}" name="family_id">
                        <div class="mb-3">
                            <div class="col-md-12 col-12">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Anggota Keluarga</label>
                            <select id="resident_id" class="form-control @error('resident_id') is-invalid @enderror border-2" name="resident_id" value="{{ old('resident_id') }}" autofocus>
                                <option disabled="" selected class="text-gray-500">Pilih Anggota Keluarga</option>
                                @foreach ($residents as $resident)
                                    <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                                @endforeach
                            </select>
                            @error('resident_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="hubungan">Hubungan</label>
                            <select id="hubungan" class="form-control @error('hubungan') is-invalid @enderror border-2" name="hubungan" autocomplete="none" value="{{ old('hubungan') }}">
                                <option value="Ibu">Ibu</option>
                                <option value="Anak">Anak</option>
                            </select>
                            @error('hubungan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button class="btn btn-primary me-1 mb-1">Submit</button>
                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                    </div>
                </div>
            </form>
        </div>

        <section class="section">
            <div class="card border border-2">
                <div class="card-header d-flex justify-content-between border-bottom py-0 align-items-center">
                    <div class="form-group mt-4">
                        <h6>Nomor Kartu Keluarga : {{ $family->no_kk }}</h6>
                        <h6>Kepala Keluarga : {{ $family->kepala_keluarga }}</h6>
                    </div>

                    {{-- Delete All --}}
                    <div  class="my-3">
                        <a class="btn btn-danger" href="{{ route('detail.deleteAll') }}">Hapus Semua</a>
                    </div>
                </div>

                <div class="card-body mt-3 table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th class="col-1 text-center">No</th>
                                <th class="col-5">Nama</th>
                                <th class="col-4">Hubungan</th>
                                <th class="text-center col-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                                @if($detail->family_id == $family->id)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $detail->resident }}</td>
                                        <td>{{ $detail->hubungan }}</td>
                                        <td class="col-2">
                                            <div class="d-flex justify-content-around align-items-center">
                                                <a href="familyDetail/{{ $detail->id }}/confirm" class="btn btn-danger rounded-circle" style="width: 35px; height: 35px; padding: 8px;">
                                                    <i class="bi bi-trash text-white"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success">
                <a href="{{ route('families.index') }}" class="text-decoration-none text-white px-3">
                    Back
                </a>
            </button>
        </div>
    </div>
@endsection
