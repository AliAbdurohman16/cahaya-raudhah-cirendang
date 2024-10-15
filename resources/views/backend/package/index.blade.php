@extends('layouts.backend.main')

@section('title', 'Data Paket')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap db-package-wrap">
    <a href="{{ route('packages.create') }}" class="btn btn-primary mb-2">Tambah Data</a>
    <div class="dashboard-box table-opp-color-box">
        <div class="table-responsive">
            <table id="package" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Maskapai</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Maks Penumpang</th>
                        <th colspan="2" class="text-center">Hotel</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $package)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('storage/packages/' . $package->airline) }}" width="70px" class="img-fluid" alt="image">
                        </td>
                        <td>
                            </span><span class="package-name">{{ $package->name }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($package->date)->translatedFormat('d F Y') }}</td>
                        <td>{{ $package->day }}</td>
                        <td>{{ $package->passenger }}</td>
                        @if($package->Hotels->isNotEmpty())
                            @foreach ($package->Hotels->sortBy('position') as $index => $hotel)
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
                        @else
                            <td colspan="2">Tidak ada hotel tersedia</td>
                        @endif
                        <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge badge-{{ $package->status == 'aktif' ? 'success' : 'danger' }}">
                                {{ $package->status == 'aktif' ? 'Aktif' : 'Sold Out' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('packages.edit', $package) }}" class="badge badge-success text-white mb-2"><i class="far fa-edit"></i></a>
                            <span class="badge badge-danger btn-delete" data-id="{{ $package->id }}"><i class="far fa-trash-alt"></i></span>
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
<script src="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#package').DataTable();
    });

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

    $(".btn-delete").click(function() {
        var id = $(this).data("id");
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin ingin menghapus?",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "packages/" + id,
                    type: 'DELETE',
                    data: {
                        "id": id,
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                });
            }
        })
    });
</script>
@endsection