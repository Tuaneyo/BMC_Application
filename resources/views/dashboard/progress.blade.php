@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Netwerken', 'thumb' => 'Competion.png'])
    <main class="pt-3 ">
        <div class="container p-0 mb-5">
            <!-- All users section -->
            <div class="row mx-0 mt-3">
                <div class="col-md-12 mb-3">
                    <div class="profile-header-wrap mb-4 mt-lg-5 mt-md-4 mt-3">
                        <div class="icon-wrap">
                            <span class="icon"><i class="fas fa-chalkboard-teacher"></i></span>
                        </div>
                        <div class="header">
                            <span>Mentoren</span>
                        </div>
                    </div>
                </div>
                @foreach($mentors as $user)
                    <div class="col-lg-3 col-md-4 col-6 my-lg-3 my-md-3 my-0 px-lg-3 plx-md-2 px-0">
                        <div class="user-card-wrap">
                            <div class="user-card-header"></div>
                            <div class="user-card-profile">
                                <div class="profiler-img">
                                    <img
                                        @if(file_exists(public_path('uploads/avatar/'. $user->id . '/' . $user->file)) && !empty($user->file))
                                        src="{{ asset('uploads/avatar/'.$user->id . '/' . $user->file)  }}"
                                        @else
                                        src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                        @endif
                                        alt="" class="img-thumbnail box-shadow-light" />
                                </div>
                                <div class="profiler-name">
                                    {{ $user->name }} {{ $user->lastname }}
                                </div>
                                <div class="profiler-company grey-text">
                                    @if(!empty( $user->company))
                                        <span class="ft-12 ft-10-sm"><i class="fas fa-building"></i>  </span>
                                        <span class="ft-12 ft-10-sm">{{ $user->company }}</span>
                                    @else
                                        <span class="ft-12 ft-10-sm"><i class="fas fa-envelope"></i> </span>
                                        <span class="ft-12 ft-10-sm">{{ $user->email }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="user-card-footer">
                                <div class="text-center mt-4">
                                    <a href="{{ route('profile', $user->id) }}" class="btn-back m-0 ft-10-sm" >
                                        Profiel bekijken
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mx-0">
                <div class="col-md-12 mb-3">
                <div class="profile-header-wrap mb-4 mt-5">
                    <div class="icon-wrap">
                        <span class="icon"><i class="fas fa-user-tie"></i></span>
                    </div>
                    <div class="header">
                        <span>Ondekt andere ondernemers</span>
                    </div>
                </div>
                </div>
                <!-- All users -->
                @foreach($users as $user)
                    <div class="col-lg-3 col-md-4 col-6 my-lg-3 my-md-3 my-0 px-lg-3 plx-md-2 px-0">
                        <div class="user-card-wrap">
                            <div class="user-card-header"></div>
                            <div class="user-card-profile">
                                <div class="profiler-img">
                                    <img
                                        @if(file_exists(public_path('uploads/avatar/'. $user->id . '/' . $user->file)) && !empty($user->file))
                                        src="{{ asset('uploads/avatar/'.$user->id . '/' . $user->file)  }}"
                                        @else
                                        src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                        @endif
                                        alt="" class="img-thumbnail box-shadow-light" />
                                </div>
                                <div class="profiler-name">
                                    {{ $user->name }} {{ $user->lastname }}
                                </div>
                                <div class="profiler-company grey-text">
                                    @if(!empty( $user->company))
                                        <span class="ft-12"><i class="fas fa-building"></i> </span>
                                        <span class="ft-12">{{ $user->company }} </span>
                                    @else
                                        <span class="ft-12 ft-10-sm"><i class="fas fa-envelope"></i> </span>
                                        <span class="ft-12 ft-10-sm">{{ $user->email }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="user-card-footer">
                                <div class="d-flex flex-column meter-back my-4">
                                    <div class="meter meter-round nostripes position-relative white">
                                        <div id="percentage" class="text-right text-white text-shadow-slight meter-finish"
                                             style="width:{{  (($user->assignmentPercentile($user->id) == 0)? 0 : $user->assignmentPercentile($user->id))}}%;">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="{{ route('profile', $user->id) }}" class="btn-back m-0 ft-10-sm" >
                                        Profiel bekijken
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            <!-- All users -->
            </div>
            <!-- All users section -->
        </div>
    </main>
@endsection
