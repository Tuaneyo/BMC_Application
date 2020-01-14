@extends("layouts.dashboard.main")
@section("content")

    @include('layouts.dashboard.nav', ['title' => $component->name, 'thumb' => $component->thumb])
    <main class="pt-3 ">
        <div class="container-fluid p-0">
            <!-- Breadcrumb -->
            <div class="row mx-0 divider-border">
                <div class="col-md-12">
                    <div class="breadcrumb-wrap padding">
                        <div class="d-flex align-items-end">
                            <span class="mr-1 breadcrumb-icon m-0 p-0"><i class="fas fa-suitcase"></i></span>
                            <span class="mx-1 breadcrumb-arrow"><i class="fas fa-angle-right"></i></span>
                            <span class="mx-1 breadcrumb-text"><a href="{{ route('components')  }}" class="home-link">BMC</a></span>
                            <span class="mx-1 breadcrumb-arrow"><i class="fas fa-angle-right"></i></span>
                            <span class="mx-1 breadcrumb-text font-weight-bold">{{ $component->name }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Breadcrumb -->

            <!-- Easyinfo -->
            <div class="row pb-0 divider-border mx-0">
                <div class="col-lg-4 col-md-12 col-12 my-lg-0 my-md-0 my-4">
                    <div class="d-flex flex-column padding">
                        <span class="musk-info-header">Vandaag</span>
                        <span class="today">{{ $today  }} </span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 my-lg-0 my-md-0 my-4">
                    <div class="d-flex flex-column padding">
                        <div class="d-flex flex-row musk-info-header mb-2">
                            <div class="mr-2">Voortgang</div>
                            <span class="grey-text">{{ ((isset($assignments))? ( (($assignments->rated == 2)? '1' : '0')): '0')}} van 1</span>
                        </div>
                        <div class="meter meter-round meter-big white nostripes w-lg-75 fw-sm {{ ((isset($assignments))? ( (($assignments->rated == 2)? '' : 'bg-light')): 'bg-light')}}">
                            <div class="text-right text-white text-shadow-slight radius-right meter-finish"
                                  style="width: {{ ((isset($assignments))? ( (($assignments->rated == 2)? '100' : '0')): '0')}}%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 my-lg-0 my-md-0 my-4">
                    <div class="d-flex flex-row padding">
                        <div class="d-flex flex-column justify-content-between">
                            <span class="musk-info-header mb-1">Deadline</span>
                            @can('add assignment deadline')
                                <button type="button" class="btn btn-dealine bg-color-blue" data-toggle="modal" data-target="#deadlineModal">
                                    {{ (!isset($deadline) ? 'toevoegen' : 'wijzigen') }}
                                </button>
                            @endcan
                        </div>

                        <div class="full-flex flex-center flex-column position-relative" style="bottom: 15px;">
                            <div class="cal-wrapper" style="width: 80px;">
                                <div class="d-flex cal-stocks justify-content-around">
                                    <span class="stock"></span>
                                    <span class="stock"></span>
                                </div>
                                <div class="cal-body">

                                    @if(isset($deadline))
                                        <span class="cal-number">{{$deadline['dayInt']}}</span>
                                        <span class="cal-text">{{$deadline['month']}}</span>
                                    @else
                                        <span class="cal-number">No</span>
                                        <span class="cal-text">deadline</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @hasrole('docent|administrator')
                    <!-- Modal -->
                    <div class="modal fade mt-lg-5 mt-md-5 mt-0 pt-lg-5 pt-md-5 mt-0" id="deadlineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-0">
                                <!-- deadline section form -->
                                <form  action="{{ route('setDate') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="full-flex assigment-uploader flex-column box-shadow-light bg-white">
                                    <div class="uploader-header d-flex align-items-center ft-22">Deadline bepalen</div>
                                    <div class="uploader-content flex-column p-0 text-center">
                                        <div class="time-wrap">
                                    <span class="file-icon home-color-blue">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                            <div class="handin-date w-100">
                                                <span class="time-header ft-20">Deadline van onderdeel</span>
                                                <span class="time ft-18">{{ $component->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Dealine content -->
                                    <div class="full-flex align-items-center flex-column">
                                            <div class="jquery-script-ads">
                                                <script  type="application/javascript"><!--
                                                    google_ad_client = "ca-pub-2783044520727903";
                                                    /* jQuery_demo */
                                                    google_ad_slot = "2780937993";
                                                    google_ad_width = 728;
                                                    google_ad_height = 90;
                                                    //-->
                                                </script>
{{--                                                <script  type="application/javascript"--}}
{{--                                                         src="https://pagead2.googlesyndication.com/pagead/show_ads.js">--}}
{{--                                                </script>--}}
                                               </div>
                                            <div class="jquery-script-clear"></div>
                                            <span class="date-label">Select datum en tijd</span>
                                            <div style="width: 300px;text-align: center;">
                                                <div id="picker"> </div>
                                                <input type="hidden"  name="date" value="" />
                                            </div>
                                        <div class="deadline-description m-4 pt-4">
                                            Bepaal zelf of de student na de deadline nog bestanden mag uploaden.
                                        </div>
                                    </div>

                                    <!-- Dealine content -->
                                    <!-- rating clickable -->
                                    <div class="d-flex align-items-center justify-content-between border-top-light">
                                        {{ csrf_field() }}
                                        <input hidden name="component_id" value="{{$component->id}}">
                                        <div id="toggles">
                                            <input type="checkbox" id="checkbox-deadline" class="ios-toggle" style="visibility: hidden;" value="0"
                                                checked/>
                                            <label for="checkbox-deadline" class="checkbox-label cabel-dealine"
                                                   data-off="Uploaden na deadline niet toegestaan" data-on="Uploaden na deadline toegestaan"></label>
                                            <input type="hidden" value="0" id="checkbox-hidden" name="disabled" />
                                        </div>
                                        <button type="submit" class="btn  btn-passed bg-color-blue  py-4 btn-hover">Opslaan</button>
                                    </div>
                                    <!-- ratingclickable -->
                                </div>
                                </form>
                                <!-- Uploader section form -->
                            </div>
                        </div>
                    </div>
                    @endhasrole
                </div>
            </div>
            <!-- Easyinfo -->

            <!-- Easyinfo -->
            <div class="row mx-0">
                <!-- Assigment questions info -->
                <div class="col-lg-4 col-md-12 col-12 my-lg-0 my-md-0 my-2 divider-right">
                    <div class="assigment-wrap padding">
                        <div class="certificate white">
                            <div class="d-flex p-4 grey-text flex-column aj-center text-center">
                                <img src="{{ asset('img/tegels/congratz2.jpg') }}" alt="" class="no-docu-img mb-3 ">
                                <span class="ft-18">Nog geen beoordeling gekregen.</span>
                            </div>
                        </div>
                        <!-- Assigment questions header -->
                        <div class="assigment-header">
                            checklist {{ strtolower($component->name) }}
                        </div>
                        <!-- Assigment questions header -->
                        <!-- Assigment questions content -->
                        <div class="full-flex flex-column question-blocks mt-3">
                            @foreach($component->description as $key => $cd)
                                <div class="d-flex question-block mt-2">
                                    <div class="question d-flex">
                                        {{$cd}}
                                    </div>
                                    <div class="question-check">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Assigment questions content -->
                    </div>
                </div>

                <!-- Assigments section -->
                <div class="col-lg-4 col-md-6 col-12 my-lg-0 my-md-0 my-2 divider-right">
                    <div class="assigment-wrap padding">
                        @if(!empty($assignments->feedback))
                            <div class="assigment-header ">
                                Feedback
                            </div>
                            <div class="mt-3 flex-column assigments mb-4">
                                <div class="assigment feedback py-4" style="border-left-color: orange; height: auto;">
                                    {{ $assignments->feedback }}
                                </div>
                            </div>
                        @endif
                        <div class="assigment-header ">
                            Opdracht beschrijving
                        </div>
                        <div class="mt-3 flex-column assigments" id="assignment-box">

                            <div class="assigment mt-2">
                                @if(isset($deadline))
                                    De deadline van dit onderdeel is gesteld op: {{ $deadline['day'] . ', ' . $deadline['dayInt']  }}
                                    {{ $deadline['month'] }} om {{ $deadline['time'] }}
                                @else
                                    Op dit moment heeft dit onderdeel nog geen deadline.
                                @endif
                            </div>
                            @if(!empty($component->AssignmentDesc))
                                @foreach($component->AssignmentDesc as $ad)
                                    <div class="assigment mt-2">
                                        {{ $ad->description }}
                                        @hasrole('administrator')
                                        <input type="hidden" value="{{ $ad->id }}" class="adid">
                                        <span id="times" class="assiggnment-times"><i class="fas fa-times"></i></span>
                                        @endhasrole
                                    </div>

                                @endforeach
                            @endif

                        </div>
                        @hasrole('docent|administrator')
                            <div class="assigments ">
                                <a  href="#" id="add-assigment" class="add-assigment mt-4 flex-center flex-column" >
                                    <span><i class="fas fa-plus"></i></span>
                                    <span>Opdracht toevoegen</span>
                                </a>
                            </div>

                            <div class="text-right mt-4" id="addAssigment-form">
                                <div class="full-flex assigment-uploader flex-column mt-3 box-shadow-light bg-white mb-5 ">
                                    <div class="uploader-content flex-column  p-0 text-center">
                                        <div class="time-wrap">
                                    <span class="file-icon ft-20 home-color-blue aj-center d-flex">
                                        <i class="fas fa-align-justify"></i>
                                    </span>
                                            <div class="form-group purple-border full-flex m-0 ">
                                     <textarea rows="3" name="description" cols="50" class="form-control feedback-area assigment-area p-2 {{ $errors->has('feeddback') ? ' is-invalid' : '' }}"
                                               placeholder="Opdracht omschrijving hier plaatsen..."  style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end ">
                                        <input hidden value="{{$component->id}}" name="component_id" class="component_id"/>
                                        <button type="submit" id="addAssigment-btn" class="btn btn-passed bg-color-blue py-125 btn-hover">
                                            Opslaan
                                        </button>
                                    </div>
                                </div>
                            </div>

                        @endhasrole
                    </div>
                </div>
                <!-- Assigment section -->

                <!-- Uploader section -->
                <div class="col-lg-4 col-md-6 col-12 my-lg-0 my-md-0 my-2 ">
                    <div class="assigment-wrap padding">
                        @hasrole('student')
                        <!-- Header text uploader section -->
                        <div class="assigment-header">
                            Inleverpunt
                        </div>
                        <!-- Header text uploader section -->
                        <!-- Uploader section form -->
                        <div class="full-flex assigment-uploader flex-column mt-3 box-shadow-light bg-white mb-5">
                            <div class="uploader-header d-flex align-items-center">Bestand uploaden</div>
                            <div class="uploader-content full-flex flex-column py-4">
                                <!-- Uploader current status -->
                                <div class="upload-status full-flex">
                                    <span class="upload-icon"><i class="fas fa-eye"></i></span>
                                    <div class="d-flex flex-column ml-3 w-100">
                                        <span class="upload-text">Nakijkstatus</span>
                                        <small class="upload-text-small">
                                            @if(!isset($assignments))
                                                Nog geen bestand geupload
                                                @else
                                            @if($assignments->file1 == "" && $assignments->file2 == "")
                                                Nog geen bestand geupload
                                            @else
                                                @if($assignments->rated == 2 || $assignments->rated == 1)
                                                    Nagekeken
                                                @else
                                                    In behandeling
                                                @endif
                                            @endif
                                                @endif
                                        </small>
                                        <div class="upload-bar {{ ((isset($assignments))? (($assignments->file1 == "" && $assignments->file2 == "") ? 'house-orange' : (($assignments->rated == 2 || $assignments->rated == 1)? 'house-green' : 'house-orange')): 'house-blue')}}">
                                        </div>
                                    </div>
                                </div>
                                <!-- Uploader current status -->
                                <!-- Uploader rating status -->
                                <div class="upload-status full-flex mt-3">
                                    <span class="upload-icon"><i class="fas fa-star"></i></span>
                                    <div class="d-flex flex-column ml-3 w-100">
                                        <span class="upload-text">Beoordeling</span>
                                        <small class="upload-text-small">
                                            @if(!isset($assignments))
                                                Nog niet beoordeeld
                                                @else
                                            @if( $assignments->rated == 1)
                                                Met een onvoldoende beoordeeld
                                            @elseif($assignments->rated == 2)
                                                Met een voldoende beoordeeld
                                            @else
                                                Nog niet beoordeeld
                                            @endif
                                                @endif
                                        </small>
                                        <div class="upload-bar {{ ((isset($assignments))?(($assignments->rated == 0)?  'house-blue' : (($assignments->rated == 1)? 'house-red' : 'house-green')):'house-blue')   }}"></div>
                                    </div>
                                </div>
                                <!-- Uploader rating status -->
                            </div>

                            @if(strtotime(date('Y-m-d h:m:s')) > strtotime($component->deadline))
                                <!--Disable-->
                            @endif
                            <!-- Uploader clickable -->
                            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            <div class="uploader mt-1">

                                <div class="input-group ip">
                                    <div class="input-group-prepend w-100 file-wrap">
                                        <input class="input-file" id="my-file" type="file" name="fassigment" />
                                        <input class="w-100" id="my-filename" type="text" placeholder="voorbeeld-S1121670.pdf" />



                                        <label id="upload-button" class="upload-btn waves-effect btn-hover"
                                               tabindex="0" for="my-file" style="background-image: url({{ asset('img/dashboard/purple-blue.png') }});
                                            background-repeat: no-repeat; background-size: 100% 100%;">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                        <input type="hidden" name="componentId" value="{{ $component->id }}">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                </div>
                                <!-- Button trigger modal -->
                                <button type="button" id="modal-btn" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal"></button>

                                <!-- Modal -->
                                <div class="modal fade mt-lg-5 mt-md-5 mt-0 pt-lg-5 pt-md-5 mt-0" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content ">
                                            <div class="d-flex flex-lg-row flex-md-row flex-column w-100">
                                                <div class="d-flex modal-img ">
                                                    <img src="{{ asset('img/dashboard/modal.jpg') }}" class="img-fluid z-depth-1 " alt="1">
                                                </div>
                                                <div class="d-flex flex-column w-100 p-4">
                                                    <div class="modal-header-wrap">
                                                        <h2 class="modal-title" id="exampleModalLabel">Document inleveren</h2>
                                                    </div>
                                                    <div class="modal-body-wrap my-3"></div>
                                                    <div class="modal-ft my-1">
                                                        <input type="submit" class="btn btn-primary ml-0" value="Inleveren"/>
                                                        <input type="button" class="btn-grey btn " data-dismiss="modal" value="Annuleren" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </form>
                            <!-- Uploader clickable -->
                        </div>
                        <!-- Uploader section form -->

                        <!-- Uploader download section -->
                        @if(isset($assignments))
                        <div class="assigment-header-small mt-4">
                            Document versie 1
                        </div>
                        <div class="full-flex assigment-uploader flex-column mt-2 box-shadow-light bg-white">
                            <div class="d-flex">
                                <span class="download-icon"><i class="far fa-file-alt"></i></span>
                                <div class="download-document">
                                    <form action="{{ route('download') }}" class="download-form" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input hidden value="{{$assignments->component_id}}" name="component_id"/>
                                        <input hidden value="{{$assignments->file1}}" name="file" />
                                        <a href="" role="button" class="donwload-link">{{$assignments->file1}}</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                            @if($assignments->file2 != "")
                                <div class="assigment-header-small mt-4">
                                    Document laatste versie
                                </div>
                                <div class="full-flex assigment-uploader flex-column mt-2 box-shadow-light bg-white">
                                    <div class="d-flex">
                                        <span class="download-icon"><i class="far fa-file-alt"></i></span>
                                        <div class="download-document">
                                            <form action="{{ route('download') }}" class="download-form" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input hidden value="{{$assignments->component_id}}" name="component_id"/>
                                                <input hidden value="{{$assignments->file2}}" name="file" />
                                                <a href="" role="button" class="donwload-link">{{$assignments->file2}}</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                         @endif
                        <!-- Uploader download section -->
                        @endhasrole
                        @hasrole('docent|administrator')
                        <!-- Header text uploader section -->
                        <div class="assigment-header">
                            Ingeleverde documenten ({{ count($allAssignments) }})
                        </div>
                        <!-- Header text uploader section -->

                        @if(count($allAssignments))
                            <div class="handed-in-wrap">
                            @foreach($allAssignments as $an)
                                <div class="uploader-content flex-column p-0 my-3 white">
                                    <div class="news-card">
                                        <div class="full-flex flex-column uploader bg-white ">
                                            <div class="uploader-content flex-column p-0">
                                                <div class="news-header-wrap">
                                                    <div class="d-flex news-thumb">
                                                        <img
                                                            @if(file_exists(public_path('uploads/avatar/'.$an->user->id . '/' . $an->user->file)) && !empty($an->user->file))
                                                            src="{{ asset('uploads/avatar/'.$an->user->id . '/' . $an->user->file)  }}"
                                                            @else
                                                            src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                                            @endif
                                                            alt="" class="img-thumbnail" />
                                                    </div>
                                                    <div class="news-header">
                                                        <span class="news-name">{{ $an->user->name }} {{ $an->user->lastname }}</span>
                                                        <small class="grey-text">
                                                            {{ $an->user->email  }}
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="news-content-img border-bottom p-4">
                                                    <form action="{{ route('download') }}" class="download-form" method="POST">
                                                        @csrf
                                                        <input hidden value="{{$an->component_id}}" name="component_id"/>
                                                        <input hidden value="{{(empty($an->file2) ? $an->file1 : $an->file2)}}" name="file" />
                                                        <a href="" role="button" class="donwload-link ft-15 text-center">
                                                            {{(empty($an->file2) ? substr($an->file1, 0, 350) : substr($an->file2,0 , 350))}}
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center h-100 white">
                                                <small class="grey-text ft-10-sm pl-3">
                                                    Ingeleverd op: {{ $an->updated_at->format('d-m-Y ') }} om {{ $an->updated_at->format(' H:i') }}
                                                </small>
                                                <div class="text-right">
                                                    <a href="{{ route('admin.assignments.rating', $an->id) }}" class="btn news-btn btn-passed bg-color-blue btn-hover" >
                                                        Beoordelen
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @else
                            <div class="uploader-content flex-column p-0 mt-3 white">
                                <div class="uploaded-wrap">
                                    <div class="d-flex p-4 grey-text flex-column aj-center text-center">
                                        <img src="{{ asset('img/tegels/document.jpg') }}" alt="" class="tfile-img mb-3 ">
                                        <span class="">Nog geen ingeleverde documenten voor dit onderdeel</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @endhasrole
                    </div>
                </div>
                <!-- Uploader section -->
            </div>
            <!-- Easyinfo -->
        </div>
    </main>
@endsection
