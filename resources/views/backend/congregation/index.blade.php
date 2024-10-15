@extends('layouts.backend.main')

@section('title', 'Data Paket')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap db-package-wrap">
    <div class="dashboard-box table-opp-color-box">
        <div class="table-responsive">
            <table id="congregation" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jemaah</th>
                        <th>Maskapai</th>
                        <th>Nama</th>
                        <th>Tanggal Berangkat</th>
                        <th>Hari</th>
                        <th colspan="2" class="text-center">Hotel</th>
                        <th>Detail Data Jemaah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($congregations as $congregation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="package-name">{{ $congregation->User->name }}</span>
                        </td>
                        <td>
                            <img src="{{ asset('storage/packages/' . $congregation->Package->airline) }}" width="70px" class="img-fluid" alt="image">
                        </td>
                        <td>
                            </span><span class="package-name">{{ $congregation->Package->name }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($congregation->Package->date)->translatedFormat('d F Y') }}</td>
                        <td>{{ $congregation->Package->day }}</td>
                        @foreach ($congregation->Package->Hotels->sortBy('position') as $index => $hotel)
                            <td>
                                {{ $hotel->city }} 
                                <div class="rate-start">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star {{ $i <= $hotel->star ? 'active' : '' }}"></i>
                                    @endfor
                                </div>
                                {{ $hotel->name }}
                            </td>
                        @endforeach
                        <td>
                            <a href="{{ route('congregations.show', $congregation->user_id) }}" class="badge badge-info text-white mb-2"><i class="far fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#congregation').DataTable();
    });
</script>
@endsection