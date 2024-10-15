@extends('layouts.frontend.main')

@section('title', 'Pembayaran')

@section('content')
<main id="content" class="site-main">
    <!-- Inner Banner html start-->
    <section class="inner-banner-wrap">
       <div class="inner-baner-container" style="background-image: url({{ asset('frontend') }}/assets/images/background.jpeg);">
          <div class="container">
             <div class="inner-banner-content">
                <h1 class="inner-title">Pembayaran</h1>
             </div>
          </div>
       </div>
       <div class="inner-shape"></div>
    </section>
    <!-- Inner Banner html end-->
    <div class="step-section cart-section">
       <div class="container">
          <!-- step one form html start -->
          <div class="cart-list-inner">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Maskapai</th>
                        <th>Paket</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td data-column="Maskapai">
                          <span class="cartImage"><img src="{{ asset('storage/packages/' . $package->airline) }}" alt="image"></span>
                        </td>
                        <td data-column="Paket">{{ $package->name }}</td>
                        <td data-column="Tanggal">{{ \Carbon\Carbon::parse($package->date)->translatedFormat('d F Y') }}</td>
                        <td data-column="Hari">{{ $package->day }}</td>
                        <td data-column="Sub Total">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="text-center">
                  <button class="button-primary w-100" id="pay">Bayar</button>
                </div>
          </div>
          <!-- step one form html end -->
       </div>
    </div>
</main>
@endsection

@section('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay').onclick = function () {
        const package_id = '{{ $package->id }}';
        const total = {{ $package->price }};

        fetch('{{ route('pay') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                total: total,
            })
        })
        .then(response => {
            // Check if the response is OK
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Check if the snap_token is present in the response
            if (data.snap_token) {
                // Redirect to the dashboard after successful payment
                snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        const bank = (result.payment_type === 'credit_card') ? result.bank 
                                        : (result.va_numbers && result.va_numbers.length > 0) 
                                        ? result.va_numbers[0].bank : null;

                        fetch('{{ route('paySuccess') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify({
                                package_id: package_id,
                                total: total,
                                order_id: result.order_id,
                                biller_code: result.biller_code,
                                permata_va_number: result.permata_va_number,
                                payment_type: result.payment_type,
                                bank: bank,
                            })
                        }).then(response => {
                            if (response.ok) {
                                window.location.href = '{{ route('dashboard') }}';
                            } else {
                                console.error('Failed to update transaction');
                            }
                        });
                    },
                    // onPending: function(result) {
                    //     console.error('Payment pending:', result);
                    // },
                    onError: function(result) {
                        console.error('Payment error:', result);
                        alert('Payment failed. Please try again.');
                    }
                });
            } else {
                alert('Error getting Snap token');
            }
        })
        .catch(error => {
            console.error('Error during fetch:', error);
            alert('Failed to process payment. Please try again.');
        });
    };
</script>   
@endsection