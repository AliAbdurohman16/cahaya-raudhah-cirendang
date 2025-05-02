@extends('layouts.backend.main')

@section('title', 'Detail Data Jemaah')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap db-add-tour-wrap">
    <div class="row">
        <!-- Listings -->
        <div class="col-lg-12">
            <div class="dashboard-box">
                <div class="custom-field-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-borderless m-3">
                                <tr>
                                    <td class="font-weight-bold">NIK</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Nama Lengkap</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Nama Ayah</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->father_name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tempat Lahir</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->place_birth }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Lahir</td>
                                    <td width="2%">:</td>
                                    <td>{{ \Carbon\Carbon::parse($biodata->date_birth)->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Jenis Kelamin</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->gender }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">No HP</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Pekerjaan</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->work }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Pendidikan Terkahir</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->highest_education }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Alamat</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->address }}</td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="container">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Foto Kartu Keluarga</label>
                                                <img src="{{ asset('storage/kk/' . $biodata->User->Documents->first()->kk) }}" width="40%" alt="kk">
                                                <br>
                                                <a href="{{ asset('storage/kk/' . $biodata->User->Documents->first()->kk) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                                <br>
                                                @if ($biodata->User->Documents->first()->kk_validation_status != 'valid')
                                                    <form action="{{ route('congregations.validation.kk', $biodata->user->documents->first()->id) }}" method="POST" class="d-inline">
                                                      @csrf
                                                      @method('PUT')
                                                      <input type="hidden" name="kk_validation_status" value="valid">
                                                      <button type="submit" class="btn btn-success w-40 btn-sm mt-2">Validasi</button>
                                                  </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="container">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Foto KTP</label>
                                                <img src="{{ asset('storage/ktp/' . $biodata->User->Documents->first()->ktp) }}" width="40%" alt="ktp">
                                                <br>
                                                <a href="{{ asset('storage/ktp/' . $biodata->User->Documents->first()->ktp) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                                <br>
                                                @if ($biodata->User->Documents->first()->ktp_validation_status != 'valid')
                                                    <form action="{{ route('congregations.validation.ktp', $biodata->user->documents->first()->id) }}" method="POST" class="d-inline">
                                                      @csrf
                                                      @method('PUT')
                                                      <input type="hidden" name="ktp_validation_status" value="valid">
                                                      <button type="submit" class="btn btn-success w-40 btn-sm mt-2">Validasi</button>
                                                  </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="container">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Pas Foto</label>
                                                <img src="{{ asset('storage/passport_photo/' . $biodata->User->Documents->first()->passport_photo) }}" width="40%" alt="passport_photo">
                                                <br>
                                                <a href="{{ asset('storage/passport_photo/' . $biodata->User->Documents->first()->passport_photo) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                                <br>
                                                @if ($biodata->User->Documents->first()->passport_photo_validation_status != 'valid')
                                                    <form action="{{ route('congregations.validation.passport-photo', $biodata->user->documents->first()->id) }}" method="POST" class="d-inline">
                                                      @csrf
                                                      @method('PUT')
                                                      <input type="hidden" name="passport_photo_validation_status" value="valid">
                                                      <button type="submit" class="btn btn-success w-40 btn-sm mt-2">Validasi</button>
                                                  </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="container">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Foto Sertifikat Vaksin</label>
                                                <img src="{{ asset('storage/vaccine_certificates/' . $biodata->User->Documents->first()->vaccine_certificate) }}" width="40%" alt="vaccine_certificate">
                                                <br>
                                                <a href="{{ asset('storage/vaccine_certificates/' . $biodata->User->Documents->first()->vaccine_certificate) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                                <br>
                                                @if ($biodata->User->Documents->first()->vaccine_certificate_validation_status != 'valid')
                                                    <form action="{{ route('congregations.validation.vaccine-certificate', $biodata->user->documents->first()->id) }}" method="POST" class="d-inline">
                                                      @csrf
                                                      @method('PUT')
                                                      <input type="hidden" name="vaccine_certificate_validation_status" value="valid">
                                                      <button type="submit" class="btn btn-success w-40 btn-sm mt-2">Validasi</button>
                                                  </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="container">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Foto Surat Keterangan Sehat</label>
                                                <img src="{{ asset('storage/health_certificates/' . $biodata->User->Documents->first()->health_certificate) }}" width="40%" alt="health_certificate">
                                                <br>
                                                <a href="{{ asset('storage/health_certificates/' . $biodata->User->Documents->first()->health_certificate) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                                <br>
                                                @if ($biodata->User->Documents->first()->health_certificate_validation_status != 'valid')
                                                    <form action="{{ route('congregations.validation.health-certificate', $biodata->user->documents->first()->id) }}" method="POST" class="d-inline">
                                                      @csrf
                                                      @method('PUT')
                                                      <input type="hidden" name="health_certificate_validation_status" value="valid">
                                                      <button type="submit" class="btn btn-success w-40 btn-sm mt-2">Validasi</button>
                                                  </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="container">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Foto Paspor</label>
                                                <img src="{{ asset('storage/passports/' . $biodata->User->Documents->first()->passport) }}" width="40%" alt="passport">
                                                <br>
                                                <a href="{{ asset('storage/passports/' . $biodata->User->Documents->first()->passport) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                                <br>
                                                @if ($biodata->User->Documents->first()->passport_validation_status != 'valid')
                                                    <form action="{{ route('congregations.validation.passport', $biodata->user->documents->first()->id) }}" method="POST" class="d-inline">
                                                      @csrf
                                                      @method('PUT')
                                                      <input type="hidden" name="passport_validation_status" value="valid">
                                                      <button type="submit" class="btn btn-success w-40 btn-sm mt-2">Validasi</button>
                                                  </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
</script>
@endsection