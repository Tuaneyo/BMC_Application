<div class="row position-relative mt-3 animated fadeIn delay-25ms">
    @if(Auth::user()->id !== $user->id)
        <div class="dis-overlay"></div>
    @endif

    <div class="col-lg-7 col-md-6 col-12 pr-lg-2 pr-md-2 pr-auto pr-auto pb-lg-0 pb-md-0 pb-2">
        <div class="d-flex flex-lg-row flex-md-column flex-column w-100 block-left">
            <!-- Onderdeel 1 -->
            <div class="d-flex w-100 pr-lg-2 pr-md-0 pr-auto pb-lg-0 pb-md-2 pb-2">
                <a href="{{ route('assigment', $acomponent[0]['id']) }}"
                   class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                             {{ ($acomponent[0]['finished']) ? 'grey' : ''}}">
                    <div class="d-flex h-100 w-100 pb-2">
                        <div class=" short-tegel ">
                            <div class="img-tegel d-flex w-100 h-100">
                                <img src="{{ asset('img/tegels/success.jpg') }}" class="object-fit re-wel-img" alt="1">
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

            <div class="w-100 pr-lg-2 pr-md-0 pr-auto pb-lg-0 pb-md-2 py-2 display-sm">
                <a href="{{ route('assigment', $acomponent[1]['id']) }}"
                   class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                            {{ ($acomponent[1]['finished']) ? 'grey' : ''}}">
                    <div class="d-flex h-100 w-100 pb-2">
                        <div class=" short-tegel ">
                            <div class="img-tegel d-flex w-100 h-100">
                                <img src="{{ asset('img/tegels/kernactiviteiten.jpg') }}" class="object-fit" alt="1">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex h-100 w-100 pt-2">
                        <div class="tegel-content flex-center w-100 flex-column">
                            <span class="tegel-title">Kernactiviteiten</span>
                            <span class="tegel-svg pt-2">
                                    <i class="fas fa-briefcase"></i>
                                   </span>
                            <div class="w-100 text-right tegel-icon ">
                                <i class="far fa-play-circle "></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-100 pr-lg-2 pr-md-0 pr-auto pb-lg-0 pb-md-2 py-2 display-sm">
                <a href="{{ route('assigment', $acomponent[2]['id']) }}"
                   class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                               {{ ($acomponent[2]['finished']) ? 'grey' : ''}}">
                    <div class="d-flex h-100 w-100 pb-2">
                        <div class=" short-tegel ">
                            <div class="img-tegel d-flex w-100 h-100">
                                <img src="{{ asset('img/tegels/people.jpg') }}" class="object-fit" alt="1">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex h-100 w-100 pt-2">
                        <div class="tegel-content flex-center w-100 flex-column">
                            <span class="tegel-title">Mensen en middelen</span>
                            <span class="tegel-svg pt-2">
                                   <i class="fas fa-people-carry"></i>
                                   </span>
                            <div class="w-100 text-right tegel-icon ">
                                <i class="far fa-play-circle "></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class=" w-100 px-lg-2 px-md-0 px-auto pb-lg-0 pb-md-2 pb-2 pt-lg-0 pt-md-2 pt-2 display-lg">
                <!-- Onderdeel 2 -->
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
                    <!-- Onderdeel 3 -->
                    <div class="d-flex h-100 w-100 pt-2">
                        <a href="{{ route('assigment', $acomponent[2]['id'])  }}"
                           class="tegel-content short-tegel shadow-hover flex-center w-100 flex-column blue-hover
                                    {{ ($acomponent[2]['finished']) ? 'grey' : ''}}">
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
            <!-- Onderdeel 4 -->
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
    <div class="col-lg-5 col-md-6 col-12 pl-lg-2 pl-md-2 pl-auto pt-lg-0 pt-md-0 pt-2">
        <!-- onderdeel 4 on mobile and tablets -->
        <div class="w-100 pr-lg-2 pr-md-0 pr-auto pb-lg-0 pb-md-2 pb-2 display-sm">
            <a href="{{ route('assigment', $acomponent[4]['id']) }}"
               class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                        {{ ($acomponent[4]['finished']) ? 'grey' : ''}}">
                <div class="d-flex h-100 w-100 pb-2">
                    <div class=" short-tegel ">
                        <div class="img-tegel d-flex w-100 h-100">
                            <img src="{{ asset('img/tegels/klantrelaties.jpg') }}" class="object-fit" alt="1">
                        </div>
                    </div>
                </div>
                <div class="d-flex h-100 w-100 pt-2">
                    <div class="tegel-content flex-center w-100 flex-column">
                        <span class="tegel-title">Klantrelaties</span>
                        <span class="tegel-svg pt-2">
                                   <i class="fas fa-heart"></i>
                                   </span>
                        <div class="w-100 text-right tegel-icon ">
                            <i class="far fa-play-circle "></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- onderdeel 5 on mobile and tablets -->
        <div class="w-100 pr-lg-2 pr-md-0 pr-auto pb-lg-0 pb-md-2 py-2 display-sm">
            <a href="{{ route('assigment', $acomponent[5]['id']) }}"
               class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                        {{ ($acomponent[5]['finished']) ? 'grey' : ''}}">
                <div class="d-flex h-100 w-100 pb-2">
                    <div class=" short-tegel ">
                        <div class="img-tegel d-flex w-100 h-100">
                            <img src="{{ asset('img/tegels/kanalen.jpg') }}" class="object-fit" alt="1">
                        </div>
                    </div>
                </div>
                <div class="d-flex h-100 w-100 pt-2">
                    <div class="tegel-content flex-center w-100 flex-column">
                        <span class="tegel-title">Kanalen</span>
                        <span class="tegel-svg pt-2">
                                   <i class="fas fa-network-wired"></i>
                                   </span>
                        <div class="w-100 text-right tegel-icon ">
                            <i class="far fa-play-circle "></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- onderdeel 4 and 5 on large screen -->

        <div class="flex-lg-row flex-md-column flex-column w-100 block-right h-100 display-lg">
            <div class="w-100 pr-lg-2 pr-md-0 pr-auto pb-lg-0 pb-md-2 pb-2 pt-lg-0 pt-md-0 pt-2 ">
                <div class="d-flex flex-column justify-content-between w-100 h-100">
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
                        <a href="{{ route('assigment', $acomponent[5]['id'])  }}"
                           class="tegel-content short-tegel shadow-hover flex-center w-100 flex-column orange-hover
                                    {{ ($acomponent[5]['finished']) ? 'grey' : ''}}">
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
                   class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                            {{ ($acomponent[6]['finished']) ? 'grey' : ''}}">
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

        <div class="d-flex w-100 pl-lg-2 pl-md-0 pl-auto pt-lg-0 pt-md-2 pt-2 display-sm">
            <a href="{{ route('assigment', $acomponent[6]['id'])  }}"
               class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                        {{ ($acomponent[6]['finished']) ? 'grey' : ''}}">
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

        <!-- onderdeel 7 on mobile and tablets -->
        <div class="w-100 pl-lg-2 pl-md-0 pl-auto pt-lg-0 pt-md-2 pt-2 display-sm">
            <div class="d-flex w-100  pb-lg-0 pb-md-0 py-2">
                <a href="{{ route('assigment', $acomponent[7]['id'])  }}"
                   class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                            {{ ($acomponent[7]['finished']) ? 'grey' : ''}}">
                    <div class="d-flex h-100 w-100 pb-2">
                        <div class=" short-tegel ">
                            <div class="img-tegel d-flex w-100 h-100">
                                <img src="{{ asset('img/tegels/money.jpg') }}"
                                     class="object-fit" alt="1">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex h-100 w-100 pt-2">
                        <div class="tegel-content flex-center w-100 flex-column">
                            <span class="tegel-title">Kostenstructuur</span>
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
        <!-- onderdeel 8 on mobile and tablets -->
        <div class="w-100 pl-lg-2 pl-md-0 pl-auto pt-lg-0 pt-md-2 pt-2 display-sm">
            <div class="d-flex w-100  pb-lg-0 pb-md-0 py-2">
                <a href="{{ route('assigment', $acomponent[8]['id'])  }}"
                   class="d-flex flex-column justify-content-between border-5 white-hover shadow-hover long-tegel
                            {{ ($acomponent[8]['finished']) ? 'grey' : ''}}">
                    <div class="d-flex h-100 w-100 pb-2">
                        <div class=" short-tegel ">
                            <div class="img-tegel d-flex w-100 h-100">
                                <img src="{{ asset('img/tegels/inkomstenstromen.jpg') }}"
                                     class="object-fit" alt="1">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex h-100 w-100 pt-2">
                        <div class="tegel-content flex-center w-100 flex-column">
                            <span class="tegel-title">Inkomstenstromen</span>
                            <span class="tegel-svg pt-2">
                                       <i class="fas fa-money-bill"></i>
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
<div class="row my-3 position-relative display-lg">
    @if(Auth::user()->id !== $user->id)
        <div class="dis-overlay"></div>
    @endif
    <div class="col-lg-6 col-md-12 col-sm-12 pr-lg-2 pr-md-auto pr-auto pr-auto pb-lg-0 pb-md-2 pb-2 ">
        <div class="d-flex w-100 h-100 shadow-hover">
            <div class="d-flex h-100 w-100">
                <a href="{{ route('assigment', $acomponent[7]['id'])  }}"
                   class="tegel-content short-tegel flex-center w-100 flex-column brown-hover
                                {{ ($acomponent[7]['finished']) ? 'grey' : ''}}">
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
                <a  href="{{ route('assigment',$acomponent[7]['id'])  }}" class=" short-tegel  border-5" style="border-color: #9C8341;">
                    <div class="img-tegel d-flex w-100 h-100">
                        <img src="{{ asset('img/tegels/money.jpg') }}" class="object-fit" alt="1">
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 pl-lg-2 pl-md-auto pl-auto pt-lg-0 pt-md-2 pt-2 ">
        <div class="d-flex w-100 h-100 shadow-hover">
            <div class="d-flex h-100 w-100">
                <a href="{{ route('assigment', $acomponent[8]['id'])  }}"
                   class="tegel-content short-tegel flex-center w-100 flex-column green-hover
                                {{ ($acomponent[8]['finished']) ? 'grey' : ''}}">
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
                <a href="{{ route('assigment',$acomponent[8]['id'])  }}" class=" short-tegel border-5" style="border-color: #2D7C3B; ">
                    <div class="img-tegel d-flex w-100 h-100">
                        <img src="{{ asset('img/tegels/inkomstenstromen.jpg') }}" class="object-fit" alt="1">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
