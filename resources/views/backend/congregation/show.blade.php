@extends('layouts.backend.main')

@section('title', 'Detail Data Jemaah')

@section('content')
<div class="db-info-wrap db-add-tour-wrap">
    <div class="row">
        <!-- Listings -->
        <div class="col-lg-12">
            <div class="dashboard-box">
                <div class="custom-field-wrap">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless m-3">
                                <tr>
                                    <td class="font-weight-bold">NIK</td>
                                    <td width="2%">:</td>
                                    <td>{{ $biodata->name }}</td>
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
                        <div class="col-md-6">
                            <table class="table table-borderless m-3">
                                <tr>
                                    <td class="font-weight-bold">Foto Kartu Keluarga</td>
                                    <td width="2%">:</td>
                                    <td>
                                        <img src="{{ asset('storage/kk/' . $biodata->kk) }}" width="40%" alt="kk">
                                        <br>
                                        <a href="{{ asset('storage/kk/' . $biodata->kk) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Foto KTP</td>
                                    <td width="2%">:</td>
                                    <td>
                                        <img src="{{ asset('storage/ktp/' . $biodata->ktp) }}" width="40%" alt="ktp">
                                        <br>
                                        <a href="{{ asset('storage/ktp/' . $biodata->ktp) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Foto Sertifikat Vaksin</td>
                                    <td width="2%">:</td>
                                    <td>
                                        <img src="{{ asset('storage/vaccine_certificates/' . $biodata->vaccine_certificate) }}" width="40%" alt="vaccine_certificate">
                                        <br>
                                        <a href="{{ asset('storage/vaccine_certificates/' . $biodata->vaccine_certificate) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Foto Paspor</td>
                                    <td width="2%">:</td>
                                    <td>
                                        <img src="{{ asset('storage/passports/' . $biodata->passport) }}" width="40%" alt="passport">
                                        <br>
                                        <a href="{{ asset('storage/passports/' . $biodata->passport) }}" class="btn btn-primary text-white w-40 btn-sm mt-2" download>Unduh</a>
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
</div>
@endsection