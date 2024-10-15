@extends('layouts.backend.main')

@section('title', 'Transaksi')

@section('css')
<link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" >
<link href="{{ asset('backend') }}/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
@endsection

@section('content')
<div class="db-info-wrap">
    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-box">
                <h4>Riwayat Pembayaran</h4>
                <div class="table-responsive">
                    <table id="transaction" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jemaah</th>
                                <th>Maskapai</th>
                                <th>Paket</th>
                                <th>Tanggal Berangkat</th>
                                <th>Hari</th>
                                <th>Metode Pembayaran</th>
                                <th>Bank</th>
                                <th>Total</th>
                                <th>Status Pembayaran</th>
                                <th>Tanggal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="package-name">{{ $transaction->User->name }}</span>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/packages/' . $transaction->Package->airline) }}" width="70px" class="img-fluid" alt="image">
                                </td>
                                <td>
                                    <span class="package-name">{{ $transaction->Package->name }}</span>
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
                                <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
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
</div>
@endsection

@section('js')
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transaction').DataTable();
    });
</script>
@endsection