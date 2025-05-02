@extends('layouts.backend.main')

@section('title', 'Dokumen')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box user-form-wrap">
                <h4>Dokumen</h4>
                @php
                    $missing = [];

                    if (!$document->kk) $missing[] = 'Foto Kartu Keluarga';
                    if (!$document->ktp) $missing[] = 'Foto KTP';
                    if (!$document->passport_photo) $missing[] = 'Pas Foto';
                    if (!$document->vaccine_certificate) $missing[] = 'Foto Sertifikat Vaksin';
                    if (!$document->health_certificate) $missing[] = 'Foto Surat Keterangan Sehat';
                    if (!$document->passport) $missing[] = 'Foto Paspor';

                    $missingValidation = [];

                    if (!empty($document->kk) && $document->kk_validation_status === 'belum valid') $missingValidation[] = 'Foto Kartu Keluarga';
                    if (!empty($document->ktp) && $document->ktp_validation_status === 'belum valid') $missingValidation[] = 'Foto KTP';
                    if (!empty($document->passport_photo) && $document->passport_photo_validation_status === 'belum valid') $missingValidation[] = 'Pas Foto';
                    if (!empty($document->vaccine_certificate) && $document->vaccine_certificate_validation_status === 'belum valid') $missingValidation[] = 'Foto Sertifikat Vaksin';
                    if (!empty($document->health_certificate) && $document->health_certificate_validation_status === 'belum valid') $missingValidation[] = 'Foto Surat Keterangan Sehat';
                    if (!empty($document->passport) && $document->passport_validation_status === 'belum valid') $missingValidation[] = 'Foto Paspor';
                @endphp

                @if (count($missing) > 0)
                    <div class="alert alert-warning" role="alert">
                        Silakan lengkapi dokumen berikut:
                        <ul class="mb-0">
                            @foreach ($missing as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (count($missingValidation) > 0)
                    <div class="alert alert-info" role="alert">
                        <ul class="mb-0">
                            @foreach ($missingValidation as $item)
                                <li>{{ $item }} - Belum divalidasi oleh admin</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('document.store') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="kk">Foto Kartu Keluarga</label>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-4">
                                        <img src="{{ $document->kk ? asset('storage/kk/' . $document->kk) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-kk mb-2" width="100px">
                                        <br>
                                        <small class="file-size-kk">Ukuran Asli : {{ $document->original_kk_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $document->compressed_kk_size ?? '0 KB' }}</small> <br>
                                        <small>Compression Ratio : {{ $document->kk_compression_ratio ?? '0%' }}</small> <br>
                                        <small>Space Saving : {{ $document->kk_space_saving ?? '0%' }}</small> <br>
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
                                        <img src="{{ $document->ktp ? asset('storage/ktp/' . $document->ktp) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-ktp mb-2" width="100px">
                                        <br>
                                        <small class="file-size-ktp">Ukuran Asli : {{ $document->original_ktp_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $document->compressed_ktp_size ?? '0 KB' }}</small> <br>
                                        <small>Compression Ratio : {{ $document->ktp_compression_ratio ?? '0%' }}</small> <br>
                                        <small>Space Saving : {{ $document->ktp_space_saving ?? '0%' }}</small> <br>
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
                                        <img src="{{ $document->passport_photo ? asset('storage/passport_photo/' . $document->passport_photo) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-passport-photo mb-2" width="100px">
                                        <br>
                                        <small class="file-size-passport-photo">Ukuran Asli : {{ $document->original_passport_photo_size ?? '0 KB' }}  KB</small> <br>
                                        <small>Ukuran Kompresi : {{ $document->compressed_passport_photo_size ?? '0 KB' }}</small> <br>
                                        <small>Compression Ratio : {{ $document->passport_photo_compression_ratio ?? '0%' }}</small> <br>
                                        <small>Space Saving : {{ $document->passport_photo_space_saving ?? '0%' }}</small> <br>
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
                                        <img src="{{ $document->vaccine_certificate ? asset('storage/vaccine_certificates/' . $document->vaccine_certificate) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-vaccine mb-2" width="100px">
                                        <br>
                                        <small class="file-size-vaccine">Ukuran Asli : {{ $document->original_vaccine_certificate_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $document->compressed_vaccine_certificate_size ?? '0 KB' }}</small> <br>
                                        <small>Compression Ratio : {{ $document->vaccine_certificate_compression_ratio ?? '0%' }}</small> <br>
                                        <small>Space Saving : {{ $document->vaccine_certificate_space_saving ?? '0%' }}</small> <br>
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
                                        <img src="{{ $document->health_certificate ? asset('storage/health_certificates/' . $document->health_certificate) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-health mb-2" width="100px">
                                        <br>
                                        <small class="file-size-health">Ukuran Asli : {{ $document->original_health_certificate_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $document->compressed_health_certificate_size ?? '0 KB' }}</small> <br>
                                        <small>Compression Ratio : {{ $document->health_certificate_compression_ratio ?? '0%' }}</small> <br>
                                        <small>Space Saving : {{ $document->health_certificate_space_saving ?? '0%' }}</small> <br>
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
                                        <img src="{{ $document->passport ? asset('storage/passports/' . $document->passport) : asset('default/image.png') }}" alt="image"class="img-thumbnail img-preview-passport mb-2" width="100px">
                                        <br>
                                        <small class="file-size-passport">Ukuran Asli : {{ $document->original_passport_size ?? '0 KB' }}</small> <br>
                                        <small>Ukuran Kompresi : {{ $document->compressed_passport_size ?? '0 KB' }}</small> <br>
                                        <small>Compression Ratio : {{ $document->passport_compression_ratio ?? '0%' }}</small> <br>
                                        <small>Space Saving : {{ $document->passport_space_saving ?? '0%' }}</small> <br>
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