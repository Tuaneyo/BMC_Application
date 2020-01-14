<header>
    <!-- Navbar -->
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
    <!-- Navbar -->

    <!-- half full image -->
    <div class="pager">
        <div class="view"
             style="background-image: url({{ asset('img/tegels/mountain2.jpg') }});
                 background-repeat: no-repeat; background-size: cover;background-position: 100% bottom;">

            <!-- Mask & flexbox options-->
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

                <!-- Content -->
                <div class="d-flex flex-column wow fadeIn w-100 h-100 align-items-center justify-content-between position-relative">
                    <div class="d-flex white-text text-center w-100 h-100 flex-center">
                        <h2 class="header-text main-text">
                            <strong>Just do it, {{ Auth::user()->name  }} {{ Auth::user()->lastname }}</strong>
                        </h2>
                    </div>

                    <nav class="onpage-nav">
                        <div class="colors-divider linear-background"></div>
                        <ul>
                            <li><a href="/" class="active">Home</a></li>
                            @hasrole('administrator|docent')
                            <li><a href="{{ route('admin.index') }}">Admin</a></li>
                            @endhasrole
                            <li><a href="{{ route('components') }}">BMC</a></li>
                            <li><a href="{{ route('voortgang') }}">Personen</a></li>
                            <li><a href="{{ route('profile', Auth::user()->id) }}">Account</a></li>
                        </ul>
                    </nav>
                </div>
                <!-- Content -->

            </div>
            <!-- Mask & flexbox options-->

        </div>
    </div>
    <!-- half full image -->
</header>
