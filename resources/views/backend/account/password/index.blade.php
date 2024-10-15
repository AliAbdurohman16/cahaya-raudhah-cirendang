@extends('layouts.backend.main')

@section('title', 'Kata Sandi')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-6">
            <div class="dashboard-box user-form-wrap">
                <h4>Ubah Kata Sandi</h4>
                <form action="{{ route('password-change.store') }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" style="position: relative;">
                                <label for="password-old">Kata Sandi Lama</label>
                                <input id="password-old" type="password" class="form-control @error('password_old') is-invalid @enderror" name="password_old" placeholder="Kata Sandi Lama" style="padding-right: 40px;">
                                <span class="toggle-password" onclick="togglePasswordOld()" style="position: absolute; right: 15px; top: 44px; cursor: pointer;">
                                    <i id="eye-icon-old" class="fa fa-eye"></i>
                                </span>
                                @error('password_old')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        
                        <div class="col-sm-12">
                            <div class="form-group" style="position: relative;">
                                <label for="password">Kata Sandi</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kata Sandi" style="padding-right: 40px;">
                                <span class="toggle-password" onclick="togglePassword()" style="position: absolute; right: 15px; top: 44px; cursor: pointer;">
                                    <i id="eye-icon" class="fa fa-eye"></i>
                                </span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group" style="position: relative;">
                                <label for="password-confirmation">Konfirmasi Kata Sandi</label>
                                <input id="password-confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" style="padding-right: 40px;">
                                <span class="toggle-password" onclick="togglePasswordConfirm()" style="position: absolute; right: 15px; top: 44px; cursor: pointer;">
                                    <i id="eye-icon-confirm" class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn button-primary text-dark w-100">Simpan</button>
                </form>
            </div>
        </div>  
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    @if (Session::has('success'))
    swal.fire({
        icon: "success",
        title: "Berhasil",
        text: "{{ Session::get('success') }}",
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }
    });
    @endif

    function togglePasswordOld() {
        var passwordField = document.getElementById("password-old");
        var eyeIcon = document.getElementById("eye-icon-old");

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