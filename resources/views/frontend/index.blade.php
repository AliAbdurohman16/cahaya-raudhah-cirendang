@extends('layouts.frontend.main')

@section('title', 'Beranda')

@section('content')
<main id="content" class="site-main">
    <!-- Home slider html start -->
    <section class="home-slider-section">
        <div class="home-slider">
          <div class="home-banner-items">
             <div class="banner-inner-wrap" style="background-image: url({{ asset('frontend') }}/assets/images/background.jpeg);"></div>
                <div class="banner-content-wrap">
                   <div class="container">
                      <div class="banner-content text-center">
                         <h2 class="banner-title">Paket Umroh Terbaik di Indonesia</h2>
                         <h3 class="text-white">Agen Resmi Umroh dengan Layanan Berkualitas dan Harga Terjangkau</h3>
                         <p>Nikmati kemudahan dan keamanan perjalanan dengan paket umroh dan haji terbaik yang kami tawarkan. Mari menggapai umroh dan haji yang mabrur, meraih pahala yang banyak serta ampunan Allah Subhanahu Wata’ala.</p>
                         <a href="{{ route('register') }}" class="button-primary">Daftar Sekarang</a>
                      </div>
                   </div>
                </div>
             <div class="overlay"></div>
          </div>
       </div>
       <div class="trip-search-section shape-search-section">
          <div class="slider-shape"></div>
       </div>
    </section>
    <!-- slider html start -->
    <!-- Home callback section html start -->
    <section class="callback-section" id="profil">
        <div class="container">
           <div class="row no-gutters align-items-center">
              <div class="col-lg-5">
                    <div class="callback-img" style="background-image: url({{ asset('frontend') }}/assets/images/about.png);"></div>
              </div>
              <div class="col-lg-7">
                 <div class="callback-inner">
                    <div class="section-heading section-heading-white">
                        <h5 class="dash-style">Profil</h5>
                        <h2>Cahaya Raudhah!</h2>
                        <p>Berawal dari KBIH Al lkhlas Yang didirikan Sejak tahun 1990. kemudian tumbuh dan berkembang.</p>
                        <p>Dibawah pimpinan Bapak H.Wawan Hermawan tahun 2010 KBIH Al ikhlas semakin melebarkan sayap dan berkembang sehingga mampu mendirikan Perusahaan travel Haji dan Umrah sendiri yang diberi nama PT Cahaya Raudhah.</p>
                        <p>Tidak hanya melayani umrah dan haji kami juga melayani penjualan tiket serta paket wisata halal baik domestic dan international.</p>
                        <p>Untuk memperkuat bisnis kami telah menjadi anggota dari Association Of The Indonesian Tours & Travels Agencies (ASITA), Kesatuan Tour Travel Haji Umroh Republik Indonesia (KESTHURI).</p>
                        <p>Selain sebagai komitmen legalitas perusahaan dalam melayani custumer serta jamaah secara professional kami telah memiliki izin resmi sebagai Biro Perjalanan Wisata dan sebagai Penyelenggara lbadah Haji dan Umrah dari Kementrian Agama RI.</p>
                        <h3 class="mt-5">Tim Cahaya Raudhah Cabang Kuningan</h3>
                        <ul>
                            <li>Sri Rahayu sebagai Kepala Cabang CR Cirendang.</li>
                            <li>Eli Hermawati sebagai Wakil Kepala Cabang CR Cirendang.</li>
                            <li>Hemalia Amanda sebagai admin Cabang CR Cirendang.</li>
                        </ul>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <!-- callback html end -->
    <!-- Home activity section html start -->
    <section class="activity-section" id="service">
       <div class="container">
          <div class="section-heading text-center">
             <div class="row">
                <div class="col-lg-8 offset-lg-2">
                   <h5 class="dash-style">LAYANAN</h5>
                   <h2>Kenapa Memilih Cahaya Raudhah?</h2>
                   <p>Seluruh paket perjalanan haji dan umroh di Cahaya Raudhah telah mendapat ratusan testimoni positif dari masyarakat jawa barat. Anda juga dapat merasakan sendiri fasilitas premium kami dengan harga yang masih cukup terjangkau. Dengan fasilitas yang sudah All in, anda tidak perlu ribet lagi mengurus setiap kebutuhan anda. Berikut beberapa jaminan yang bisa anda dapatkan dari Cahaya Raudhah : </p>
                </div>
             </div>
          </div>
          <div class="activity-inner row">
             <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="activity-item">
                   <div class="activity-icon">
                      <a href="#">
                         <img src="{{ asset('frontend') }}/assets/images/check-svgrepo-com.svg" alt="">
                      </a>
                   </div>
                   <div class="activity-content">
                      <h4>
                         <a href="#">Akomodasi Terjamin</a>
                      </h4>
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="activity-item">
                   <div class="activity-icon">
                      <a href="#">
                         <img src="{{ asset('frontend') }}/assets/images/hands-pray-svgrepo-com.svg" alt="">
                      </a>
                   </div>
                   <div class="activity-content">
                      <h4>
                         <a href="#">Ibadah Aman dan Nyaman</a>
                      </h4>
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="activity-item">
                   <div class="activity-icon">
                      <a href="#">
                         <img src="{{ asset('frontend') }}/assets/images/flight-takeoff-svgrepo-com.svg" alt="">
                      </a>
                   </div>
                   <div class="activity-content">
                      <h4>
                         <a href="#">Perjalanan Aman dan Nyaman</a>
                      </h4>
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="activity-item">
                   <div class="activity-icon">
                      <a href="#">
                         <img src="{{ asset('frontend') }}/assets/images/users-group-svgrepo-com.svg" alt="">
                      </a>
                   </div>
                   <div class="activity-content">
                      <h4>
                         <a href="#">Bimbingan Sebelum dan Selama Umroh</a>
                      </h4>
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="activity-item">
                   <div class="activity-icon">
                      <a href="#">
                         <img src="{{ asset('frontend') }}/assets/images/money-svgrepo-com.svg" alt="">
                      </a>
                   </div>
                   <div class="activity-content">
                      <h4>
                         <a href="#">Pembayaran Mudah</a>
                      </h4>
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="activity-item">
                   <div class="activity-icon">
                      <a href="#">
                         <img src="{{ asset('frontend') }}/assets/images/form-svgrepo-com.svg" alt="">
                      </a>
                   </div>
                   <div class="activity-content">
                      <h4>
                         <a href="#">Administrasi Mudah</a>
                      </h4>
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="activity-item">
                   <div class="activity-icon">
                      <a href="#">
                         <img src="{{ asset('frontend') }}/assets/images/elderly-svgrepo-com.svg" alt="">
                      </a>
                   </div>
                   <div class="activity-content">
                      <h4>
                         <a href="#">Ramah Lansia</a>
                      </h4>
                   </div>
                </div>
             </div>
             <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="activity-item">
                   <div class="activity-icon">
                      <a href="#">
                         <img src="{{ asset('frontend') }}/assets/images/user-check-svgrepo-com.svg" alt="">
                      </a>
                   </div>
                   <div class="activity-content">
                      <h4>
                         <a href="#">Untuk Segala Usia</a>
                      </h4>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- activity html end -->
    <!-- Home special section html start -->
    <section class="best-section" id="legality">
       <div class="container">
          <div class="row">
             <div class="col-lg-6">
                <div class="section-heading">
                   <h5 class="dash-style">Legalitas</h5>
                   <h2>PT. Cahaya Raudhah</h2>
                   <p>PT. Cahaya Raudhah merupakan perusahaan travel umroh dan haji resmi yang memiliki perizinan legalitas oleh Kementrian Agama RI No 817 tahun 2019. Kami juga memiliki kantor sendiri dan puluhan cabang di Jawa Barat dan luar Jawa Barat yang bisa dikunjungi untuk konsultasi dan pendaftaran umroh & haji. Bergabung dalam ASITA (Association of The Indonesian Tours and Travel Agencies), dan juga merupakan bagian dari KESTHURI (Kesatuan Tour Travel Haji Umroh Republik Indonesia).</p>
                </div>
             </div>
             <div class="col-lg-6">
                <div class="row">
                   <div class="col-12">
                      <figure class="gallery-img">
                         <img src="{{ asset('frontend') }}/assets/images/legalitas.png" width="80%" alt="legalitas">
                      </figure>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- best html end -->
    <!-- Home subscribe section html start -->
    <section class="subscribe-section mt-4" style="background-image: url({{ asset('frontend') }}/assets/images/subscribe.jpeg);">
        <div class="container">
           <div class="row">
              <div class="col-lg-7">
                 <div class="section-heading section-heading-white">
                    <h2 class="text-white">Daftar Segera!</h2>
                    <h4>Dapatkan CASHBACK dan PROMO Menarik Lainnya untuk Seluruh Paket Haji dan Umroh. Segera daftar dan jangan lewatkan kesempatan ini untuk beribadah dengan lebih hemat dan berkah!</h4>
              </div>
           </div>
        </div>
     </section>
     <!-- subscribe html end -->
    <!-- Home packages section html start -->
    <section class="package-section">
        <div class="container">
           <div class="section-heading text-center">
              <div class="row">
                 <div class="col-lg-8 offset-lg-2">
                    <h5 class="dash-style">PAKET</h5>
                    <h2>PAKET HAJI DAN UMROH</h2>
                    <p>Nikmati paket haji dan umroh terbaik dengan pelayanan berkualitas, fasilitas lengkap, dan bimbingan ibadah yang nyaman.</p>
                 </div>
              </div>
           </div>
           <div class="package-inner">
                <div class="row">
                    @foreach ($packages as $package)
                    <div class="col-lg-4 col-md-6">
                        <div class="package-wrap">
                        <figure class="feature-image">
                            <a href="#">
                                <img src="{{ asset('storage/packages/' . $package->airline) }}" alt="paket">
                            </a>
                        </figure>
                        <div class="package-price">
                            <h6>
                                <span>Rp {{ number_format($package->price, 0, ',', '.') }} </span> / per orang
                            </h6>
                        </div>
                        <div class="package-content-wrap">
                            <div class="package-meta text-center">
                                <ul>
                                    <li>
                                        <i class="fas fa-calendar"></i>
                                        {{ \Carbon\Carbon::parse($package->date)->translatedFormat('d F Y') }}
                                    </li>
                                    <li>
                                        <i class="far fa-clock"></i>
                                        {{ $package->day }}
                                    </li>
                                </ul>
                            </div>
                            <div class="package-content">
                                <h3>
                                    <a href="{{ route('cart', $package->slug) }}">{{ $package->name }}</a>
                                </h3>
                                @foreach ($package->Hotels->sortBy('position') as $index => $hotel)
                                Hotel {{ $hotel->position }}
                                <div class="review-area">
                                    <span class="review-text">{{ $hotel->city }}</span>
                                    @php
                                        
                                        $ratingPercentage = ($hotel->star / 5) * 100;
                                    @endphp
                                    <div class="rating-start" title="Rated {{ $hotel->star }} out of 5">
                                    <span style="width: {{ $ratingPercentage }}%"></span>
                                    </div>
                                    <p>{{ $hotel->name }}</p>
                                </div>
                                @endforeach
                                <div class="btn-wrap">
                                    <a href="{{ route('cart', $package->slug) }}" class="button-text width-6">Beli Paket<i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="btn-wrap text-center">
                    <a href="{{ route('package') }}" class="button-primary">LIHAT SEMUA PAKET</a>
                </div>
           </div>
        </div>
     </section>
     <!-- packages html end -->
</main>
@endsection