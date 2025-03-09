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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="start_date">Dari Tanggal</label>
                            <input id="startDate" type="text" class="form-control @error('start_date') is-invalid @enderror" name="start_date" placeholder="yyyy-mm-dd --:--">
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
                            <input id="endDate" type="text" class="form-control @error('end_date') is-invalid @enderror" name="end_date" placeholder="yyyy-mm-dd --:--" disabled>
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="button" class="btn button-primary" id="btnProses" disabled>Proses</button>
                <button type="button" class="btn button-secondary" id="btnReset">Reset</button>
            </div>
        </div> 
        <div class="col-lg-12">
            <div class="dashboard-box">
                <button class="btn btn-sm button-export mb-3" id="btnExport" disabled><i class="fas fa-file-excel"></i> Export Excel</button>
                <div class="table-responsive">
                    <table id="report" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Jemaah</th>
                                <th>Paket</th>
                                <th>Metode Pembayaran</th>
                                <th>Bank</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>   
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('backend') }}/assets/plugins/flatpickr/flatpickr.min.js"></script>
<script>
    $(document).ready(function() {
        flatpickr("#startDate", {
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
        
        flatpickr("#endDate", {
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
        
        $('#startDate').change(function() {
            $('#endDate').removeAttr('disabled');
        });
        
        $('#endDate').change(function() {
            $('#btnProses').removeAttr('disabled');
        });

        $('#btnProses').click(function() {
            $('#btnExport').removeAttr('disabled');

            $.ajax({
                url: '{{ route('report.store') }}',
                method: 'POST',
                data: {
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    let tbody = $('tbody');
                    tbody.empty();

                    let totalKeseluruhan = 0;

                    $.each(response.transactions, function(index, transaction) {
                        let date = new Date(transaction.created_at)

                        let options = { day: '2-digit', month: 'long', year: 'numeric' };
                        let formattedDate = date.toLocaleDateString('id-ID', options);

                        let paymentType = transaction.payment_type !== 'credit_card'
                            ? transaction.payment_type.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase())
                            : 'Credit Card';

                        let bankName = transaction.bank.toUpperCase();

                        let formattedTotal = new Intl.NumberFormat('id-ID').format(transaction.total);

                        totalKeseluruhan += parseFloat(transaction.total);

                        let row = `
                            <tr>
                                <td>${index + 1}
                                <td>${transaction.id}</td>
                                <td>${formattedDate}</td>
                                <td>${transaction.user.name}</td>
                                <td>${transaction.package.name}</td>
                                <td>${paymentType}</td>
                                <td>${bankName}</td>
                                <td>Rp ${formattedTotal}</td>
                            </tr>
                        `;

                        tbody.append(row);
                    });
                    
                    
                    let formattedTotalKeseluruhan = new Intl.NumberFormat('id-ID').format(totalKeseluruhan);

                    let totalRow = `
                        <tr>
                            <td colspan="6"></td>
                            <td class="text-end"><strong>Total Keseluruhan:</strong></td>
                            <td><strong>Rp ${formattedTotalKeseluruhan}</strong></td>
                        </tr>
                    `;
                    tbody.append(totalRow);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        $('#btnExport').click(function() {
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();

            let form = $('<form>', {
                action: '{{ route('report.export') }}',
                method: 'POST'
            }).append(
                $('<input>', { type: 'hidden', name: 'start_date', value: start_date }),
                $('<input>', { type: 'hidden', name: 'end_date', value: end_date }),
                $('<input>', { type: 'hidden', name: '_token', value: '{{ csrf_token() }}' })
            );

            $('body').append(form);
            form.submit();
        });

        $('#btnReset').click(function() {
            window.location.reload();
        });
    });
</script>
@endsection