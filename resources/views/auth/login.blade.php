@extends('layouts.auth')
@section('title', 'SPPD')

@section('content')
    <div class="row">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo d-flex justify-content-center">
                    <img style="width: 200px; height: 200px; margin-bottom: -80px;" src="{{ asset('dist/assets/images/logo/logo1.png') }}" alt="Logo">
                </div>
                <h1 class="auth-title text-center">{{ __('Login') }}</h1>
                <p class="auth-subtitle mb-5 text-center" style="width: 500px; margin-left: -100px; font-size: 25px;"> Sistem Pendataan Penduduk Desa </p>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-4">
                        <div class="form-group position-relative has-icon-left">
                            <input type="email" name="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email" autofocus required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-group position-relative has-icon-left d-flex">
                            <input type="password" name="password" id="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password" required>
                            <span class="input-group-text" onclick="change()" id="mybutton"><i class="bi bi-eye-fill"></i></span>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check" style="margin-left: -100px;">
                                <input class="form-check-input" type="checkbox" value="remember_me" name="remember_me" id="remember_me" {{ old('remember_me') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember_me">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div> --}}

                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">{{ __('Login') }}</button>
                    <br>
                </form>

                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-bold border-bottom border-2 border-primary">Sign up</a></p>
                    @if (Route::has('password.request'))
                        <p><a class="font-bold" href="{{ route('password.request') }}">Forgot password?</a></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>
@endsection


@push('afterScript')
    <script>
        // membuat fungsi change
        function change() {

            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password
            var x = document.getElementById('password').type;

            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {

                //ubah form input password menjadi text
                document.getElementById('password').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
            }
            else {

                //ubah form input password menjadi text
                document.getElementById('password').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = '<i class="bi bi-eye-fill"></i>';
            }
        }
    </script>
@endpush
