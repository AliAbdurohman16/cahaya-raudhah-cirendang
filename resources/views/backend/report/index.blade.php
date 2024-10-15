@extends('layouts.backend.main')

@section('title', 'Laporan')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/flatpickr/flatpickr.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-6">
            <div class="dashboard-box user-form-wrap">
                <form action="{{ route('report.store') }}" class="form-horizontal" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="start_date">Dari Tanggal</label>
                                <input id="start_date" type="text" class="form-control @error('start_date') is-invalid @enderror" name="start_date" placeholder="yyyy-mm-dd --:--">
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="end_date">Sampai Tanggal</label>
                                <input id="end_date" type="text" class="form-control @error('end_date') is-invalid @enderror" name="end_date" placeholder="yyyy-mm-dd --:--">
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
<script src="{{ asset('backend') }}/assets/plugins/flatpickr/flatpickr.min.js"></script>
<script>
    flatpickr("#start_date", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        placeholder: "yyyy-mm-dd --:--",
        time_24hr: true,
        locale: {
            firstDayOfWeek: 1,
            weekdays: {
                shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
            },
            months: {
                shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
            }
        }
    });

    flatpickr("#end_date", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        placeholder: "yyyy-mm-dd --:--",
        time_24hr: true,
        locale: {
            firstDayOfWeek: 1,
            weekdays: {
                shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
            },
            months: {
                shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                longhand: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']
            }
        }
    });
</script>
@endsection