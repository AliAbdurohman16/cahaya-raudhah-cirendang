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
                                <div class="col-sm-4">
                                    <div class="mb-4">
                                        <img src="{{ $biodata->kk ? asset('storage/kk/' . $biodata->kk) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-kk mb-2" width="100px">
                                        <br>
                                        <small class="file-size-kk">Ukuran Asli : {{ $biodata->original_kk_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $biodata->compressed_kk_size ?? '0 KB' }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-8">
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
                                <div class="col-sm-4">
                                    <div class="mb-4">
                                        <img src="{{ $biodata->ktp ? asset('storage/ktp/' . $biodata->ktp) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-ktp mb-2" width="100px">
                                        <br>
                                        <small class="file-size-ktp">Ukuran Asli : {{ $biodata->original_ktp_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $biodata->compressed_ktp_size ?? '0 KB' }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-8">
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
                            <label for="passport_photo">Pas Foto</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-4">
                                        <img src="{{ $biodata->passport_photo ? asset('storage/passport_photo/' . $biodata->passport_photo) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-passport-photo mb-2" width="100px">
                                        <br>
                                        <small class="file-size-passport-photo">Ukuran Asli : {{ $biodata->original_passport_photo_size ?? '0 KB' }}  KB</small> <br>
                                        <small>Ukuran Kompresi : {{ $biodata->compressed_passport_photo_size ?? '0 KB' }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                      <input id="passport_photo" type="file" class="form-control @error('passport_photo') is-invalid @enderror" name="passport_photo" accept="image/*" onchange="previewImgPassportPhoto()">
                                      @error('passport_photo')
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
                                <div class="col-sm-4">
                                    <div class="mb-4">
                                        <img src="{{ $biodata->vaccine_certificate ? asset('storage/vaccine_certificates/' . $biodata->vaccine_certificate) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-vaccine mb-2" width="100px">
                                        <br>
                                        <small class="file-size-vaccine">Ukuran Asli : {{ $biodata->original_vaccine_certificate_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $biodata->compressed_vaccine_certificate_size ?? '0 KB' }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-8">
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
                            <label for="health_certificate">Foto Surat Keterangan Sehat</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-4">
                                        <img src="{{ $biodata->health_certificate ? asset('storage/health_certificates/' . $biodata->health_certificate) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-health mb-2" width="100px">
                                        <br>
                                        <small class="file-size-health">Ukuran Asli : {{ $biodata->original_health_certificate_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $biodata->compressed_health_certificate_size ?? '0 KB' }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                      <input id="health" type="file" class="form-control @error('health_certificate') is-invalid @enderror" name="health_certificate" accept="image/*" onchange="previewImgHealth()">
                                      @error('health_certificate')
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
                                <div class="col-sm-4">
                                    <div class="mb-4">
                                        <img src="{{ $biodata->passport ? asset('storage/passports/' . $biodata->passport) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-passport mb-2" width="100px">
                                        <br>
                                        <small class="file-size-passport">Ukuran Asli : {{ $biodata->original_passport_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $biodata->compressed_passport_size ?? '0 KB' }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-8">
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
        const fileSizeDisplay = document.querySelector('.file-size-kk');

        if (kk.files.length > 0) {
            const file = kk.files[0]; // Ambil file yang dipilih
            const fileSizeKB = (file.size / 1024).toFixed(2); // Konversi ke KB
            const fileSizeMB = (fileSizeKB / 1024).toFixed(2); // Konversi ke MB

            // Tampilkan ukuran file (pilih KB jika di bawah 1 MB, jika lebih gunakan MB)
            fileSizeDisplay.textContent = `Ukuran Asli : ${fileSizeKB < 1024 ? `${fileSizeKB} KB` : `${fileSizeMB} MB`}`;

            // Tampilkan preview gambar
            const fileImgKk = new FileReader();
            fileImgKk.readAsDataURL(file);
            fileImgKk.onload = function(e) {
                imgPreviewKk.src = e.target.result;
            };
        } else {
            fileSizeDisplay.textContent = "No file selected";
            imgPreviewKk.src = "";
        }
    }

    function previewImgKtp() {
        const ktp = document.querySelector('#ktp');
        const imgPreviewKtp = document.querySelector('.img-preview-ktp');
        const fileSizeDisplay = document.querySelector('.file-size-ktp');

        if (ktp.files.length > 0) {
            const file = ktp.files[0];
            const fileSizeKB = (file.size / 1024).toFixed(2);
            const fileSizeMB = (fileSizeKB / 1024).toFixed(2);

            // Tampilkan ukuran file
            fileSizeDisplay.textContent = `Ukuran Asli : ${fileSizeKB < 1024 ? `${fileSizeKB} KB` : `${fileSizeMB} MB`}`;

            // Tampilkan preview gambar
            const fileImgKtp = new FileReader();
            fileImgKtp.readAsDataURL(file);
            fileImgKtp.onload = function(e) {
                imgPreviewKtp.src = e.target.result;
            };
        } else {
            fileSizeDisplay.textContent = "Ukuran Asli : 0 KB";
            imgPreviewKtp.src = "";
        }
    }

    function previewImgPassportPhoto() {
        const passportPhoto = document.querySelector('#passport_photo');
        const imgPreviewPassportPhoto = document.querySelector('.img-preview-passport-photo');
        const fileSizeDisplay = document.querySelector('.file-size-passport-photo');

        if (passportPhoto.files.length > 0) {
            const file = passportPhoto.files[0];
            const fileSizeKB = (file.size / 1024).toFixed(2);
            const fileSizeMB = (fileSizeKB / 1024).toFixed(2);

            fileSizeDisplay.textContent = `Ukuran Asli : ${fileSizeKB < 1024 ? `${fileSizeKB} KB` : `${fileSizeMB} MB`}`;

            const fileImgPassport = new FileReader();
            fileImgPassport.readAsDataURL(file);
            fileImgPassport.onload = function(e) {
                imgPreviewPassportPhoto.src = e.target.result;
            };
        } else {
            fileSizeDisplay.textContent = "Ukuran Asli : 0 KB";
            imgPreviewPassportPhoto.src = "";
        }
    }

    function previewImgVaccine() {
        const vaccine = document.querySelector('#vaccine');
        const imgPreviewVaccine = document.querySelector('.img-preview-vaccine');
        const fileSizeDisplay = document.querySelector('.file-size-vaccine');

        if (vaccine.files.length > 0) {
            const file = vaccine.files[0];
            const fileSizeKB = (file.size / 1024).toFixed(2);
            const fileSizeMB = (fileSizeKB / 1024).toFixed(2);

            fileSizeDisplay.textContent = `Ukuran Asli : ${fileSizeKB < 1024 ? `${fileSizeKB} KB` : `${fileSizeMB} MB`}`;

            const fileImgVaccine = new FileReader();
            fileImgVaccine.readAsDataURL(file);
            fileImgVaccine.onload = function(e) {
                imgPreviewVaccine.src = e.target.result;
            };
        } else {
            fileSizeDisplay.textContent = "Ukuran Asli : 0 KB";
            imgPreviewVaccine.src = "";
        }
    }

    function previewImgHealth() {
        const healthCertificate = document.querySelector('#health');
        const imgPreviewHealth = document.querySelector('.img-preview-health');
        const fileSizeDisplay = document.querySelector('.file-size-health');

        if (healthCertificate.files.length > 0) {
            const file = healthCertificate.files[0];
            const fileSizeKB = (file.size / 1024).toFixed(2);
            const fileSizeMB = (fileSizeKB / 1024).toFixed(2);

            fileSizeDisplay.textContent = `Ukuran Asli : ${fileSizeKB < 1024 ? `${fileSizeKB} KB` : `${fileSizeMB} MB`}`;

            const fileImgHealth = new FileReader();
            fileImgHealth.readAsDataURL(file);
            fileImgHealth.onload = function(e) {
                imgPreviewHealth.src = e.target.result;
            };
        } else {
            fileSizeDisplay.textContent = "Ukuran Asli : 0 KB";
            imgPreviewHealth.src = "";
        }
    }


    function previewImgPassport() {
        const passport = document.querySelector('#passport');
        const imgPreviewPassport = document.querySelector('.img-preview-passport');
        const fileSizeDisplay = document.querySelector('.file-size-passport');

        if (passport.files.length > 0) {
            const file = passport.files[0];
            const fileSizeKB = (file.size / 1024).toFixed(2);
            const fileSizeMB = (fileSizeKB / 1024).toFixed(2);

            fileSizeDisplay.textContent = `Ukuran Asli : ${fileSizeKB < 1024 ? `${fileSizeKB} KB` : `${fileSizeMB} MB`}`;

            const fileImgPassport = new FileReader();
            fileImgPassport.readAsDataURL(file);
            fileImgPassport.onload = function(e) {
                imgPreviewPassport.src = e.target.result;
            };
        } else {
            fileSizeDisplay.textContent = "Ukuran Asli : 0 KB";
            imgPreviewPassport.src = "";
        }
    }

</script>
@endsection