@extends("layouts.account.main")
@section("content")
    @include('layouts.account.nav')
    <main class="pt-3 ">
        <div class="container">
            <!-- User tab -->
            <div class="tab-wrap px-lg-3 px-md-2 px-auto">
                <ul class="nav nav-tabs box-shadow profile-tab" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link arrow_box " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                           aria-selected="true">Over {{ $user->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                           aria-selected="false">Voortgang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="people-tab" data-toggle="tab" href="#people" role="tab" aria-controls="people"
                           aria-selected="false">Ranking
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User tab -->
            <!-- User tab content -->
            <div class="tab-content px-lg-3 px-md-2 px-auto mb-5" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mt-3">
                        <div class="col-md-7 my-lg-2 my-md-2 my-4">
                            <div class="profile-header-wrap">
                                <div class="icon-wrap">
                                    <span class="icon"><i class="fas fa-user-tie"></i></span>
                                </div>
                                <div class="header">
                                    <span>Over mij</span>
                                </div>
                            </div>

                            <div class="about-me-wrap">
                                <h5 class="text-center w-100">
                                    @if(empty($user->cabout))
                                        {{ ucfirst($user->name) }} {{ ucfirst($user->lastname)  }} heeft nog geen informatie ingevuld over zichzelf.
                                    @else
                                        {{ $user->cabout }}
                                    @endif
                                </h5>
                            </div>

                        </div>
                        <div class="col-md-5 my-lg-2 my-md-2 mt-4 mb-5">
                            <div class="profile-header-wrap">
                                <div class="icon-wrap">
                                    <span class="icon"><i class="fas fa-id-card"></i></span>
                                </div>
                                <div class="header">
                                    <span>Contact gegevens</span>
                                </div>
                            </div>
                            <div class="user-info-wrap pt-5 d-flex w-100 h-100">

                                <div class="d-flex user-info px-3  flex-column w-100">
                                    <div class="login-header ">
                                        <span class="login-icon "><i class="fas fa-id-badge"></i></span>
                                    </div>
                                    <table class="table table-borderless user-table m-0">
                                        <tbody>
                                        <tr>
                                            <th >Email</th>
                                            <td id="user-email">{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th >Nummer</th>
                                            <td id="number">{{ $user->st_number }}</td>
                                        </tr>
                                        <tr>
                                            <th>Telefoon</th>
                                            <td id="tel">{{ (empty($user->phone))? 'n.v.t' : $user->phone}}</td>
                                        </tr>
                                        <tr>
                                            <th>bedrijfsnaam</th>
                                            <td id="company">{{ (empty($user->company))? 'n.v.t' : $user->company}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    @if($user->id === Auth::user()->id)
                                        <div class="text-center text-white mt-3">
                                            <a href="{{ route('profile.edit', Auth::user()->id) }}" id="userid" class="btn btn-sm m-0 bg-color-blue">profiel bewerken</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="profile-header-wrap">
                                <div class="icon-wrap">
                                    <span class="icon"><i class="fas fa-users"></i></span>
                                </div>
                                <div class="header">
                                    <span>Voortgang van {{ $user->name }} </span>
                                </div>
                            </div>
                            <div class="my-5">

                                @include('layouts.partials.progress', ['assignments' => $assignments])
                            </div>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- Content -->
                    <div class="d-flex w-100 h-100 align-items-center my-3">
                        <div class="d-flex white-text text-center w-100 h-100 flex-center">
                            <div class="d-flex">
                                <h2 class="header-text text-black-50" style="text-shadow: unset;">
                                    <strong>Onderdelen afgerond</strong>
                                </h2>
                            </div>

                        </div>
                    </div>
                    <!-- Content -->

                    @include('layouts.partials.progress', ['assignments' => $assignments])

                    @include('layouts.partials.small-canvas',['acomponent' => $acomponent, 'user' => $user])

                </div>
                <div class="tab-pane fade show active " id="people" role="tabpanel" aria-labelledby="people-tab" >
                    <div class="profile-header-wrap my-4">
                        <div class="icon-wrap">
                            <span class="icon"><i class="fas fa-suitcase"></i></span>
                        </div>
                        <div class="header">
                            <span>Top ondernemers</span>
                        </div>
                    </div>
                    @if(!empty($list))
                        <div class="row">
                            @foreach($list as $key => $l)
                                @if($l['user']->hasRole('student'))
                                    <div class="col-md-7 pr-lg-0 pr-md-0 pr-auto my-2">
                                        <div class="news-card h-100">
                                            <div class="full-flex flex-column uploader bg-white ">
                                                <div class="uploader-content flex-column p-0">
                                                    <div class="news-header-wrap">
                                                        <div class="d-flex news-thumb">
                                                            <img
                                                                @if(file_exists(public_path('uploads/avatar/'. $l['user']->id . '/' . $l['user']->file)) && !empty($l['user']->file))
                                                                src="{{ asset('uploads/avatar/'.$l['user']->id . '/' . $l['user']->file)  }}"
                                                                @else
                                                                src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                                                @endif
                                                                alt="" class="img-thumbnail">
                                                        </div>
                                                        <div class="news-header">
                                                            <span class="news-name">{{ $l['user']->name }} {{ $l['user']->lastname }}</span>
                                                            <small class="grey-text">{{ $l['user']->email }}</small>
                                                        </div>

                                                    </div>

                                                    <div class="news-content">
                                                        <div class="news-content-header d-flex mt-3" >
                                                            <h5><span class="grey-text">Voortgang:</span> <span class="font-weight-bold">8 van 9 afgerond</span></h5>
                                                        </div>
                                                        <div class="d-flex flex-column meter-back my-4">
                                                            <div class="meter meter-square nostripes position-relative">
                                                                <div id="percentage" class="text-right text-white text-shadow-slight meter-finish"
                                                                     style="width: {{  (($l['user']->assignmentPercentile($l['user']->id) == 0)? 0 : $l['user']->assignmentPercentile($l['user']->id))}}%;">
                                                                </div>
                                                                <div class="finish-block" style="left: {{  ((($l['user']->assignmentPercentile($l['user']->id) == 0)? 0 : $l['user']->assignmentPercentile($l['user']->id)) - 0.8)}}%;">
                                                                    <span><i class="fas fa-flag-checkered"></i></span>
                                                                </div>
                                                                <div class="goal-block">
                                                                    <span><i class="fas fa-flag-checkered"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between border-top align-items-center h-100 p-3">
                                                    <small class="grey-text"><i class="fas fa-user-tie mr-1"></i> Plaats nummer 1</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 pl-lg-0 pl-md-0 pl-auto my-2">
                                        <div id="wrap-info" class="user-info-wrap  pl-lg-3 pl-md-3 pl-auto">
                                            <div class="d-flex user-info p-3 flex-column uploader">
                                                <div class="d-flex w-100 justify-content-center">
                                                    <span class="block-user-icon d-flex aj-center mr-0 " style="height: 60px; background: green;">NA</span>
                                                </div>
                                                <table class="table table-borderless user-table mt-4">
                                                    <tbody>
                                                    <tr>
                                                        <th ><i class="fas fa-id-card mr-2 "></i> Nummer</th>
                                                        <td id="st_number">{{ $l['user']->st_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span><i class="fas fa-phone mr-2"></i></span> Telefoon</th>
                                                        <td id="tel">{{ (empty($l['user']->phone))? 'n.v.t' : $l['user']->phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span><i class="fas fa-building mr-2"></i></span> bedrijfsnaam</th>
                                                        <td id="company_name">{{ (empty($l['user']->company))? 'n.v.t' : $l['user']->company}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <div class="text-center mt-4">
                                                    <a href="{{ route('profile', $l['user']->id) }}" class="btn news-btn btn-sm btn-passed bg-color-blue btn-hover" >
                                                        Profiel bekijken
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                    @else
                        <div class="d-flex full-flex text-center justify-content-center my-5 msg-top flex-column">
                            <span class="ft-18 my-4">Er zijn nog geen statistieken beschikbaar, omdat niemand nog een beoordeling heeft gekeregen.</span>
                            <span class="ft-16 my-4 grey-text">Toch nog benieuwd naar andere ondernemers? klik op de knop hieronder</span>
                            <div class="text-center text-white my-4">
                                <a href="{{ route('voortgang') }}"  class="btn btn-sm m-0 bg-color-blue">naar ondernemers</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- User tab content-->
        </div>

    </main>
@endsection
