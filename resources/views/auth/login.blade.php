@extends('layouts.auth.app')

@section('title', 'Masuk')

@section('content')
<div class="login-page" style="background-image: url({{ asset('backend') }}/assets/images/mekkah.jpeg);">
    <div class="login-from-wrap">
        <form method="POST" action="{{ route('login') }}" class="login-from">
            @csrf
            <h1 class="site-title">
                <a href="#">
                    <img src="{{ asset('backend') }}/assets/images/logo.png" alt="logo">
                </a>
            </h1>
            @if ($errors->has('email') || $errors->has('password'))
                <div class="alert alert-danger">Email atau kata sandi anda salah!</div>
            @endif
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" placeholder="Email" autofocus>
                
            </div>
            <div class="form-group" style="position: relative;">
                <label for="password">Kata Sandi</label>
                <input id="password" type="password" class="validate" name="password" placeholder="Kata Sandi" style="padding-right: 40px;">
                <span class="toggle-password" onclick="togglePassword()" style="position: absolute; right: 15px; top: 42px; cursor: pointer;">
                    <i id="eye-icon" class="fa fa-eye"></i>
                </span>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn button-primary text-dark w-100">Masuk</button>
            </div>
            <div class="text-center">
                <p class="mb-0 already-account">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="for-pass">Lupa Kata Sandi?</a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var eyeIcon = document.getElementById("eye-icon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
@endsection