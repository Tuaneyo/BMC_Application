@extends("layouts.dashboard.main")
@section("content")

    @include('layouts.dashboard.nav', ['title' => 'Nieuwsoverzicht', 'thumb' => 'electric.jpg'])
    <!-- Section bsiness canvas row 1 -->
    <main class="pt-3 mb-4 ">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <!-- New news -->
                    <div class="me-news-wrap">
                        <div class="news-card">
                            <div class="full-flex flex-column uploader bg-white ">
                                <div class="uploader-content flex-column p-0">
                                    <div class="news-header-wrap">
                                        <div class="d-flex news-thumb">
                                            <img
                                                @if(file_exists(public_path('uploads/avatar/'.Auth::user()->id . '/' . Auth::user()->file)) && !empty(Auth::user()->file))
                                                src="{{ asset('uploads/avatar/'.Auth::user()->id . '/' . Auth::user()->file)  }}"
                                                @else
                                                src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                                @endif
                                                alt="" class="img-thumbnail">
                                        </div>
                                        <div class="news-header">
                                            <span class="news-name">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                                            <small class="grey-text">Deel je bericht of verhaal met anderen</small>
                                        </div>

                                    </div>

                                    <div class="news-content">
                                        <div class="form-group purple-border full-flex m-0">
                                        <textarea rows="3" name="body" cols="50" class="form-control news p-2 news-change news-body news-empty"
                                                  placeholder="Laat anderen weten wat je verhaal vandaag is..." ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between border-top align-items-center">
                                    <small class="grey-text  pl-3"><i class="fas fa-globe-asia"></i> Bericht maken</small>
                                    <input hidden value="{{ Crypt::encryptString(Auth::user()->id) }}" name="publisher_id" class="news-publisher_id"/>
                                    <input hidden value="{{ Crypt::encryptString($user->id)}}" name="user_id" class="news-user_id"/>
                                    <button type="submit" id="news-send" data-resource="nieuws/storeNews" class="btn news-btn btn-passed bg-color-blue py-125 btn-hover" disabled>
                                        Delen
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="news-begin"></div>
                    <!-- New news -->
                    @foreach($news as $n)
                        @if($n instanceof \App\Models\Post)
                            <div class="me-news-wrap">
                                <div class="news-card">
                                    <div class="full-flex flex-column uploader bg-white ">
                                        <div class="uploader-content flex-column p-0">
                                            <div class="news-header-wrap">
                                                <div class="d-flex news-thumb">
                                                    <img
                                                    @if(file_exists(public_path('uploads/avatar/'.$n->publisher->id . '/' . $n->publisher->file)))
                                                    src="{{ asset('uploads/avatar/'.$n->publisher->id . '/' . $n->publisher->file)  }}"
                                                    @else
                                                    src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                                    @endif
                                                        alt="" class="img-thumbnail ">
                                                </div>
                                                <div class="news-header">
                                                    <span class="news-name">{{ $n->publisher->name }} {{ $n->publisher->lastname }}</span>
                                                    <small class="grey-text"><i class="far fa-clock ft-9"></i>
                                                        geplaatst op: {{ $n->updated_at->format('d-m-Y ') }} om {{ $n->updated_at->format(' H:i') }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="news-content">
                                                <div style="white-space: pre-line;"
                                                     class="text py-3 {{ (strlen($n->body) < 70) ? 'ft-22' : ((strlen($n->body)>100) ? 'ft-16' : 'ft-18') }} px-2">{{ $n->body }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="news-comment">
                                            <a href="" class="comment-link">
                                                <i class="far fa-thumbs-up"></i>
                                                <span>Thumb up</span>
                                            </a>
                                            <a href="" class="comment-link">
                                                <i class="far fa-comment-alt"></i>
                                                <span>Opmerking</span>
                                            </a>
                                        </div>
                                        @foreach($n->getComments as $comment)
                                            @if($comment)
                                            <div class="news-comment-wrap border-top p-3">
                                                <div class="news-img-small">
                                                    <img
                                                    @if(file_exists(public_path('uploads/avatar/'.$comment->user->id . '/' . $comment->user->file)))
                                                        src="{{ asset('uploads/avatar/'.$comment->user->id . '/' . $comment->user->file)  }}"
                                                    @else
                                                        src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                                    @endif
                                                    alt="" class="">
                                                </div>
                                                <div class="comment-text">
                                                    <span class="font-weight-bold home-color-blue"> {{ $comment->user->name }} {{ $comment->user->lastname }}</span><br>
                                                    <span class="ft-14">
                                                        {{ $comment->body }}
                                                </span>
                                                </div>
                                                <div class="news-icon">
                                                    <i class="fas fa-comment-alt p-1"></i>
                                                    <span>d</span>
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                        <div class="find-comment d-flex justify-content-between border-top align-items-center px-3 pt-3">
                                            <form action="{{ route('comment.store') }}" method="post" class="w-100">
                                                 @csrf
                                                <input hidden value="{{ Crypt::encryptString(Auth::user()->id) }}" name="user_id" class="user_id"/>
                                                <input hidden value="{{ Crypt::encryptString($n->id)  }}" name="post_id" class="post_id"/>
                                                <div class="form-group purple-border full-flex m-0">
                                                <textarea rows="1" name="body" cols="50" class="form-control news-change comment-body comment-submit  p-2 "
                                                      placeholder="Schrijf een opmerking..." ></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <small class="grey-text small-text">Druk om enter om te plaatsen</small>
                                    </div>
                                </div>
                            </div>
                        @elseif($n instanceof \App\Models\UserAssigment)
                            <div class="me-news-wrap">
                            <div class="news-card">
                                <div class="full-flex flex-column uploader bg-white ">
                                    <div class="uploader-content flex-column pt-0 px-0">
                                        <div class="news-header-wrap">
                                            <div class="d-flex news-thumb">
                                                <img
                                                    @if(file_exists(public_path('uploads/avatar/'.$n->user->id . '/' . $n->user->file)))
                                                    src="{{ asset('uploads/avatar/'.$n->user->id . '/' . $n->user->file)  }}"
                                                    @else
                                                    src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                                    @endif
                                                    alt="" class="img-thumbnail">
                                            </div>
                                            <div class="news-header">
                                                <span class="news-name">{{ $n->user->name }} {{ $n->user->lastname }}</span>
                                                <small class="grey-text"><i class="far fa-clock ft-9"></i>
                                                    geplaatst op: {{ $n->updated_at->format('d-m-Y ') }} om {{ $n->updated_at->format(' H:i') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="news-content-img ">
                                            <div class="d-flex flex-column img-news">
                                                <a href="{{ route('assigment', $n->component->id) }}">
                                                    <img src="{{ asset('img/tegels/' . $n->component->thumb  ) }}" class="object-fit" alt="1" height="250px" width="100%">
                                                </a>
                                                <div class="text my-1 ">
                                                @if(Auth::user()->id === $n->user->id)
                                                    Je hebt op  {{ $n->updated_at->format('d-m-Y ') }} een <span class="{{ ($n->rated == 1) ? 'red-text' : 'green-text' }}">
                                                            {{ ($n->rated == 1) ? 'onvoldoende' : 'voldoende' }}
                                                        </span> gekregen voor het onderdeel <a href="{{ route('assigment', $n->component->id)  }}">
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
                                            <div class="news-comment">
                                                <a href="" class="comment-link">
                                                    <i class="far fa-thumbs-up"></i>
                                                    <span>Thumb up</span>
                                                </a>
                                                <a href="" class="comment-link">
                                                    <i class="far fa-comment-alt"></i>
                                                    <span>Opmerking</span>
                                                </a>
                                            </div>
                                            @foreach($n->getComments as $comment)
                                                @if($comment)
                                                    <div class="news-comment-wrap border-top p-3">
                                                        <div class="news-img-small">
                                                            <img
                                                                @if(file_exists(public_path('uploads/avatar/'.$comment->user->id . '/' . $comment->user->file)))
                                                                src="{{ asset('uploads/avatar/'.$comment->user->id . '/' . $comment->user->file)  }}"
                                                                @else
                                                                src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                                                @endif
                                                            alt="" class="">
                                                        </div>
                                                        <div class="comment-text">
                                                            <span class="font-weight-bold home-color-blue"> {{ $comment->user->name }} {{ $comment->user->lastname }}</span><br>
                                                            <span class="ft-14">
                                                        {{ $comment->body }}
                                                </span>
                                                        </div>
                                                        <div class="news-icon">
                                                            <i class="fas fa-comment-alt p-1"></i>
                                                            <span>d</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="find-comment d-flex justify-content-between border-top align-items-center px-3 pt-3">
                                                <form action="{{ route('comment.store') }}" method="post" class="w-100">
                                                    @csrf
                                                    <input hidden value="{{ Crypt::encryptString(Auth::user()->id) }}" name="user_id" class="user_id"/>
                                                    <input hidden value="{{ Crypt::encryptString($n->component->id)  }}" name="component_id" class="component_id"/>
                                                    <div class="form-group purple-border full-flex m-0">
                                                <textarea rows="1" name="body" cols="50" class="form-control news-change comment-body comment-submit  p-2 "
                                                          placeholder="Schrijf een opmerking..." ></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <small class="grey-text small-text">Druk om enter om te plaatsen</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach

                    <div class="me-news-wrap">
                        <div class="text-right news-card">
                            <div class="full-flex flex-column uploader  bg-white">
                                <div class="uploader-content flex-column p-0">
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
                    <!-- registered -->
                </div>
                <div class="col-md-5">
                    <div class="me-news-wrap">
                        <div class="full-flex flex-column uploader mt-3 mb-5 ">
                            <div class="uploader-content flex-column p-0 mb-2">
                                <div class="news-content">
                                    <div class="text ft-20 px-2">
                                        Ingeleverde opdrachten
                                    </div>
                                </div>
                            </div>
                            @if(count($unrated))
                                @foreach($unrated as $ur)
                                    <div class="news-content my-2">
                                        <!-- Uploader rating status -->
                                        <div class="upload-status full-flex">
                                            <div class="circle-wrap">
                                                @switch($ur->component_id)
                                                    @case($component[0]->id)
                                                    <span class="circle bg-partnerts"><i class="fas fa-handshake"></i></span>
                                                    @break
                                                    @case($component[1]->id)
                                                    <span class="circle bg-kern"><i class="fas fa-briefcase"></i></span>
                                                    @break
                                                    @case($component[2]->id)
                                                    <span class="circle bg-people"><i class="fas fa-people-carry"></i></span>
                                                    @break
                                                    @case($component[3]->id)
                                                    <span class="circle bg-value"><i class="fas fa-gift"></i></span>
                                                    @break
                                                    @case($component[4]->id)
                                                    <span class="circle  bg-relation"><i class="fas fa-heart"></i></span>
                                                    @break
                                                    @case($component[5]->id)
                                                    <span class="circle bg-network"><i class="fas fa-network-wired"></i></span>
                                                    @break
                                                    @case($component[6]->id)
                                                    <span class="circle bg-clients"><i class="fas fa-mug-hot"></i></span>
                                                    @break
                                                    @case($component[7]->id)
                                                    <span class="circle bg-money"><i class="fas fa-table"></i></span>
                                                    @break
                                                    @case($component[8]->id)
                                                    <span class="circle bg-income"><i class="fas fa-money-bill"></i></span>
                                                    @break
                                                @endswitch
                                            </div>
                                            <div class="d-flex flex-column ml-3 w-100">
                                                <span class="upload-text">{{$ur->component->name}}</span>
                                                <small class="upload-text-small">
                                                    Nakijkstatus: in behandeling
                                                </small>
                                                <div class="upload-bar house-blue"></div>
                                            </div>
                                        </div>
                                        <!-- Uploader rating status -->
                                    </div>
                                @endforeach
                            @else
                                <div class="news-content my-2">
                                    <div class="d-flex p-3 grey-text flex-column aj-center text-center">
                                        <span class="ft-30"><i class="fas fa-suitcase"></i></span>
                                        <span>Op dit moment heb je nog geen ingeleverde opdrachten</span>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
