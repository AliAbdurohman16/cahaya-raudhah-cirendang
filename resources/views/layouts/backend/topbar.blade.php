<div class="dashboard-header sticky-header">
    <div class="content-left  logo-section pull-left">
        <h1><a href=""><img src="{{ asset('backend') }}/assets/images/logo.png" width="180px" alt="logo"></a></h1>
    </div>
    <div class="heaer-content-right pull-right">
        <div class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <div class="dropdown-item profile-sec">
                    <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" alt="avatar">
                    <span>{{ Auth::user()->name }} </span>
                    <i class="fas fa-caret-down"></i>
                </div>
            </a>
            <div class="dropdown-menu account-menu">
                <ul>
                    {{-- <li><a href="#"><i class="fas fa-cog"></i>Pengaturan</a></li> --}}
                    <li><a href="{{ route('profile.index') }}"><i class="fas fa-user-tie"></i>Profil</a></li>
                    <li><a href="{{ route('password-change.index') }}"><i class="fas fa-key"></i>Kata Sandi</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Keluar</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>