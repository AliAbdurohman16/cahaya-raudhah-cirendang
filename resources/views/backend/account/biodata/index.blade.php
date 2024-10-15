@extends('layouts.backend.main')

@section('title', 'Biodata')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box user-form-wrap">
                <h4>Biodata</h4>
                <form action="{{ route('biodata.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $biodata->name }}" placeholder="Nama Lengkap">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="father_name">Nama Ayah</label>
                                <input id="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{ $biodata->father_name }}" placeholder="Nama Ayah">
                                @error('father_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="place_birth">Tempat Lahir</label>
                                <input id="place_birth" type="text" class="form-control @error('place_birth') is-invalid @enderror" name="place_birth" value="{{ $biodata->place_birth }}" placeholder="Tempat Lahir">
                                @error('place_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_birth">Tanggal Lahir</label>
                                <input id="date_birth" type="date" class="form-control @error('date_birth') is-invalid @enderror" name="date_birth" value="{{ $biodata->date_birth }}" dateholder="Tanggal Lahir">
                                @error('date_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ $biodata->nik }}" placeholder="NIK">
                                @error('nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ $biodata->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $biodata->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">No. Handphone</label>
                                <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $biodata->phone_number }}" placeholder="No. Handphone">
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="work">Pekerjaan</label>
                                <input id="work" type="text" class="form-control @error('work') is-invalid @enderror" name="work" value="{{ $biodata->work }}" placeholder="Pekerjaan">
                                @error('work')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="highest_education">Pendidikan Terakhir</label>
                                <select id="highest_education" class="form-control @error('highest_education') is-invalid @enderror" name="highest_education">
                                    <option value="">Pilih Pendidikan Terakhir</option>
                                    <option value="TK" {{ ($biodata->highest_education ?? '') == 'PAUD' ? 'selected' : '' }}>PAUD</option>
                                    <option value="TK" {{ ($biodata->highest_education ?? '') == 'TK' ? 'selected' : '' }}>TK</option>
                                    <option value="SD" {{ ($biodata->highest_education ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ ($biodata->highest_education ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ ($biodata->highest_education ?? '') == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="SMK" {{ ($biodata->highest_education ?? '') == 'SMK' ? 'selected' : '' }}>SMK</option>
                                    <option value="D1" {{ ($biodata->highest_education ?? '') == 'D1' ? 'selected' : '' }}>D1</option>
                                    <option value="D2" {{ ($biodata->highest_education ?? '') == 'D2' ? 'selected' : '' }}>D2</option>
                                    <option value="D3" {{ ($biodata->highest_education ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="D4" {{ ($biodata->highest_education ?? '') == 'D4' ? 'selected' : '' }}>D4</option>
                                    <option value="S1" {{ ($biodata->highest_education ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ ($biodata->highest_education ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ ($biodata->highest_education ?? '') == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                                @error('highest_education')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Alamat">{{ $biodata->address }}</textarea>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="kk">Foto Kartu Keluarga</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-4">
                                        <img src="{{ $biodata->kk ? asset('storage/kk/' . $biodata->kk) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-kk" width="100px">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                      <input id="kk" type="file" class="form-control @error('kk') is-invalid @enderror" name="kk" accept="image/*" onchange="previewImgKK()">
                                      @error('kk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="ktp">Foto KTP</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-4">
                                        <img src="{{ $biodata->ktp ? asset('storage/ktp/' . $biodata->ktp) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-ktp" width="100px">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                      <input id="ktp" type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp" accept="image/*" onchange="previewImgKtp()">
                                      @error('ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="vaccine_certificate">Foto Sertifakt Vaksin</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-4">
                                        <img src="{{ $biodata->vaccine_certificate ? asset('storage/vaccine_certificates/' . $biodata->vaccine_certificate) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-vaccine" width="100px">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                      <input id="vaccine" type="file" class="form-control @error('vaccine_certificate') is-invalid @enderror" name="vaccine_certificate" accept="image/*" onchange="previewImgVaccine()">
                                      @error('vaccine_certificate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="passport">Foto Paspor</label>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="text-center mb-4">
                                        <img src="{{ $biodata->passport ? asset('storage/passports/' . $biodata->passport) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-passport" width="100px">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                      <input id="passport" type="file" class="form-control @error('passport') is-invalid @enderror" name="passport" accept="image/*" onchange="previewImgPassport()">
                                      @error('passport')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
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
    @if (Session::has('message'))
    swal.fire({
        icon: "success",
        title: "Berhasil",
        text: "{{ Session::get('message') }}",
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }
    });
    @endif

    function previewImgKK() {
        const kk = document.querySelector('#kk');
        const imgPreviewKk = document.querySelector('.img-preview-kk');
        const fileImgKk = new FileReader();
        fileImgKk.readAsDataURL(kk.files[0]);
        fileImgKk.onload = function(e) {
            imgPreviewKk.src = e.target.result;
        }
    }

    function previewImgKtp() {
        const ktp = document.querySelector('#ktp');
        const imgPreviewKtp = document.querySelector('.img-preview-ktp');
        const fileImgKtp = new FileReader();
        fileImgKtp.readAsDataURL(ktp.files[0]);
        fileImgKtp.onload = function(e) {
            imgPreviewKtp.src = e.target.result;
        }
    }

    function previewImgVaccine() {
        const vaccine = document.querySelector('#vaccine');
        const imgPreviewVaccine = document.querySelector('.img-preview-vaccine');
        const fileImgVaccine = new FileReader();
        fileImgVaccine.readAsDataURL(vaccine.files[0]);
        fileImgVaccine.onload = function(e) {
            imgPreviewVaccine.src = e.target.result;
        }
    }

    function previewImgPassport() {
        const passport = document.querySelector('#passport');
        const imgPreviewPassport = document.querySelector('.img-preview-passport');
        const fileImgPassport = new FileReader();
        fileImgPassport.readAsDataURL(passport.files[0]);
        fileImgPassport.onload = function(e) {
            imgPreviewPassport.src = e.target.result;
        }
    }
</script>
@endsection