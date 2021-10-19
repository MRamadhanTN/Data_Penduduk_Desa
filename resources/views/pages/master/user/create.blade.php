@extends('layouts.dashboard')
@section('title', 'SPPD')

@section('content')
    <div id="main">
        {{-- breadcrumb --}}
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 mb-2 d-flex justify-content-between">
            <ol class="breadcrumb fs-5 fw-bold">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
            </ol>
        </nav>

        <div class="card p-5 border border-2">
            <div class="title text-center py-3" style="line-height: 7px">
                <h2 class="text-primary">Formulir User</h2>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="post" id="locations" action="{{ route('users.store') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="name">Username</label>
                                                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror border-2" name="name" value="{{ old('name') }}" autocomplete="off">
                                                    @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror border-2" name="email" autocomplete="none" value="{{ old('email') }}">
                                                    @error('email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror border-2" name="password" autocomplete="none" value="{{ old('password') }}">
                                                    @error('password')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select id="role" class="form-control @error('role') is-invalid @enderror border-2" name="role" value="{{ old('role') }}">
                                                    <option disabled="" selected class="text-gray-500">Pilih Role</option>
                                                    <option value="Super Admin">Super Admin</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Watcher">Watcher</option>
                                                    </select>
                                                    @error('role')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="confirm_password">Confirm Password</label>
                                                    <input type="password" id="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror border-2" name="confirm_password" autocomplete="none" value="{{ old('confirm_password') }}">
                                                    @error('confirm_password')
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
                <a href="{{ route('users.index') }}" class="text-decoration-none text-white px-3">
                    Back
                </a>
            </button>
        </div>
    </div>
@endsection
