@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-2 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('families.index') }}">Data Kelahiran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>

        <div class="card p-5 border border-2">
            <div class="title text-center py-3" style="line-height: 7px">
                <h2 class="text-primary">Data Keluarga</h2>
                <p>( Isi data sesuai dengan KTP atau Kartu Keluarga )</p>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="post" id="locations" action="{{ route('families.update', $families->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <input type="hidden" value="{{ $families->resident_id }}" name="replace">

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Kepala Keluarga</label>
                                                    <select id="resident_id" class="form-control @error('residents_id') is-invalid @enderror border-2" name="resident_id" value="{{ $families->kepala_keluarga }}" autofocus>
                                                        <option disabled="" class="text-gray-500">Pilih Kepala Keluarga</option>
                                                        <option selected value="{{ $families->residents->id }}">{{ $families->residents->name }}</option>
                                                        @foreach ($residents as $resident)
                                                            <option value="{{ $resident->id }}">
                                                                {{ $resident->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('residents_id')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="no_kk">Nomor Kartu Keluarga</label>
                                                    <input type="number" id="no_kk" class="form-control @error('no_kk') is-invalid @enderror border-2" name="no_kk" autocomplete="none" value="{{ $families->no_kk }}">

                                                    @error('no_kk')
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
                <a href="{{ route('families.index') }}" class="text-decoration-none text-white px-3">
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
@endpush
