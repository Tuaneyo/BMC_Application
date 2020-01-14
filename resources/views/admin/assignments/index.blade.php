@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => 'Dashboard', 'thumb' => 'dashboard.jpg'])
    <main class="pt-3 ">
        <div class="container">
            <div class="row">
                <!-- Frist dash info -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="dash-info-wrap my-30">
                        <a href="{{ route('admin.users.students') }}" class="full-flex bg-white animated fadeInLeft fast list-hover">
                            <div class="dash-icon file-icon" style="background: #a56ab7;">
                                <span><i class="fas fa-user-tie"></i></span>
                            </div>
                            <div class="dash-info handin-date align-items-center text-center">
                                <span class="int text-grey ft-30 font-weight-bold">{{ $students }}</span>
                                <span class="dash-text text-grey">Ondernemers</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Second dash info -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="dash-info-wrap my-30">
                        <a href="{{ route('admin.users.mentors') }}" class="full-flex bg-white animated delay-25ms fadeInLeft fast list-hover">
                            <div class="dash-icon file-icon" style="background: #8c69c0;">
                                <span><i class="fas fa-chalkboard-teacher"></i></span>
                            </div>
                            <div class="dash-info handin-date align-items-center text-center">
                                <span class="int text-grey ft-30 font-weight-bold">{{ ($teachers) }}</span>
                                <span class="dash-text text-grey">Mentoren</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Third dash info -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="dash-info-wrap my-30">
                        <a href="{{ route('admin.assignments.teacher') }}" class="full-flex bg-white animated delay-25ms fadeInRight fast list-hover">
                            <div class="dash-icon file-icon" style="background: #6a69ce;">
                                <span><i class="far fa-file-alt"></i></span>
                            </div>
                            <div class="dash-info handin-date align-items-center text-center">
                                <span class="int text-grey ft-30 font-weight-bold">{{ $assignments->count() }}</span>
                                <span class="dash-text text-grey">Ingeleverd</span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Fourth dash info -->
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="dash-info-wrap my-30">
                        <a href="{{ route('admin.assignments.rated') }}" class="full-flex bg-white animated fadeInRight fast list-hover">
                            <div class="dash-icon file-icon" style="background: #4f68d8;">
                                <span><i class="fas fa-star"></i></span>
                            </div>
                            <div class="dash-info handin-date align-items-center text-center">
                                <span class="int text-grey ft-30 font-weight-bold">{{ $rated->count() }}</span>
                                <span class="dash-text text-grey">Beoordeeld</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div>

            <div class="row mt-1">
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                    <div class="profile-header-wrap">
                        <div class="icon-wrap">
                            <span class="icon"><i class="fas fa-suitcase"></i></span>
                        </div>
                        <div class="header">
                            <span>Eerst ingediende documenten</span>
                        </div>
                    </div>

                    <div class="dash-info-wrap my-30">
                        @for($i=0;$i<3;$i++)
                            @if(isset($uploaded[$i]))
                                <a href="{{ route('admin.assignments.rating', $uploaded[$i]->id) }}" class="full-flex bg-white align-items-center list-hover my-2 ">
                                    <div class="in-icon file-icon home-color-blue">
                                        <span><i class="far fa-file-alt"></i></span>
                                    </div>
                                    <div class="dash-info handin-date">
                                        <span class="text-grey ft-18 font-weight-bold">{{ $uploaded[$i]->component->name }}</span>
                                        <span class="text-grey ft-15 ">Door: {{ $uploaded[$i]->user->name . ' ' . $uploaded[$i]->user->lastname }}</span>
                                    </div>
                                    <div class="dash-arrow d-flex">
                                        <small class=""><i class="fas fa-chevron-right"></i></small>
                                    </div>
                                </a>
                            @else
                                <div class="full-flex bg-white align-items-center list-hover my-2">
                                    <div class="in-icon file-icon grey-text">
                                        <span><i class="far fa-file-alt"></i></span>
                                    </div>
                                    <div class="dash-info handin-date">
                                        <span class="grey-text ft-14">Nog geen document ingeleverd</span>
                                    </div>
                                </div>
                            @endif
                        @endfor
                        <div class="dash-btn-wrap w-100 text-right my-4">
                            <a href="{{route('admin.assignments.teacher')}}"
                               class="btn btn-sm dash-btn no-box-shadow">
                                Alle ingeleverd
                                <small><i class="fas fa-chevron-right"></i></small>

                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                    <div class="profile-header-wrap">
                        <div class="icon-wrap">
                            <span class="icon"><i class="fab fa-black-tie"></i></span>
                        </div>
                        <div class="header">
                            <span>Top ondernemers</span>
                        </div>
                    </div>

                    <div class="dash-info-wrap my-30">
                        @for($i=0;$i<3;$i++)
                            @if(isset($topUser[$i]))
                                <a href="{{ route('profile.edit', $topUser[$i]['user']->id) }}" class="full-flex bg-white align-items-center list-hover my-2">
                                    <div class="in-icon file-icon home-color-blue">
                                        <span><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <div class="dash-info handin-date">
                                        <span class="text-grey ft-18 font-weight-bold">{{ $topUser[$i]['user']->name . ' ' . $topUser[$i]['user']->lastname }}</span>
                                        <span class="text-grey ft-15 ">{{ $topUser[$i]['user']->email }}</span>
                                    </div>
                                    <div class="dash-arrow d-flex">
                                        <small><i class="fas fa-chevron-right"></i></small>
                                    </div>
                                </a>
                            @else
                                <div class="full-flex bg-white align-items-center list-hover my-2">
                                    <div class="in-icon file-icon grey-text">
                                        <span><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <div class="dash-info handin-date">
                                        <span class="grey-text ft-14">Niemand heeft nog deze plek geclaimd</span>
                                    </div>
                                </div>
                            @endif
                        @endfor
                        <div class="dash-btn-wrap w-100 text-right my-4">
                            <a href="{{route('voortgang')}}"
                               class="btn btn-sm dash-btn no-box-shadow">
                                Alle ondernemers
                                <small><i class="fas fa-chevron-right"></i></small>

                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-md-12 ">
                    <div class="profile-header-wrap mb-4">
                        <div class="icon-wrap">
                            <span class="icon"><i class="fab fa-black-tie"></i></span>
                        </div>
                        <div class="header">
                            <span>Laatst beoordeelde documenten</span>
                        </div>
                    </div>
                    @if(count($showRated))
                        @foreach($showRated as $key => $rated )
                            <div class="all-handin-wrap my-3 list-hover">
                                <a href="{{route('admin.assignments.rating', $rated->id)}}" class="handin-list d-flex flex-column">
                                    <div class="handin-item d-flex full-flex aj-center flex-lg-row flex-md-row flex-column">
                                        <div class="list-icons d-flex">
                                            <span class="list-icon1"><i class="fas fa-star"></i></span>
                                            <span class="list-icon2 mr-lg-3 mr-md-3 mr-0">
                                                <i class="fas fa-glass-cheers"></i>
                                            </span>
                                        </div>
                                        <div class="handin-list-content flex-column full-flex ml-4">
                                            <div class="handin-list-name">
                                                <h5 >{{ $rated->Component->name }}</h5>
                                            </div>
                                            <div class="handin-list-file">
                                                <h6 class="m-0">{{(empty($rated->file2) ? $rated->file1 : $rated->file2)}}</h6>
                                            </div>
                                            <div class="mt-3">
                                                <small class="border-top-light py-1 {{ (($rated->rated == 1)? 'house-color-red' : (($rated->rated == 2) ? 'house-color-green' : 'grey-text' )) }}">
                                                    @if($rated->rated == 1)
                                                        Met onvoldoende beoordeeld
                                                    @elseif($rated->rated == 2)
                                                        Met voldoende beoordeeld
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                        <div class="dash-arrow d-flex">
                                            <small class=""><i class="fas fa-chevron-right"></i></small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                            <div class="dash-btn-wrap w-100 text-right my-4">
                                <a href="{{route('admin.assignments.rated')}}"
                                   class="btn btn-sm dash-btn no-box-shadow">
                                    Alle beoordeelde
                                    <small><i class="fas fa-chevron-right"></i></small>

                                </a>
                            </div>
                        @else
                            <div class="news-content my-2 bg-white">
                                <div class="d-flex p-3 grey-text flex-column aj-center text-center">
                                    <span class="ft-30"><i class="fas fa-suitcase"></i></span>
                                    <span>Op dit moment zijn er nog geen beoordeelde documenten</span>
                                </div>
                            </div>
                        @endif

                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </main>


@endsection
