@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-2 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dies.index') }}">Data Kematian</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
            </ol>
        </nav>

        <div class="card p-5 border border-2">
            <div class="title text-center py-3" style="line-height: 7px">
                <h2 class="text-primary">Edit Data Kematian</h2>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="post" id="locations" action="{{ route('dies.update', $dieEdit->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Nama Lengkap</label>
                                                    <select type="text" id="resident_id" class="form-control @error('residents_id') is-invalid @enderror border-2" name="resident_id" autofocus>
                                                        <option disabled class="text-gray-500">Pilih Nama</option>
                                                        <option selected value="{{ $dieEdit->id }}">{{ $dieEdit->name }}</option>
                                                        @foreach ($residents as $resident)
                                                            <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('residents_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="place">Alamat</label>
                                                    <input type="text" id="place" class="form-control @error('place') is-invalid @enderror border-2" name="place" value="{{ $dieEdit->place }}" placeholder="{{ old('place') }}">
                                                    @error('place')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="date">Tanggal</label>
                                                    <input type="date" id="date" class="form-control @error('date') is-invalid @enderror border-2" name="date" placeholder="{{ old('date') }}" value="{{ $dieEdit->date }}">
                                                    @error('date')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="time">Waktu</label>
                                                    <input type="time" id="time" class="form-control @error('time') is-invalid @enderror border-2" name="time" placeholder="{{ old('time') }}" value="{{ $dieEdit->time }}">
                                                    @error('time')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label for="age">Umur</label>
                                                    <input type="number" id="age" class="form-control @error('age') is-invalid @enderror border-2" name="age" placeholder="{{ old('age') }}" min="12:00" max="23:59" value="{{ $dieEdit->age }}">
                                                    @error('age')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="penyebab">Penyebab</label>
                                                    <textarea id="penyebab" class="form-control @error('penyebab') is-invalid @enderror border-2" name="penyebab" placeholder="{{ old('penyebab') }}">{!! $dieEdit->penyebab !!}</textarea>
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
                <a href="{{ route('dies.index') }}" class="text-decoration-none text-white px-3">
                    Back
                </a>
            </button>
        </div>
    </div>
@endsection

@push('afterScript')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        CKEDITOR.replace( 'penyebab' );
    </script>
@endpush
