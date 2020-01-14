<!-- Hamburger Navbar-->
<div class="container-fluid p-0">
    <nav id="hammenu" class="navbar  scrolling-navbar p-0 bg-transparent no-box-shadow" style="position:absolute;width: 0;z-index:1000;">
        <button class="navbar-toggler pt-2 ft-30" id="navbar-ham" type="button" data-target="#centerModalHamburger" data-toggle="modal"><span class="dark-blue-text"><i class="fa fa-bars fa-1x nav-fa-bars"></i></span></button>
    </nav>
    <!-- modal-->
    <div class="modal animated fadeInLeft fast"  id="centerModalHamburger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left:unset;">
        <div class="modal-dialog modal-notify fixed-modal m-0 h-100" role="document">
            <!-- Content-->
            <div class="modal-content h-100">
                <!-- Header-->
                <div class="modal-header m-header d-flex justify-content-between p-2 align-items-center bg-color-purple-blue" style="height: 60px;">
                    <button class="close nav-close ft-30" type="button" data-dismiss="modal" aria-label="Close"><span class="white-text" aria-hidden="true">×</span></button>
                </div>
                <!-- Body-->
                <div class="modal-body p-0 position-relative">
                    <!-- Links-->
                    <ul class="navbar-nav mr-auto flex-md-row justify-content-around o-nav flex-wrap">
                        <li class="nav-item o-nav-item w-100">
                            <a class="nav-link h-100 w-100 ham-link d-flex" href="{{ route('welcome') }}">
                                <span class="nav-icon"> <i class="fas fa-home nav-icons"></i></span>
                                <span class="oNav-text">home</span>
                            </a>
                        </li>
                        @hasrole('administrator|docent')
                        <li class="nav-item dropdown o-nav-item w-100 position-relative">
{{--                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"--}}
{{--                               aria-expanded="false">Dropdown</a>--}}
                            <a class="nav-link h-100 w-100 ham-link d-flex" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                               aria-expanded="false">
                                <span class="nav-icon"><i class="fas fa-user-cog"></i></span>
                                <span class="oNav-text">Admin <i class="fas fa-caret-down"></i></span>
                            </a>
                            <div id="ham-dropdown" class="dropdown-menu" style="transform: translate3d(0px, 47px, 0px) !important;">
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    <span class="nav-icon"><i class="fas fa-tachometer-alt"></i></span>
                                    <span class="oNav-text">Dashboard</span>
                                </a>
                                <a class="dropdown-item active" href="{{ route('admin.assignments.teacher') }}">
                                    <span class="nav-icon"><i class="far fa-star"></i></span>
                                    <span class="oNav-text">Beoordelen</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.assignments.rated') }}">
                                    <span class="nav-icon"><i class="fas fa-star"></i></span>
                                    <span class="oNav-text">Beoordeeld</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                    <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                                    <span class="oNav-text">gebruikers</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.users.mentors') }}">
                                    <span class="nav-icon"><i class="fab fa-elementor"></i></span>
                                    <span class="oNav-text">mentors</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.users.students') }}">
                                    <span class="nav-icon"><i class="fas fa-user-graduate"></i></span>
                                    <span class="oNav-text">studenten</span>
                                </a>
                            </div>
                        </li>
                        @endhasrole
                        <li class="nav-item o-nav-item w-100">
                            <a class="nav-link h-100 w-100 ham-link d-flex" href="{{ route('components') }}">
                                <span class="nav-icon"><i class="fas fa-suitcase"></i></span>
                                <span class="oNav-text">BMC</span>
                            </a>
                        </li>
                        <li class="nav-item o-nav-item w-100">
                            <a class="nav-link h-100 w-100 ham-link d-flex" href="{{route('voortgang')}}">
                                <span class="nav-icon"><i class="fas fa-users"></i></span>
                                <span class="oNav-text">Personen</span>
                            </a>
                        </li>
                        <li class="nav-item o-nav-item w-100">
                            <a class="nav-link h-100 w-100 ham-link d-flex" href="{{ route('profile', Auth::user()->id) }}">
                                <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                                <span class="oNav-text">Account</span>
                            </a>
                        </li>
                        <li class="nav-item o-nav-item w-100 nav-item-bottom">
                            <a class="nav-link h-100 w-100 ham-link d-flex nav-link-bottom" href="{{ route('logoff') }}">
                                <span class="nav-icon"><i class="fas fa-power-off"></i></span>
                                <span class="oNav-text">Afmelden</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Footer-->
                <div class="modal-footer justify-content-center bg-color-purple-blue p-2">
                    <p class="m-0 text-white test"><small>&copy; Copyright 2019: ADSD team 7</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
