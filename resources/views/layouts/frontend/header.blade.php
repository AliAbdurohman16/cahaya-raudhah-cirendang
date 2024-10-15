<header id="masthead" class="site-header header-primary">
    <!-- header html start -->
    <div class="top-header">
       <div class="container">
          <div class="row">
             <div class="col-lg-8 d-none d-lg-block">
                <div class="header-contact-info">
                   <ul>
                      <li>
                         <a href="#"><i class="fas fa-phone-alt"></i> 082295365199</a>
                      </li>
                      <li>
                         <i class="fas fa-map-marker-alt"></i> Jl. Moh. Toha, Kasturi, Kec. Kramatmulya, Kabupaten Kuningan, Jawa Barat 45521
                      </li>
                   </ul>
                </div>
             </div>
             <div class="col-lg-4 d-flex justify-content-lg-end justify-content-between">
                <div class="header-social social-links">
                   <ul>
                      <li><a href="https://www.facebook.com/cahayaraudhah.id" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                      <li><a href="https://www.youtube.com/@CahayaRaudhahTVofficial" target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                      <li><a href="https://www.instagram.com/cahayaraudhahkuningan_crd/" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                      <li><a href="https://api.whatsapp.com/send/?phone=6282295365199&text=Assalamualaikum+Wr.+Wb.Saya+mendapatkan+informasi+dari+travelcahayaraudhah.com.+Saya+ingin+konsultasi+mengenai+layanan+yang+ada+%3F&type=phone_number&app_absent=0" target="_blank"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                   </ul>
                </div>
                <div class="header-search-icon">
                   <button class="search-icon">
                      <i class="fas fa-search"></i>
                   </button>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="bottom-header">
       <div class="container d-flex justify-content-between align-items-center">
          <div class="site-identity">
             <h1 class="site-title">
                <a href="{{ route('/') }}">
                   <img class="white-logo" src="{{ asset('frontend') }}/assets/images/logo.png" alt="logo">
                   <img class="black-logo" src="{{ asset('frontend') }}/assets/images/logo1.png" alt="logo">
                </a>
             </h1>
          </div>
          <div class="main-navigation d-none d-lg-block">
               <nav id="navigation" class="navigation">
                  <ul>
                     <li class="">
                        <a href="{{ route('/') }}">Beranda</a>
                     </li>
                     <li class="">
                        <a href="{{ route('/') }}#profil">Profil</a>
                     </li>
                     <li class="">
                        <a href="{{ route('/') }}#service">Layanan</a>
                     </li>
                     <li class="">
                        <a href="{{ route('/') }}#legality">Legalitas</a>
                     </li>
                     <li class="">
                        <a href="{{ route('package') }}">Paket</a>
                     </li>
                  </ul>
               </nav>
          </div>
            <div class="header-btn">
               @if (Auth::user())
               <a href="{{ route('dashboard') }}" class="button-primary">Dashboard</a>
               @else
               <a href="{{ route('login') }}" class="button-primary">Masuk</a>
               @endif
            </div>
       </div>
    </div>
    <div class="mobile-menu-container"></div>
</header>