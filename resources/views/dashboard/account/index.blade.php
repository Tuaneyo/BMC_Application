@extends("layouts.account.main")
@section("content")
    @include('layouts.account.nav')
    <main class="pt-3 ">
        <div class="container">
            <!-- User tab -->
            <div class="tab-wrap px-lg-3 px-md-2 px-auto">
                <ul class="nav nav-tabs box-shadow profile-tab" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link arrow_box active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                           aria-selected="true">{{ $user->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                           aria-selected="false">Voortgang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="people-tab" data-toggle="tab" href="#people" role="tab" aria-controls="people"
                           aria-selected="false">Ranking
                        </a>
                    </li>
                </ul>
            </div>

            <!-- User tab -->
            <!-- User tab content -->
            <div class="tab-content px-lg-3 px-md-2 px-auto mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mt-3">
                        <div class="col-md-5 pr-lg-0 pr-md-0 pr-auto">
                            <div class="sticky">
                                <div class="uploader-content flex-column p-0 mb-2 white">
                                    <div class="profile-wrap">
                                        <div class="d-flex bio-content p-4 grey-text flex-column aj-center text-center">
                                            <span class="ft-30"><i class="fas fa-comment"></i></span>
                                            @if(empty($user->cabout))
                                                @if(Auth::user()->id === $user->id)
                                                    <span class="my-2">
                                                    Voeg een korte verhaal toe en laat mensen meer weten over jezelf of bedrijf.
                                                </span>
                                                @else
                                                    <span>
                                                    {{ ucfirst($user->name) }} {{ ucfirst($user->lastname)  }} heeft nog geen informatie ingevuld over zichzelf.
                                                </span>
                                                @endif
                                            @else
                                                {{ $user->cabout }}
                                            @endif

                                        </div>
                                        @if(Auth::user()->id === $user->id)
                                            <div class="edit-profile-wrap p-3 border-top">
                                                <div class="text-center my-2">
                                                    <a href="{{ route('profile.edit', $user->id) }}" class="btn-home-blue  m-0 ft-10-sm" >
                                                        profiel bewerken
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="about-wrap p-4 border-top">
                                            <table class="table table-borderless about-table">
                                                <tbody>
                                                <tr>
                                                    <th ><i class="fas fa-id-card mr-2 "></i> <span class="display-lg">Nummer</span></th>
                                                    <td id="st_number">{{ $user->st_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-phone mr-2"></i></span> <span class="display-lg">Telefoon</span></th>
                                                    <td id="tel">{{ (empty($user->phone))? 'n.v.t' : $user->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <th><span><i class="fas fa-building mr-2"></i></span> <span class="display-lg">bedrijf</span></th>
                                                    <td id="company_name">{{ (empty($user->company))? 'n.v.t' : $user->company}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mail-wrap grey-text border-top text-center p-3">
                                            <span><i class="fas fa-envelope mr-2"></i> {{ $user->email }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if(Auth::user()->id === $user->id)
                                    @if(empty($user->file))
                                        <div class="border mt-3 white">
                                            <div class="uploaded-wrap">
                                                <div class="d-flex p-4 grey-text flex-column aj-center text-center">
                                                    <span class="ft-30 my-3"><i class="far fa-file-image"></i></span>
                                                    <span >Voeg een profiel foto toe en laat mensen weten wie je bent</span>
                                                </div>
                                                <div class="full-flex align-items-center border-top justify-content-center text-center">
                                                    <a href="{{ route('profile.edit', $user->id) }}" class="btn-account ">Foto toevoegen</a>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                    @if($user->hasrole('student'))
                                    @if(count($unrated))
                                        <div class="uploaded-wrap mt-3 white border-top">
                                            <div class="news-content grey-text">
                                                Ingeleverde onderdelen
                                            </div>
                                        </div>
                                        @foreach($unrated as $ur)
                                            <div class="uploaded-wrap mt-3 white border-top">
                                                <!-- Uploader rating status -->
                                                <div class="upload-status full-flex">
                                                    <div class="square-wrap">
                                                        @switch($ur->component_id)
                                                            @case($component[0]->id)
                                                            <span class="square-uploaded bg-partnerts"><i class="fas fa-handshake"></i></span>
                                                            @break
                                                            @case($component[1]->id)
                                                            <span class="square-uploaded bg-kern"><i class="fas fa-briefcase"></i></span>
                                                            @break
                                                            @case($component[2]->id)
                                                            <span class="square-uploaded bg-people"><i class="fas fa-people-carry"></i></span>
                                                            @break
                                                            @case($component[3]->id)
                                                            <span class="square-uploaded bg-value"><i class="fas fa-gift"></i></span>
                                                            @break
                                                            @case($component[4]->id)
                                                            <span class="square-uploaded  bg-relation"><i class="fas fa-heart"></i></span>
                                                            @break
                                                            @case($component[5]->id)
                                                            <span class="square-uploaded bg-network"><i class="fas fa-network-wired"></i></span>
                                                            @break
                                                            @case($component[6]->id)
                                                            <span class="square-uploaded bg-clients"><i class="fas fa-mug-hot"></i></span>
                                                            @break
                                                            @case($component[7]->id)
                                                            <span class="square-uploaded bg-money"><i class="fas fa-table"></i></span>
                                                            @break
                                                            @case($component[8]->id)
                                                            <span class="square-uploaded bg-income"><i class="fas fa-money-bill"></i></span>
                                                            @break
                                                        @endswitch
                                                    </div>
                                                    <div class="d-flex flex-column px-2 justify-content-center w-100">
                                                        <span class="upload-text">{{$ur->component->name}}</span>
                                                        <small class="upload-text-small">
                                                            Nakijkstatus: <span class="orange-text">in behandeling</span>
                                                        </small>
                                                    </div>
                                                </div>
                                                <!-- Uploader rating status -->
                                            </div>
                                        @endforeach

                                    @else
                                        <div class="uploader-content mt-3 white">
                                            <div class="uploaded-wrap">
                                                <div class="d-flex p-1 grey-text flex-column aj-center text-center">
                                                    <span class="ft-30"><i class="fas fa-briefcase"></i></span>
                                                    <span>Op dit moment heb je nog geen ingeleverde documenten</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @endif

                            </div>

                        </div>
                        <div class="col-md-7">
                            <div class="uploader-content flex-column p-0 mb-2 white mt-lg-0 mt-md-0 mt-3">
                                <div class="news-content grey-text">
                                    Beoordelingsoverzicht
                                </div>
                            </div>
                            @if(count($assignments) && $user->hasrole('student'))
                                @foreach($assignments as $n)
                                    <div class="uploader-content flex-column p-0 my-3 white">
                                        <div class="news-card">
                                            <div class="full-flex flex-column uploader bg-white ">
                                                <div class="uploader-content flex-column pt-0 px-0">
                                                    <div class="news-header-wrap">
                                                        <div class="d-flex news-thumb">
                                                            <img
                                                                @if(file_exists(public_path('uploads/avatar/'.$user->id . '/' . $user->file)) && !empty($user->file))
                                                                src="{{ asset('uploads/avatar/'.$user->id . '/' . $user->file)  }}"
                                                                @else
                                                                src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                                                @endif
                                                                alt="" class="img-thumbnail">
                                                        </div>
                                                        <div class="news-header">
                                                            <span class="news-name">{{ $user->name }} {{ $user->lastname }}</span>
                                                            <small class="grey-text">
                                                                Beoordeling: onderdeel {{$n->component->name}}
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="news-content-img border-bottom">
                                                        <div class="d-flex flex-column img-news">
                                                            <a href="{{ route('assigment', $n->component->id) }}">
                                                                <img src="{{ asset('img/tegels/' . $n->component->thumb  ) }}" class="object-fit" alt="1" height="250px" width="100%">
                                                            </a>
                                                            <div class="text my-1 ">
                                                                @if(Auth::user()->id === $n->user->id)
                                                                    Op {{ $n->updated_at->format('d-m-Y ') }} {{ ($user->id === Auth::user()->id ? 'heb je' : $user->name) }} een <span class="{{ ($n->rated == 1) ? 'red-text' : 'green-text' }}">
                                                        {{ ($n->rated == 1) ? 'onvoldoende' : 'voldoende' }}
                                                    </span> gekregen voor het onderdeel <a href="{{ route('assigment',$n->component->id)  }}">
                                                                        <b class="home-color-blue">{{ $n->component->name }}</b></a>
                                                                @else
                                                                    Op {{ $n->updated_at->format('d-m-Y ') }} heeft
                                                                    <a href="{{ route('profile', $n->user->id)  }}"><b>{{ $n->user->name }} {{ $n->user->lastname }}</b> </a>
                                                                    een <span class="{{ ($n->rated == 1) ? 'red-text' : 'green-text' }}">{{ ($n->rated == 1) ? 'onvoldoende' : 'voldoende' }}
                                                    </span> gekregen voor het onderdeel <a href="{{ route('assigment', $n->component->id)  }}">
                                                                        <b class="home-color-blue">{{ $n->component->name }}</b></a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="full-flex align-items-center">
                                                    <small class="grey-text small-text ">
                                                        <i class="far fa-clock ft-9"></i> geplaatst op: {{ $assignments[0]->updated_at->format('d-m-Y ') }} om {{ $assignments[0]->updated_at->format(' H:i') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="uploader-content flex-column p-0 mt-3 white">
                                    <div class="uploaded-wrap">
                                        <div class="d-flex p-4 grey-text flex-column aj-center text-center">
                                            <img src="{{ asset('img/tegels/document.jpg') }}" alt="" class="no-docu-img mb-3 ">
                                            @if($user->hasrole('docent|administrator') )
                                                <span class="ft-18">
                                                    {{ ucfirst($user->name) }} {{ ucfirst($user->lastname) }} is de persoon die de documenten zal beoordelen.
                                                </span>
                                            @endif
                                            @if($user->hasrole('student') )
                                                <span class="ft-18">Nog geen beoordeling gekregen.</span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            @endif

                                <div class="uploader-content flex-column p-0 mt-3 white">
                                    <div class="news-content">
                                        <div class="d-flex flex-column text-center p-3">
                                            <span class="icon"><i class="fas fa-globe-asia"></i></span>
                                            <span class="text">Geregistreerd op {{ date("d m Y ", strtotime($user->created_at)) }}</span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- Content -->
                    @if($user->hasrole('student') )
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-12 pr-lg-2 pr-md-2 pr-auto mt-3">
                            <div class="news-card h-100">
                                <div class="full-flex flex-column uploader bg-white ">
                                    <div class="uploader-content flex-column p-0 h-100">
                                        <div class="news-content full-flex justify-content-around flex-column">
                                            <div class="news-content-header d-flex mt-3" >
                                                <h5><span class="grey-text">Voortgang:</span>
                                                    <span class="font-weight-bold">{{$user->getCountCompletedAssignments($user->id)}} van 9 afgerond</span></h5>
                                            </div>
                                            <div class="d-flex flex-column meter-back my-4">
                                                <div class="meter meter-square nostripes position-relative">
                                                    <div id="percentage" class="text-right text-white text-shadow-slight meter-finish"
                                                         style="width: {{  (($user->assignmentPercentile($user->id) == 0)? 0 : $user->assignmentPercentile($user->id))}}%;">
                                                    </div>
                                                    @if($user->assignmentPercentile($user->id) > 0)
                                                    <div class="finish-block" style="left: {{  ((($user->assignmentPercentile($user->id) == 0)? 0 : $user->assignmentPercentile($user->id)) - 4.2)}}%;">
                                                        <span><i class="fas fa-check"></i></span>
                                                    </div>
                                                    @endif
                                                    <div class="goal-block">
                                                        <span><i class="fas fa-flag-checkered"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-12 pl-lg-2 pl-md-2 pl-auto mt-3">
                            <div class="profile-statics-wrap full-flex  justify-content-between">
                                <div href="{{ route('profile', $user->id) }}" class="d-flex w-50 flex-column justify-content-center profile-graph mr-2 full-flex uploader-content white">
                                    <div class="progress-bar1 profile-bar1" data-percent=" {{$user->assignmentPercentile($user->id)}}" data-duration="1500"
                                         data-color="#eaeaea,#44E15F"></div>
                                </div>
                                <div class="profile-graph ml-2 d-flex w-50 justify-content-center uploader-content white">
                                    <div class="d-flex grey-text flex-column aj-center text-center">
                                        <img src="{{ asset('img/tegels/document.jpg') }}" alt="" class="tfile-img mb-3 ">
                                        <span class="ft-18">{{ count($allAssign) }} bestand{{ (count($allAssign) == 1 ?'': 'en') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    @include('layouts.partials.small-canvas',['acomponent' => $acomponent, 'user' => $user])

                    <div class="row mt-4 mb-5">
                        <div class="col-12">
                            @include('layouts.partials.progress',['assignments' => $assignments])
                        </div>
                    </div>
                    @endif
                    @if($user->hasrole('docent|administrator') )
                        <div class="d-flex full-flex text-center justify-content-center mt-3 msg-top flex-column">
                            <span class="ft-18 my-4">Er zullen geen statistieken van mentoren worden vastgelegd, omdat de mentoren de doucumenten zullen beoordelen.</span>
                            <span class="ft-16 my-4 grey-text">Benieuwd naar andere ondernemers? klik op de knop hieronder.</span>
                            <div class="text-center text-white my-4">
                                <a href="{{ route('voortgang') }}"  class="btn btn-sm m-0 bg-color-blue">profielen bekijken</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="people" role="tabpanel" aria-labelledby="people-tab" >
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
                                                                alt="" class="img-thumbnail" />
                                                        </div>
                                                        <div class="news-header">
                                                            <span class="news-name">{{ $l['user']->name }} {{ $l['user']->lastname }}</span>
                                                            <small class="grey-text">{{ $l['user']->email }}</small>
                                                        </div>

                                                    </div>

                                                    <div class="news-content">
                                                        <div class="news-content-header d-flex mt-3" >
                                                            <h5><span class="grey-text">Voortgang:</span>
                                                                <span class="font-weight-bold">{{$l['user']->getCountCompletedAssignments($l['user']->id)}} van 9 afgerond</span></h5>
                                                        </div>
                                                        <div class="d-flex flex-column meter-back my-4">
                                                            <div class="meter meter-square nostripes position-relative">
                                                                <div id="percentage" class="text-right text-white text-shadow-slight meter-finish"
                                                                     style="width: {{  (($l['user']->assignmentPercentile($l['user']->id) == 0)? 0 : $l['user']->assignmentPercentile($l['user']->id))}}%;">
                                                                </div>
                                                                <div class="finish-block" style="left: {{  ((($l['user']->assignmentPercentile($l['user']->id) == 0)? 0 : $l['user']->assignmentPercentile($l['user']->id)) - 4.2)}}%;">
                                                                    <span><i class="fas fa-check"></i></span>
                                                                </div>
                                                                <div class="goal-block">
                                                                    <span><i class="fas fa-flag-checkered"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 pl-lg-0 pl-md-0 pl-auto my-2">
                                        <div id="wrap-info" class="user-info-wrap  pl-lg-3 pl-md-3 pl-auto">
                                            <div class="d-flex user-info p-3 flex-column uploader-content">
                                                <table class="table table-borderless user-table mt-4">
                                                    <tbody>
                                                    <tr>
                                                        <th ><i class="fas fa-id-card mr-2 "></i> Nummer</th>
                                                        <td id="st_number">{{ $l['user']->st_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><i class="fas fa-phone mr-2"></i></span> Telefoon</th>
                                                        <td id="tel">{{ (empty($l['user']->phone))? 'n.v.t' : $l['user']->phone}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th><span><i class="fas fa-building mr-2"></i></span> bedrijf</th>
                                                        <td id="company_name">{{ (empty($l['user']->company))? 'n.v.t' : $l['user']->company}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-flex justify-content-between user-btn align-items-center h-100 pl-3 white">
                                                <small class="grey-text"><i class="fas fa-user-tie mr-1"></i>{{ $key + 1 }}e plaats</small>
                                                <div class="text-right">
                                                    <a href="{{ route('profile', $l['user']->id) }}" class="btn news-btn btn-passed bg-color-blue btn-hover" >
                                                        Naar profiel
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
