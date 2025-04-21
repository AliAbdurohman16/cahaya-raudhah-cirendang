@extends('layouts.frontend.main')

@section('title', 'Paket')

@section('content')
<main id="content" class="site-main">
    <!-- Inner Banner html start-->
    <section class="inner-banner-wrap">
       <div class="inner-baner-container" style="background-image: url({{ asset('frontend') }}/assets/images/background.jpeg);">
          <div class="container">
             <div class="inner-banner-content">
                <h1 class="inner-title">Paket</h1>
             </div>
          </div>
       </div>
       <div class="inner-shape"></div>
    </section>
    <!-- Inner Banner html end-->
    <!-- packages html start -->
    <div class="package-section">
       <div class="container">
          <div class="package-inner">
             <div class="row">
                @foreach ($packages as $package)
                    <div class="col-lg-4 col-md-6">
                        <div class="package-wrap">
                        <figure class="feature-image">
                            <a href="{{ route('cart', $package->slug) }}">
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
                                    <a href="{{ route('cart', $package->id) }}">{{ $package->name }}</a>
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
                                    <a href="{{ route('cart', $package->id) }}" class="button-text width-6">Beli Paket<i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
             </div>
             <!-- pagination html start-->
             <div class="post-navigation-wrap">
                <nav>
                  <ul class="pagination">
                    @if ($packages->lastPage() >  1)
                        @if ($packages->currentPage() != 1)
                        <li>
                            <a href="{{ $packages->url(1) }}">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </li>
                        @endif
                        @for ($i = 1; $i <= $packages->lastPage(); $i++)
                        <li class="{{ $packages->currentPage() == $i ? 'active' : '' }}"><a href="{{ $packages->url($i) }}">{{ $i }}</a></li>
                        @endfor
                        @if ($packages->currentPage() != $packages->lastPage())
                        <li>
                            <a href="{{ $packages->url($packages->currentPage()+1) }}">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </li>
                        @endif
                    @endif
                  </ul>
                </nav>
             </div>
             <!-- pagination html start-->
          </div>
       </div>
    </div>
    <!-- packages html end -->
</main>
@endsection