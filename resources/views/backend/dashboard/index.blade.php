@extends('layouts.backend.main')

@section('title', 'Dashboard')

@section('css')
@if (Auth::user()->hasRole('user'))
<link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endif
@endsection

@section('content')
<div class="db-info-wrap">
    @if (Auth::user()->hasRole('user'))
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Riwayat Pembayaran</h4>
                <div class="table-responsive">
                    <table id="transaction" class="table">
                        <thead>
                            <tr>
                                <th>Maskapai</th>
                                <th>Paket</th>
                                <th>Tanggal Berangkat</th>
                                <th>Hari</th>
                                <th>Metode Pembayaran</th>
                                <th>Bank</th>
                                <th>Harga</th>
                                <th>Status Pembayaran</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/packages/' . $transaction->Package->airline) }}" width="70px" class="img-fluid" alt="image">
                                </td>
                                <td>
                                    </span><span class="package-name">{{ $transaction->Package->name }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($transaction->Package->date)->translatedFormat('d F Y') }}</td>
                                <td>{{ $transaction->Package->day }}</td>
                                <td>
                                    {{ 
                                        $transaction->payment_type !== 'credit_card' ? 
                                        ucwords(str_replace('_', ' ', $transaction->payment_type)) : 
                                        'Credit Card' 
                                    }}
                                </td>
                                <td>{{ strtoupper($transaction->bank) }}</td>
                                <td>Rp {{ number_format($transaction->Package->price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge badge-success">Berhasil</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </div>
    @else
    <div class="row">
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-blue">
                    <i class="far fa-kaaba"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Total Paket</h4>
                    <h5>{{ $package }}</h5> 
                </div>
            </div>
        </div>
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-green">
                    <i class="fas fa-kaaba"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Paket Aktif</h4>
                    <h5>{{ $package_active }}</h5> 
                </div>
            </div>
        </div>
        <!-- Item -->
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-red">
                    <i class="fas fa-kaaba"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Paket Sold Out</h4>
                    <h5>{{ $package_soldout }}</h5> 
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-purple">
                    <i class="far fa-dollar-sign"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Pendapatan Hari Ini</h4>
                    <h5>Rp {{ number_format($daily_income, 0, ',', '.') }}</h5> 
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-blue">
                    <i class="far fa-dollar-sign"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Pendapatan Bulan Ini</h4>
                    <h5>Rp {{ number_format($monthly_income, 0, ',', '.') }}</h5> 
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="db-info-list">
                <div class="dashboard-stat-icon bg-green">
                    <i class="far fa-dollar-sign"></i>
                </div>
                <div class="dashboard-stat-content">
                    <h4>Pendapatan Tahun Ini</h4>
                    <h5>Rp {{ number_format($yearly_income, 0, ',', '.') }}</h5> 
                </div>
            </div>
        </div>
    </div>
    <!-- Bar Chart -->
    <div class="col-lg-12">
        <div class="dashboard-box chart-box">
           <h4>Bar Chart Tahun {{ date('Y') }}</h4>
           <div id="barchart" style="height: 250px; width: 100%;"></div>
        </div>
    </div>
    @endif
    @if (Auth::user()->hasRole('owner'))
    <!-- Log Activity -->
    <div class="col-lg-12">
        <div class="dashboard-box activities-box">
            <h4>Log Aktivitas</h4>
            <table class="table">
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
                        <tr>
                            <td colspan="4">Tidak ada aktivitas.</td>
                        </tr>
                    @endforelse 
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@section('js')
@if (Auth::user()->hasRole('user'))
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transaction').DataTable();
    });
</script>
@else
<script src="{{ asset('backend') }}/assets/js/canvasjs.min.js"></script>
<script>
    var monthlyData = @json($chartMonthly).map(value => parseFloat(value));

    var chart1 = new CanvasJS.Chart("barchart", {
		animationEnabled: true,
		theme: "light2",
		axisY: {
			title: "Transaksi",
            minimum: 0,
		},
        axisX: {
            interval: 1,
            labelAngle: -70
        },
		data: [{        
			type: "column",
			dataPoints: [      
				{ y: monthlyData[0], label: "Januari" },
                { y: monthlyData[1], label: "Februari" },
                { y: monthlyData[2], label: "Maret" },
                { y: monthlyData[3], label: "April" },
                { y: monthlyData[4], label: "Mei" },
                { y: monthlyData[5], label: "Juni" },
                { y: monthlyData[6], label: "Juli" },
                { y: monthlyData[7], label: "Agustus" },
                { y: monthlyData[8], label: "September" },
                { y: monthlyData[9], label: "Oktober" },
                { y: monthlyData[10], label: "November" },
                { y: monthlyData[11], label: "Desember" }
			]
		}]
	});
	chart1.render();
</script>
@endif
@endsection