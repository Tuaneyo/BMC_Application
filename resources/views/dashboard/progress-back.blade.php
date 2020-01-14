@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Netwerken', 'thumb' => 'Competion.png'])
    <main class="pt-3 ">
        <div class="container p-0">
            <!-- All users section -->
            <div class="row mx-0 mt-4">
                <div class="col-md-12">
                    <div class="d-flex flex-column padding pb-0">
                        <span class="musk-info-header">Alle andere ondernemers</span>
                        <span class="ft-15 grey-text ">Zie hoe ver anderen zijn en leer ze kennen</span>
                    </div>
                </div>
                <!-- All users -->
                <div class="col-md-7 pr-lg-0 pr-md-0 pr-auto mt1 ">
                    <div class="all-user-wrap padding pt-0 pr-lg-3 pr-md-3 pr-auto ">
                        <form action="{{ route('getUser') }}" class="users-form " method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" class="user_id">
                            <a href="" class="d-flex all-users p-3 getUser">
                                <div class="d-flex aj-center ">
                                    <span class="all-user-icon d-flex aj-center">{{ substr(Auth::user()->name, 0,1) }}{{ substr(Auth::user()->lastname, 0,1) }}</span>
                                </div>
                                <div class="all-users-content d-flex flex-column justify-content-around w-100">
                                    <span class="all-user-name">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                                    <span class="all-user-email">{{ Auth::user()->email }}</span>
                                </div>
                                <small class="d-flex align-items-center grey-text all-user-arrow"><i class="fas fa-chevron-right"></i></small>
                            </a>
                        </form>
                        @foreach($users as $user)
                            @if($user->hasRole('student'))
                                <form action="{{ route('getUser') }}" class="users-form" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $user->id }}" name="user_id" class="user_id">
                                    <a href="" class="d-flex all-users p-3 my-3 getUser">
                                        <div class="d-flex aj-center ">
                                            <span class="all-user-icon d-flex aj-center">{{ substr($user->name, 0,1) }}{{ substr($user->lastname, 0,1) }}</span>
                                        </div>
                                        <div class="all-users-content d-flex flex-column justify-content-around w-100">
                                            <span class="all-user-name">{{ $user->name }}</span>
                                            <span class="all-user-email ">{{ $user->email }}</span>
                                        </div>
                                        <small class="d-flex align-items-center grey-text all-user-arrow"><i class="fas fa-chevron-right"></i></small>
                                    </a>
                                </form>
                            @endif
                        @endforeach

                    </div>
                </div>
                <!-- All users -->

                <!-- User info when clicked -->
                <div class="col-md-5 pl-lg-0 pl-md-0 pl-auto mb-5">
                    <div id="wrap-info" class="user-info-wrap padding pl-lg-3 pl-md-3 pl-auto">
                        <div class="d-flex user-info p-3 flex-column">
                            <div class="d-flex w-100 justify-content-center">
                                <span class="block-user-icon d-flex aj-center mr-0 " style="height: 60px">NA</span>
                            </div>
                            <div class="user-name mt-2">
                                <span class="all-user-name" id="username">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                            </div>
                            <table class="table table-borderless user-table mt-3 mx-lg-4 mx-md-3 mx-auto">
                                <tbody>
                                <tr>
                                    <th >Nummer</th>
                                    <td id="st_number">{{ Auth::user()->st_number }}</td>
                                </tr>
                                <tr>
                                    <th>Telefoon</th>
                                    <td id="tel">{{ (empty(Auth::user()->phone))? 'n.v.t' : Auth::user()->phone}}</td>
                                </tr>
                                <tr>
                                    <th>bedrijfsnaam</th>
                                    <td id="company_name">{{ (empty(Auth::user()->company))? 'n.v.t' : Auth::user()->company}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-center text-white">
                                <a href="{{ route('profile', Auth::user()->id) }}" id="userid" class="btn btn-sm m-0 bg-color-blue">profiel bekijken</a>
                            </div>
                        </div>

                        <div class="d-flex flex-column user-info p-3 mt-4">
                            <div class="meter white nostripes ">
                                <span id="percentage" class="text-right text-white text-shadow-slight radius-right "
                                      style="width: {{  ((Auth::user()->assignmentPercentile() == 0)? 0 : Auth::user()->assignmentPercentile())}}%;">
                                </span>
                            </div>
                            <span class="my-3 total-text" >
                                Totaal <span class="font-weight-bold" id="total">{{Auth::user()->getCountCompletedAssignments()}}
                            </span> van de <span class="font-weight-bold">9</span> onderdelen afgerond</span>

                        </div>

                    </div>
                </div>
                <!-- User info when clicked -->
            </div>
            <!-- All users section -->
        </div>
    </main>
@endsection
