@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-2 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Data Pekerjaan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
            <ol class="breadcrumb fs-5 fw-bold">
                <a href="{{ route('jobs.index') }}" class="fs-5">
                    <span class="badge bg-primary">Back</span>
                </a>
            </ol>
        </nav>

        <div class="create card p-4 border border-2">
            <h4 class="text-center text-primary pb-3">Edit Pekerjaan</h4>
            <form action="{{ route('jobs.update', $jobEdit->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-between">
                    <input type="text" style="width: 825px" name="name" class="form-control border-2 @error('name') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Masukan Pekerjaan Baru" value="{{ $jobEdit->name }}">
                    <button class="btn btn-primary rounded-lg px-4">Submit</button>
                </div>
                <div class="">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </form>
        </div>
    </div>
@endsection
