<header>
    <!-- Navbar notification and logout -->
    <nav class="navbar navbar-expand-lg" id="news-nav">
        <div class="collapse nav-collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav mr-auto"></div>
            <div class="form-inline mr-lg-2 mr-md-0 mr-0 mt-1">
                <notification v-bind:notifications="notifications"></notification>

                @if(Auth::check())
                    <a href="{{ route('logoff') }}" class="p-2 off-btn">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                @endif

            </div>
        </div>
    </nav>
    <!-- Navbar notification and logout -->
    <!-- 'img/tegels/inkomstenstromen.jpg' -->
    <div class="dashboard-pager">
        <div class="view"
             style="background-image: url({{ asset("img/tegels/$thumb") }});
                 background-repeat: no-repeat; background-size: cover;background-position: 100% center;">

            <!-- Mask & flexbox options-->
            <div class="mask d-flex justify-content-center align-items-center">

                <!-- Content -->
                <div class="d-flex flex-column wow fadeIn w-100 h-100 align-items-center justify-content-between">
                    <div class="d-flex white-text text-center w-100 h-100 flex-center">
                        <div class="d-flex p-4 rgba-black-light box-shadow">
                            <h2 class="header-text">
                                <strong>{{ $title }}</strong>
                            </h2>
                        </div>

                    </div>
                </div>
                <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

        </div>
    </div>
    <!-- half full image -->

    <!-- Sidebar -->
    <div class="sidebar-fixed position-fixed" style="background-image: url({{ asset('img/dashboard/purple-blue.png') }});
        background-repeat: no-repeat; background-size: 100% 100%;">

        <div class="sidebar-nav d-flex flex-column h-100 justify-content-between">
            <div>
                <a href="{{ route('welcome') }}" class="d-flex aj-center sidebar-begin">
                    <span class="sidebar-icon"><i class="fas fa-graduation-cap"></i></span>
                </a>
                @hasrole('student')
                <a href="{{ route('welcome') }}" class="d-flex aj-center sidebar-wrap flex-column">
                    <span class="sidebar-icon"><i class="fas fa-home"></i></span>
                    <span class="sidebar-link">Home</span>
                </a>
                @endhasrole
                @can('view dashboard')
                <a href="{{ route('admin.index') }}" class="d-flex aj-center sidebar-wrap flex-column ">
                    <span class="sidebar-icon"><i class="fas fa-tachometer-alt"></i></span>
                    <span class="sidebar-link">Dashboard</span>
                </a>
                @endcan
                @can('list assignments')
                <a href="{{ route('admin.assignments.teacher') }}" class="d-flex aj-center sidebar-wrap flex-column active">
                    <span class="sidebar-icon"><i class="far fa-star"></i></span>
                    <span class="sidebar-link">Beoordelen</span>
                </a>
                <a href="{{ route('admin.assignments.rated') }}" class="d-flex aj-center sidebar-wrap flex-column">
                    <span class="sidebar-icon"><i class="fas fa-star"></i></span>
                    <span class="sidebar-link">Beoordeeld</span>
                </a>
                @endcan
                <a href="{{ route('components') }}" class="d-flex aj-center sidebar-wrap flex-column
                    {{ (Auth::user()->hasRole('student') ? 'active' : '') }}">
                    <span class="sidebar-icon"><i class="fas fa-suitcase"></i></span>
                    <span class="sidebar-link">BMC</span>
                </a>
                @hasrole('administrator|docent')
                @can('list users')
                <a href="{{ route('admin.users.index') }}" class="d-flex aj-center sidebar-wrap flex-column">
                <span class="sidebar-icon"><i class="fas fa-users"></i></span>
                    <span class="sidebar-link">Gebruikers</span>
                </a>
                @endcan
                @endhasrole
                @hasrole('student')
                <a href="{{route('voortgang')}}" class="d-flex aj-center sidebar-wrap flex-column">
                    <span class="sidebar-icon"><i class="fas fa-users"></i></span>
                    <span class="sidebar-link">Personen</span>
                </a>
                @endhasrole
            </div>
            <a href="{{ route('profile', Auth::user()->id) }}" class="mb-2 p-0 text-center sidebar-user-wrap">
                <div class="d-flex flex-column w-100 align-items-center ">
                    @include('layouts.partials.user-img', ['user' =>  Auth::user()])
                    <span class="text-center ft-12 sidebar-user-text">{{Auth::user()->name}}</span>
                </div>
            </a>

        </div>

    </div>
    <!-- Sidebar -->

</header>
