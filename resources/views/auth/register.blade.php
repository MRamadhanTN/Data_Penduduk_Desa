@extends('layouts.auth')
@section('title', 'SPPD')

@section('content')
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <a href="{{ route('login') }}" class="fs-1" style=" margin-left: 5px;">
            <i class="bi bi-arrow-left-square-fill"></i>
        </a>
        <div id="auth-left">
            <div class="auth-logo d-flex justify-content-center">
                <img style="width: 200px; height: 200px; margin-bottom: -80px;" src="{{ asset('dist/assets/images/logo/logo1.png') }}" alt="Logo">
            </div>
            <h1 class="auth-title text-center">{{ __('Register') }}</h1>
            <p class="auth-subtitle mb-5 text-center" style="width: 500px; margin-left: -100px; font-size: 25px;"> Masukkan data Anda untuk mendaftar ke website kami. </p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control form-control-xl @error('name') is-invalid @enderror" placeholder="Username" autocomplete="name" name="name" value="{{ old('name') }}" id="name" required autofocus>
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <div class="form-group position-relative has-icon-left">
                        <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" id="email" name="email" required autocomplete="email">
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

                <div class="mb-4">
                    <div class="form-group position-relative has-icon-left d-flex">
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Confirm Password" required autocomplete="new-password">
                        <span class="input-group-text" onclick="change()" id="mybutton2"><i class="bi bi-eye-fill"></i></span>
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Role --}}
                <input type="hidden" value="Watcher" name="role">

                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600' style="width: 350px; margin-left: -30px;">Already have an account? <a href="{{ route('login') }}" class="font-bold  border-primary border-2 border-bottom">Login</a></p>
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
            var y = document.getElementById('password-confirm').type;

            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {

                //ubah form input password menjadi text
                document.getElementById('password').type = 'text';
                document.getElementById('password-confirm').type = 'text';

                //ubah icon mata tertutp menjadi terbuka
                document.getElementById('mybutton').innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
                document.getElementById('mybutton2').innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
            }
            else {

                //ubah form input text menjadi password
                document.getElementById('password').type = 'password';
                document.getElementById('password-confirm').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = '<i class="bi bi-eye-fill"></i>';
                document.getElementById('mybutton2').innerHTML = '<i class="bi bi-eye-fill"></i>';
            }
        }
    </script>
@endpush
