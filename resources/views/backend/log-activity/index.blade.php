@extends('layouts.backend.main')

@section('title', 'Log Aktivitas')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <div class="table-responsive">
                    <table id="log-activity" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aktivitas</th>
                                <th>Tanggal & Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activities as $activity)
                                @if ($activity->causer_id)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            </span><span class="package-name">
                                                {{ optional($activity->causer)->name }}
                                            </span>
                                        </td>
                                        <td>{{ $activity->description }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($activity->created_at)) }}</td>
                                    </tr>
                                @elseif($activity->causer_id)
                                    <tr>
                                        <td colspan="4">Akun sudah dihapus.</td>
                                    </tr>
                                @endif
                            @empty
                            @endforelse 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#log-activity').DataTable();
    });
</script>
@endsection