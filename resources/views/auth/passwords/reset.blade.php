@extends('layouts.auth.app')

@section('title', 'Reset Kata Sandi')

@section('content')
<div class="login-page" style="background-image: url({{ asset('backend') }}/assets/images/mekkah.jpeg);">
    <div class="login-from-wrap">
        <form method="POST" action="{{ route('password.update') }}" class="login-from">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <h1 class="site-title">
                <a href="#">
                    <img src="{{ asset('backend') }}/assets/images/logo.png" alt="logo">
                </a>
            </h1>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="validate @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group" style="position: relative;">
                <label for="password">Kata Sandi Baru</label>
                <input id="password" type="password" class="validate @error('password') is-invalid @enderror" name="password" placeholder="Kata Sandi Baru" style="padding-right: 40px;">
                <span class="toggle-password" onclick="togglePassword()" style="position: absolute; right: 15px; top: 42px; cursor: pointer;">
                    <i id="eye-icon" class="fa fa-eye"></i>
                </span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group" style="position: relative;">
                <label for="password-confirmation">Konfirmasi Kata Sandi</label>
                <input id="password-confirmation" type="password" class="validate" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" style="padding-right: 40px;">
                <span class="toggle-password" onclick="togglePasswordConfirm()" style="position: absolute; right: 15px; top: 42px; cursor: pointer;">
                    <i id="eye-icon-confirm" class="fa fa-eye"></i>
                </span>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn button-primary text-dark w-100">Reset Kata Sandi</button>
            </div>
            <div class="text-center">
                <a href="{{ route('login') }}">Kembali</a>
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

    function togglePasswordConfirm() {
        var passwordField = document.getElementById("password-confirmation");
        var eyeIcon = document.getElementById("eye-icon-confirm");

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