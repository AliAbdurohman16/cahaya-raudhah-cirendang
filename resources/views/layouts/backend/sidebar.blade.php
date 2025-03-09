<div class="dashboard-navigation">
    <!-- Responsive Navigation Trigger -->
    <div id="dashboard-Navigation" class="slick-nav"></div>
    <div id="navigation" class="navigation-container">
        <ul>
            <li class="{{ request()->is('dashboard') ? 'active-menu' : '' }}"><a href="{{ route('dashboard') }}"><i class="far fa-chart-bar"></i> Dashboard</a></li>
            @if (Auth::user()->hasRole('user'))
            <li><a href="{{ route('package') }}"><i class="fas fa-kaaba"></i>Paket</a></li>
            @endif
            @if (Auth::user()->hasRole('owner'))
            <li><a href="{{ route('log-activities') }}"><i class="fas fa-clock"></i>Log Aktivitas</a></li>
            @endif
            @if (Auth::user()->hasRole('owner') || Auth::user()->hasRole('admin'))
            <li class="{{ request()->is('packages*') ? 'active-menu' : '' }}"><a href="{{ route('packages.index') }}"><i class="fas fa-kaaba"></i>Paket</a></li>
            <li class="{{ request()->is('congregations') ? 'active-menu' : '' }}"><a href="{{ route('congregations') }}"><i class="fas fa-users"></i> Data Jemaah</a></li> 
            <li class="{{ request()->is('transactions') ? 'active-menu' : '' }}"><a href="{{ route('transactions') }}"><i class="fas fa-money-bill-alt"></i>Transaksi</a></li>
            <li class="{{ request()->is('report') ? 'active-menu' : '' }}"><a href="{{ route('report.index') }}"><i class="fas fa-file-alt"></i>Laporan</a></li>
            @endif
            @if (Auth::user()->hasRole('admin'))
            <li class="{{ request()->is('users*') ? 'active-menu' : '' }}"><a href="{{ route('users.index') }}"><i class="fas fa-user"></i>Data Pengguna</a></li>
            @endif
            @if (Auth::user()->hasRole('owner'))
            <li class="{{ request()->is('employees*') ? 'active-menu' : '' }}"><a href="{{ route('employees.index') }}"><i class="fas fa-user-tie"></i>Data Pegawai</a></li>
            @endif
            <li class="{{ request()->is('biodata*') ? 'active-menu' : '' }} || {{ request()->is('profile*') ? 'active-menu' : '' }} || {{ request()->is('ratings.classes*') ? 'active-menu' : '' }}">
                <a><i class="fas fa-user-cog"></i>{{ Auth::user()->hasRole('user') ? 'Biodata Dan Akun' : 'Akun' }}</a>
                <ul>
                    @if (Auth::user()->hasRole('user'))
                    <li>
                        <a href="{{ route('biodata.index') }}">Biodata</a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('profile.index') }}">Profil</a>
                    </li>
                    <li>
                        <a href="{{ route('password-change.index') }}">Kata Sandi</a>
                    </li>
                </ul>
            </li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
</div>