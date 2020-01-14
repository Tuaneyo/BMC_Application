@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => "Beoordeling: {$component->name}", 'thumb' => $component->thumb])
    <main class="pt-3 ">
        <div class="container-fluid p-0">
            <!-- user info -->
            <div class="user-wrap position-relative m-0 p-0" style="top: -50px;">
                <div class="d-flex flex-column align-items-center justify-content-center">
                    <div class="user-img-wrap bg-white radius-100">
                        <img
                            @if(file_exists(public_path('uploads/avatar/'.$user->id . '/' . $user->file)) && !empty($user->file))
                            src="{{ asset('uploads/avatar/'.$user->id . '/' . $user->file)  }}"
                            @else
                            src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                            @endif
                            alt="" height="100px" width="100px" />
                    </div>
                    <div class="user-content text-center mt-2">
                        <h5 class="font-weight-bold ft-20 home-color-blue">{{ $user->name }} {{ $user->lastname }}</h5>
                    </div>
                </div>
            </div>

            <div id="handin-time" class=" position-relative" style="top:-27px;">
                <div class="d-flex text-dark justify-content-center rating-user-info align-items-center">
                    <span class="mx-2 handin-icon"><i class="fas fa-id-card"></i></span>
                    <span class="mx-2">{{ $user->st_number }}</span>
                    <span class="mx-2 handin-icon"><i class="fas fa-envelope"></i></span>
                    <span class="mx-2">{{ $user->email }}</span>
                </div>
            </div>
            <!-- user info -->
            <!-- breadcrumbs -->
            <div class="row mx-0 divider-borde rating">
                <div class="col-md-12">
                    <div class="d-flex flex-lg-row flex-md-row flex-column justify-content-between align-items-center position-relative padding pt-1">
                        <div class="breadcrumb-wrap">
                            <div class="d-flex align-items-end">
                                <span class="mr-1 breadcrumb-icon m-0 p-0"><i class="fas fa-suitcase"></i></span>
                                <span class="mx-1 breadcrumb-arrow"><i class="fas fa-angle-right"></i></span>
                                @can('judge assignment')
                                <span class="mx-1 breadcrumb-text">Beoordelen</span>
                                @endcan
                                <span class="mx-1 breadcrumb-arrow"><i class="fas fa-angle-right"></i></span>
                                <span class="mx-1 breadcrumb-text">{{ $component->name }}</span>
                            </div>
                        </div>
                        <a id="back-btn" href="{{ route('admin.assignments.teacher') }}" class="btn btn-back mt-lg-auto mt-md-auto mt-4" >
                            <i class="fas fa-arrow-left"></i>
                            Terug
                        </a>
                    </div>

                </div>
            </div>
            <!-- breadcrumbs -->
            <!-- rating section -->
            <div class="row mx-0 rating">
                <!-- Assigment questions info -->
                <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mt-md-0 mt-2 divider-right divider-bottom">
                    <div class="assigment-wrap padding h-100">
                        <!-- Uploader section form -->
                        <div class="full-flex assigment-uploader flex-column mt-3 box-shadow-light bg-white mb-5 ">
                            <div class="uploader-header d-flex align-items-center">Bestand downloaden</div>
                            <div class="uploader-content flex-column  p-0 text-center">
                                <div class="time-wrap">
                                    <span class="file-icon home-color-blue">
                                        <i class="fas fa-clock"></i>
                                    </span>
                                    <div class="handin-date w-100">
                                        <span class="time-header ">Ingeleverd op</span>
                                        <span class="time">{{ $userAssigment->updated_at }}</span>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('download') }}" class="download-wrap full-flex flex-column aj-center" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <span class="download-file-icon grey-text text-center" style="position: relative; top: -15px;">
                                        <i class="fas fa-download"></i>
                                </span>
                                <input hidden value="{{$userAssigment->component_id}}" name="component_id"/>
                                <input hidden value="{{(empty($userAssigment->file2) ? $userAssigment->file1 : $userAssigment->file2)}}" name="file" />
                                <a href="" role="button" class="donwload-link ft-15 text-center">
                                    {{(empty($userAssigment->file2) ? substr($userAssigment->file1, 0, 35) : substr($userAssigment->file2,0 , 35))}}
                                </a>
                            </form>
                            <div class="d-flex justify-content-end border-top-light">
                                <form action="{{ route('download') }}" class="download-form" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input hidden value="{{$userAssigment->component_id}}" name="component_id"/>
                                    <input hidden value="{{(empty($userAssigment->file2) ? $userAssigment->file1 : $userAssigment->file2)}}" name="file" />
                                    <button type="submit" class="btn btn-passed bg-color-blue w-100 py-125 btn-hover">
                                        Download
                                    </button>
                                </form>
                            </div>
                            <!-- Uploader clickable -->
                        </div>
                        <!-- Uploader section form -->
                    </div>
                </div>

                <!-- Assigments section -->
                <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mt-md-0 mt-2 divider-right divider-bottom">
                    <div class="assigment-wrap padding h-100">
                        <!-- Uploader section form -->
                        <div class="full-flex assigment-uploader flex-column mt-3 box-shadow-light bg-white mb-5">
                            <div class="uploader-header d-flex align-items-center">Document beoordelen</div>
                            <div class="uploader-content flex-column p-0 text-center">
                                <div class="time-wrap">
                                    <span class="file-icon home-color-purple-blue">
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <div class="handin-date w-100">
                                        <span class="time-header ">Beordeling onderdeel</span>
                                        <span class="time">{{ $component->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Uploader current status -->
                            <div class="full-flex align-items-center flex-column aj-center py-2">
                                <div class="rate-icon ">
                                    @if($userAssigment->rated == 1)
                                        <i class="fas fa-times house-color-red"></i>
                                    @elseif($userAssigment->rated == 2)
                                        <i class="fas fa-check house-color-green"></i>
                                    @else
                                        <i class="fas fa-minus house-color-blue"></i>
                                    @endif
                                </div>
                                <div class="rate-content text-center">
                                    @if($userAssigment->rated == 1)
                                        Onvoldoende
                                    @elseif($userAssigment->rated == 2)
                                        Voldoende
                                    @else
                                        <span class="ft-20">Klik op voldoende/onvoldoende</span><br>
                                        <small class="ft-12 text-center">gebruikt de schakelaar hier linksonder</small>
                                    @endif
                                </div>
                                <div class="upload-bar {{ (($userAssigment->rated == 1)? 'house-red' : (($userAssigment->rated == 2) ? 'house-green' : 'house-blue' )) }}"
                                     style="width: 60%;">
                                </div>
                            </div>
                            <!-- rating clickable -->
                            <form action="{{ route('changeRating') }}" method="POST" enctype="multipart/form-data"
                                  class="d-flex align-items-center justify-content-between border-top-light">
                                {{ csrf_field() }}
                                <div id="toggles">
                                    <input type="checkbox" id="checkbox" class="ios-toggle" style="  visibility: hidden;" value="2"
                                    {{ ($userAssigment->rated == 1) ? '' :  'checked'}}/>
                                    <label for="checkbox" class="checkbox-label" data-off="Onvoldoende" data-on="Voldoende"></label>
                                    <input type="hidden" value="2" id="checkbox-hidden" name="rated" />
                                </div>
                                <input hidden name="id" value="{{$userAssigment->id}}">
                                <button type="submit" class="btn  btn-passed bg-color-purple-blue  py-125 btn-hover">Opslaan</button>
                            </form>
                            <!-- ratingclickable -->
                        </div>
                        <!-- Uploader section form -->
                    </div>
                </div>
                <!-- Assigment section -->

                <!-- Uploader section -->
                <div class="col-lg-4 col-md-12 col-12 mt-lg-0 mt-md-0 mt-2 divider-bottom">
                    <div class="assigment-wrap padding h-100">
                        <!-- Uploader section form -->
                        <form action="{{ route('admin.assignments.feedback') }}" method="POST" enctype="multipart/form-data" class="full-flex ">
                            {{ csrf_field() }}
                            <div class="full-flex assigment-uploader flex-column mt-3 box-shadow-light bg-white mb-5 ">
                                <div class="uploader-header d-flex align-items-center">Feedback geven</div>
                                <div class="uploader-content flex-columnjustify-content-center p-0">
                                    <div class="time-wrap">
                                        <span class="file-icon grey-text home-color-purple">
                                            <i class="fas fa-comment-alt"></i>
                                        </span>
                                        <div class="handin-date w-100">
                                            <span class="time-header">Opmerking plaatsen</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group purple-border full-flex m-0 padding-1">
                                     <textarea rows="1" name="feedback" cols="50" class="form-control feedback-area {{ $errors->has('feeddback') ? ' is-invalid' : '' }}"
                                               placeholder="Geef hier een feedback..."  style="resize: none;">{{ $userAssigment->feedback }}</textarea>
                                </div>
                                <!-- rating clickable -->
                                <div class="feedback-wrap text-right border-top-light">

                                    <input hidden name="id" value="{{$userAssigment->id}}">
                                    <button type="submit" class="btn btn-passed bg-color-purple py-125 btn-hover">Opslaan</button>
                                </div>
                                <!-- ratingclickable -->
                            </div>
                        </form>
                        <!-- Uploader section form -->
                    </div>
                </div>
                <!-- Uploader section -->
            </div>
            <!-- rating section -->


        </div>
        <!-- container-fluid -->

        <div class="container p-0">
            <div class="row mx-0">
                <div class="col-md-12">
                    <div class="padding ">
                        <div class="all-handin-header mt-5 mb-4 text-center">
                            <span>Geüpload door {{ $user->name }}</span>
                        </div>
                        @if(count($allAssignments))
                            @foreach($allAssignments as $aAssignment)
                                <div class="all-handin-wrap mt-3">
                                    <div class="handin-list d-flex flex-column">
                                        <div class="handin-item d-flex full-flex aj-center flex-lg-row flex-md-row flex-column">
                                            <div class="list-icons d-flex">
                                                <span class="list-icon1"><i class="fas fa-file-export"></i></span>
                                                <span class="list-icon2 mr-lg-3 mr-md-3 mr-0"><i class="fas fa-eye"></i></span>
                                            </div>
                                            <div class="handin-list-content flex-column full-flex ml-4">
                                                <div class="handin-list-name">
                                                    <h5 >{{ $aAssignment->Component->name }}</h5>
                                                </div>
                                                <div class="handin-list-file">
                                                    <h6 class="m-0">{{(empty($aAssignment->file2) ? $aAssignment->file1 : $aAssignment->file2)}}</h6>
                                                </div>
                                                <div class="mt-3">
                                                    <small class="border-top-light py-1 {{ (($aAssignment->rated == 1)? 'house-color-red' : (($aAssignment->rated == 2) ? 'house-color-green' : 'grey-text' )) }}">
                                                        @if($aAssignment->rated == 1)
                                                            Met onvoldoende beoordeeld
                                                        @elseif($aAssignment->rated == 2)
                                                            Met voldoende beoordeeld
                                                        @else
                                                            Nog niet beoordeeld
                                                        @endif
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="handin-list-button d-flex w-100 justify-content-end flex-lg-row flex-md-row flex-column">
                                                <form action="{{ route('download') }}" class="download-form" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input hidden value="{{$aAssignment->component_id }}" name="component_id"/>
                                                    <input hidden value="{{(empty($aAssignment->file2) ? $aAssignment->file1 : $aAssignment->file2)}}" name="file" />
                                                    <button type="submit" role="button" class="btn list-btn btn-sm house-red text-white mx-2 no-box-shadow">
                                                        <i class="fas fa-long-arrow-alt-down"></i>download
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.assignments.rating', $aAssignment->id) }}" class="btn btn-sm list-btn bg-color-blue mx-2 no-box-shadow text-white">
                                                    <i class="fas fa-share"></i> beoordelen
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="uploaded-wrap w-100 white">
                                <div class="d-flex p-4 grey-text flex-column aj-center text-center">
                                    <span class="ft-30 my-3"><i class="far fa-folder-open"></i></span>
                                    <span >{{ ucfirst($user->name) }} {{ ucfirst($user->lastname) }} heeft geen andere documenten ingeleverd.</span>
                                </div>
                            </div>
                        @endif

                    </div>
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
