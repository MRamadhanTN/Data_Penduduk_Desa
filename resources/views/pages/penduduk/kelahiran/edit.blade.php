@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-2 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('births.index') }}">Data Kelahiran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>

        <div class="card p-5 border border-2">
            <div class="title text-center py-3" style="line-height: 7px">
                <h2 class="text-primary">Edit Data Kelahiran</h2>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="POST" id="locations" action="{{ route('births.update', $birthEdit->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <select id="resident_id" class="form-control @error('residents_id') is-invalid @enderror border-2" name="resident_id" autofocus>
                                                        <option disabled="" class="text-gray-500">Cari nama</option>
                                                        <option selected value="{{ $birthEdit->id }}">{{ $birthEdit->name }}</option>
                                                        @foreach ($residents as $resident)
                                                            @if( $resident->kepala_keluarga !== 'Ibu')
                                                                <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('residents_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="weight">Berat badan</label>
                                                    <input type="number" id="weight" class="form-control @error('weight') is-invalid @enderror border-2" name="weight" autocomplete="none" placeholder="{{ old('weight') }}" value="{{ $birthEdit->weight }}">
                                                    @error('weight')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="width">Tinggi badan</label>
                                                    <input type="number" id="width" class="form-control @error('width') is-invalid @enderror border-2" name="width" autocomplete="none" placeholder="{{ old('width') }}" value="{{ $birthEdit->width }}">
                                                    @error('width')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="father">Ayah</label>
                                                    <select id="father" class="form-control @error('father') is-invalid @enderror border-2" name="father" value="{{ old('residents_id') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih</option>
                                                        <option selected value="{{ $birthEdit->id }}">{{ $birthEdit->father }}</option>
                                                        @foreach ($families as $family)
                                                            <option value="{{ $family->id }}">{{ $family->kepala_keluarga }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('father')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="mother">Ibu</label>
                                                    <select id="mother" class="form-control @error('mother') is-invalid @enderror border-2" name="mother" value="{{ old('residents_id') }}">
                                                        <option disabled="" selected class="text-gray-500">Pilih</option>
                                                        <option selected value="{{ $birthEdit->id }}">{{ $birthEdit->mother }}</option>
                                                        @foreach ($details as $detail)
                                                            <option value="{{ $detail->id }}">{{ $detail->resident }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('mothers')
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-success">
                <a href="{{ route('births.index') }}" class="text-decoration-none text-white px-3">
                    Back
                </a>
            </button>
        </div>
    </div>
@endsection
