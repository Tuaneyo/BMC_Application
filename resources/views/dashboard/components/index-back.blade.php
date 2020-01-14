@extends("layouts.dashboard.main")
@section("content")

    @include('layouts.dashboard.nav', ['title' => 'Jouw business model canvas', 'thumb' => 'Competion.png'])
    <!-- Section bsiness canvas row 1 -->
    <main class="pt-5 pb-5 mb-4 ">
        <div class="container-fluid px-lg-5 px-md-2 px-auto">
            <div class="row con-fluid-padding-top">
                <div class="col-md-7 pr-lg-2 pr-md-2 pr-auto pr-auto pb-lg-0 pb-md-0 pb-2">
                    <div class="d-flex flex-lg-row flex-md-column flex-column w-100 block-left">
                        <div class="d-flex w-100 pr-lg-2 pr-md-0 pr-auto pb-lg-0 pb-md-2 pb-2">
                            <a href="{{ route('assigment', $acomponent[0]['id']) }}"
                               class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                                        {{ ($acomponent[0]['finished']) ? 'grey' : ''}}">
                                <div class="d-flex h-100 w-100 pb-2">
                                    <div class=" short-tegel ">
                                        <div class="img-tegel d-flex w-100 h-100">
                                            <img src="{{ asset('img/tegels/success.jpg') }}" class="object-fit" alt="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex h-100 w-100 pt-2">
                                    <div class="tegel-content flex-center w-100 flex-column">
                                        <span class="tegel-title">Strategische partners</span>
                                        <span class="tegel-svg pt-2">
                                       <i class="fas fa-handshake"></i>
                                       </span>
                                        <div class="w-100 text-right tegel-icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex w-100 px-lg-2 px-md-0 px-auto pb-lg-0 pb-md-2 pb-2 pt-lg-0 pt-md-2 pt-2">
                            <div class="d-flex flex-column justify-content-between w-100 ">
                                <div class="d-flex h-100 w-100 pb-2">
                                    <a href="{{ route('assigment', $acomponent[1]['id'])  }}"
                                       class="tegel-content short-tegel shadow-hover flex-center w-100 flex-column yellow-hover
{{ ($acomponent[1]['finished']) ? 'grey' : ''}}">
                                        <span class="tegel-title text-shadow-slight pb-2">Kernactiviteiten</span>
                                        <span class="tegel-svg pt-2">
                                       <i class="fas fa-briefcase"></i>
                                   </span>
                                        <div class="w-100 text-right tegel-icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </a>
                                </div>

                                <div class="d-flex h-100 w-100 pt-2">
                                    <a href="{{ route('assigment', $acomponent[2]['id'])  }}"
                                       class="tegel-content short-tegel shadow-hover flex-center w-100 flex-column
                                       blue-hover {{ ($acomponent[2]['finished']) ? 'red' : ''}}">
                                        <span class="tegel-title text-shadow-slight pb-2">Mensen en middelen</span>
                                        <span class="tegel-svg pt-2">
                                       <i class="fas fa-people-carry"></i>
                                   </span>
                                        <div class="w-100 text-right tegel-icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-100 pl-lg-2 pl-md-0 pl-auto pt-lg-0 pt-md-2 pt-2">
                            <div class="d-flex w-100  pb-lg-0 pb-md-0 pb-2">
                                <a href="{{ route('assigment', $acomponent[3]['id'])  }}"
                                   class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                                    {{ ($acomponent[3]['finished']) ? 'grey' : ''}}">
                                    <div class="d-flex h-100 w-100 pb-2">
                                        <div class=" short-tegel ">
                                            <div class="img-tegel d-flex w-100 h-100">
                                                <img src="{{ asset('img/tegels/value-proposition.png') }}"
                                                     class="object-fit" alt="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex h-100 w-100 pt-2">
                                        <div class="tegel-content flex-center w-100 flex-column">
                                            <span class="tegel-title">Waardepropositie</span>
                                            <span class="tegel-svg pt-2">
                                           <i class="fas fa-gift"></i>
                                       </span>
                                            <div class="w-100 text-right tegel-icon">
                                                <i class="far fa-play-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 pl-lg-2 pl-md-2 pl-auto pt-lg-0 pt-md-0 pt-2">
                    <div class="d-flex flex-lg-row flex-md-column flex-column w-100 block-right h-100">
                        <div class="d-flex w-100 pr-lg-2 pr-md-0 pr-auto pb-lg-0 pb-md-2 pb-2 pt-lg-0 pt-md-0 pt-2">
                            <div class="d-flex flex-column justify-content-between w-100">
                                <div class="d-flex h-100 w-100 pb-2 ">
                                    <a href="{{ route('assigment', $acomponent[4]['id'])  }}"
                                       class="tegel-content short-tegel shadow-hover flex-center w-100 flex-column red-hover
{{ ($acomponent[4]['finished']) ? 'grey' : ''}}">
                                        <span class="tegel-title text-shadow-slight pb-2">Klantrelaties</span>
                                        <span class="tegel-svg pt-2">
                                        <i class="fas fa-heart"></i>
                                   </span>
                                        <div class="w-100 text-right tegel-icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="d-flex h-100 w-100 pt-2">
                                    <a href="{{ route('assigment', $acomponent[5]['id'])  }}" class="tegel-content short-tegel
                                    shadow-hover flex-center w-100 flex-column orange-hover {{ ($acomponent[5]['finished']) ? 'grey' : ''}}">
                                        <span class="tegel-title text-shadow-slight pb-2">Kanalen</span>
                                        <span class="tegel-svg pt-2">
                                       <i class="fas fa-network-wired"></i>
                                   </span>
                                        <div class="w-100 text-right tegel-icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex w-100 pl-lg-2 pl-md-0 pl-auto pt-lg-0 pt-md-2 pt-2">
                            <a href="{{ route('assigment', $acomponent[6]['id'])  }}"
                               class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover
                               long-tegel {{ ($acomponent[6]['finished']) ? 'grey' : ''}}">
                                <div class="d-flex h-100 w-100 pb-2">
                                    <div class=" short-tegel ">
                                        <div class="img-tegel d-flex w-100 h-100">
                                            <img src="{{ asset('img/tegels/segement.png') }}" class="object-fit" alt="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex h-100 w-100 pt-2">
                                    <div class="tegel-content flex-center w-100 flex-column" >
                                        <span class="tegel-title">Klantsegmenten</span>
                                        <span class="tegel-svg pt-2">
                                        <i class="fas fa-mug-hot"></i>
                                       </span>
                                        <div class="w-100 text-right tegel-icon">
                                            <i class="far fa-play-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Section bsiness canvas row 1 -->

            <!-- Section bsiness canvas row 2 -->
            <div class="row con-fluid-padding-top">
                <div class="col-lg-6 col-md-12 col-sm-12 pr-lg-2 pr-md-auto pr-auto pr-auto pb-lg-0 pb-md-2 pb-2 ">
                    <div class="d-flex w-100 h-100 shadow-hover">
                        <div class="d-flex h-100 w-100">
                            <a href="{{ route('assigment',  $acomponent[7]['id'])  }}" class="tegel-content short-tegel
                            flex-center w-100 flex-column brown-hover {{ ($acomponent[7]['finished']) ? 'grey' : ''}}">
                                <span class="tegel-title text-shadow-slight pb-2">Kostenstructuur</span>
                                <span class="tegel-svg pt-2">
                                <i class="fas fa-table"></i>
                            </span>
                                <div class="w-100 text-right tegel-icon">
                                    <i class="far fa-play-circle"></i>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex h-100 w-100 animated delay-1s">
                            <div class=" short-tegel  border-5 {{ ($acomponent[7]['finished']) ? 'border-green grey' : ''}}" style="border-color: #9C8341;">
                                <div class="img-tegel d-flex w-100 h-100">
                                    <img src="{{ asset('img/tegels/money.jpg') }}" class="object-fit" alt="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 pl-lg-2 pl-md-auto pl-auto pt-lg-0 pt-md-2 pt-2 ">
                    <div class="d-flex w-100 h-100 shadow-hover">
                        <div class="d-flex h-100 w-100">
                            <a href="{{ route('assigment',  $acomponent[8]['id'])  }}" class="tegel-content short-tegel
                             flex-center w-100 flex-column green-hover {{ ($acomponent[8]['finished']) ? 'grey' : ''}}" >
                                <span class="tegel-title text-shadow-slight pb-2">Inkomstenstromen</span>
                                <span class="tegel-svg pt-2">
                                <i class="fas fa-money-bill"></i>
                            </span>
                                <div class="w-100 text-right tegel-icon">
                                    <i class="far fa-play-circle"></i>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex h-100 w-100">
                            <div class=" short-tegel border-5 {{ ($acomponent[8]['finished']) ? 'border-grey grey' : ''}}" style="border-color: #2D7C3B; ">
                                <div class="img-tegel d-flex w-100 h-100">
                                    <img src="{{ asset('img/tegels/inkomstenstromen.jpg') }}" class="object-fit" alt="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
