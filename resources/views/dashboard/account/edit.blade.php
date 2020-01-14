@extends("layouts.account.main")
@section("content")
   @include('layouts.admin.nav', ['title' => 'Account aanpassen', 'thumb' => 'planet.jpg'])

    <main class="pt-3 ">
        <div class="container ">
            <div class="row position-relative">
                <div class="col-md-12">
                    <div class="user-f-wrap d-flex">
                        <div class="user-img ">
                            <img
                                @if(file_exists(public_path('uploads/avatar/'.$user->id . '/' . $user->file)) && !empty($user->file))
                                src="{{ asset('uploads/avatar/'.$user->id . '/' . $user->file)  }}"
                                @else
                                src="{{ asset('uploads/avatar/default/user icon.png')  }}"
                                @endif
                                alt="" class="img-thumbnail">
                            <a class="add-img" data-toggle="modal" data-target="#pfModal">
                                <span>
                                    <i class="fas fa-plus"></i> foto bewerken
                                </span>
                            </a>
                        </div>
                        <div class="user-header-wrap d-flex flex-column justify-content-around">
                            <span class="user-header-name home-color-blue">{{ $user->name }} {{ $user->lastname }} </span>
                            <span class="user-stnumber d-flex align-items-center font-weight-bold">
                            {{ $user->st_number }}
                        </span>
                        </div>
                        <div class="profile-btn text-white">
                            <a href="{{ route('profile', $user->id) }}"  class="btn btn-sm m-0 bg-color-blue no-box-shadow">naar profiel</a>
                        </div>
                    </div>

                </div>
                <div class="modal fade mt-lg-5 mt-md-5 mt-0 pt-lg-3 pt-md-3 mt-0" id="pfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content p-0">
                            <!-- deadline section form -->
                            <form  action="{{ route('profile.user.edit-img', $user) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input hidden name="id" value="{{ Crypt::encryptString($user->id)}}">
                                <div class="full-flex assigment-uploader flex-column box-shadow-light bg-white">
                                    <div class="uploader-header d-flex align-items-center ft-22">Foto toevoegen</div>
                                    <div class="uploader-content flex-column p-0 text-center">
                                        <div class="add-or-disclose d-flex border-bottom">
                                            <div class="add-img-btn ">
                                                <i class="fas fa-plus"></i> foto uploaden
                                                <input name="upload" type="file" class="custom-upload-img" id="upload" aria-describedby="fileInput">
                                            </div>
                                            <a type="button" class="add-dissclose" data-dismiss="modal">
                                                <i class="fas fa-minus"></i> Annuleren
                                            </a>
                                        </div>

                                        <div class="add-img-wrap" style="min-height: 100px;">
                                            <div class="add-img-content d-flex align-items-center justify-content-center" >
                                                <div class="previewImg" style="display:none;">
                                                    <div class="pre-wrap position-relative">
                                                        <img src="{{ asset('img/tegels/purple-blue.png')  }}" alt="" class="img-bg ">
                                                        <span>preview</span>
                                                    </div>

                                                    <img src="" alt="" class="img-upload previewImg"><br/>
                                                    <span class="preview-name home-color-blue font-weight-bold">{{ $user->name }} {{ $user->lastname }}</span>
                                                </div>
                                                <div id="no-img" class="p-4 grey-text text-center">
                                                    <span class="ft-30"><i class="far fa-image"></i></span>
                                                    <span>Voeg een profiel foto toe met de knop foto uploaden</span>
                                                </div>
                                            </div>

                                            <script type="application/javascript" src="https://code.jquery.com/jquery-1.10.2.js"></script>
                                            <script type="application/javascript">
                                                $(function() {
                                                    $('#upload').change(function (event) {
                                                        $('.previewImg').fadeIn("slow").attr('src', URL.createObjectURL(event.target.files[0]));
                                                        $('#no-img').css({ 'display': 'none'});

                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>


                                    <!-- Dealine content -->
                                    <!-- rating clickable -->
                                    <div class="d-flex align-items-center justify-content-end border-top-light">
                                        <button type="submit" class="btn  btn-passed bg-color-blue  py-4 btn-hover">Opslaan</button>
                                    </div>
                                    <!-- ratingclickable -->
                                </div>
                            </form>
                            <!-- Uploader section form -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-3">
                    <ul class="nav flex-column account-sidenav  py-4 bg-white h-100" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                               aria-selected="true">Over mij</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                               aria-selected="false">Account gegevens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="people-tab" data-toggle="tab" href="#login" role="tab" aria-controls="people"
                               aria-selected="false">Login gegevens</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="tab-content px-auto" id="myTabContent">
                        <div class="tab-pane fade faster show active " id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="assigment-wrap h-100 box-shadow bg-white">
                                <!-- Uploader section form -->
                                <form action="{{ route('profile.user.edit-about', $user) }}" method="POST" enctype="multipart/form-data" class="full-flex ">
                                    @csrf
                                    @method('PATCH')
                                    <input hidden name="id" value="{{ Crypt::encryptString($user->id)}}">
                                    <div class="full-flex  flex-column">
                                        <div class="uploader-content flex-column justify-content-center p-0 ">
                                            <div class="time-wrap">
                                        <span class="file-icon grey-text home-color-blue">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                                <div class="handin-date w-100">
                                                    <span class="time-header">Mijn story</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group purple-border full-flex m-0 padding-1">
                                            <textarea rows="6" name="cabout" cols="50" class="form-control max feedback-area {{ $errors->has('feeddback') ? ' is-invalid' : '' }}"
                                               placeholder="Vertel hier je verhaal of schrij iets over jezelf..."  style="resize: none;">{{ $user->cabout }}</textarea>
                                        </div>
                                        <div class="feedback-wrap text-right border-top-light">
                                            <button type="submit" class="btn btn-passed bg-color-blue py-125 btn-hover">Opslaan</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Uploader section form -->
                            </div>
                        </div>
                        <div class="tab-pane fade faster " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="assigment-wrap h-100 box-shadow bg-white">
                                <!-- Uploader section form -->
                                <form action="{{ route('profile.user.edit-account', $user) }}" method="POST" enctype="multipart/form-data" class="full-flex ">
                                    @csrf
                                    @method('PATCH')
                                    <input hidden name="id" value="{{ Crypt::encryptString($user->id)}}">
                                    <div class="full-flex  flex-column">
                                        <div class="uploader-content flex-column justify-content-center p-0 ">
                                            <div class="time-wrap">
                                        <span class="file-icon grey-text home-color-purple-blue">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                                <div class="handin-date w-100">
                                                    <span class="time-header">Account gegevens aanpassen</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uploader-content full-flex flex-column">
                                            <div class="form-group">
                                                <label for="name">
                                                    Naam
                                                </label>
                                                <input placeholder="" id="name" type="text"
                                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                       name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">
                                                   Achternaam
                                                </label>
                                                <input placeholder=""  type="text"
                                                       class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                                       name="lastname" value="{{ $user->lastname }}" required autocomplete="lastname" autofocus>

                                                <small class="text-danger">{{ $errors->first('lastname') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">
                                                    Studentnummer
                                                </label>
                                                <input placeholder="studentennummer"  type="text"
                                                       class="form-control{{ $errors->has('st_number') ? ' is-invalid' : '' }}"
                                                       name="st_number" value="{{ $user->st_number }}" required autocomplete="st_number" autofocus>

                                                <small class="text-danger">{{ $errors->first('st_number') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">
                                                    company
                                                </label>
                                                <input placeholder=""  type="text"
                                                       class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}"
                                                       name="company" value="{{ $user->company }}"  autocomplete="st_number" autofocus>

                                                <small class="text-danger">{{ $errors->first('company') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">
                                                    Telefoon
                                                </label>
                                                <input placeholder=""  type="text"
                                                       class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                       name="phone" value="{{ $user->phone }}" autocomplete="st_number" autofocus>
                                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                                            </div>
                                        </div>
                                        <div class="feedback-wrap text-right border-top-light">
                                            <button type="submit" class="btn btn-passed bg-color-blue py-125 btn-hover">Opslaan</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Uploader section form -->
                            </div>

                        </div>
                        <div class="tab-pane fade faster" id="login" role="tabpanel" aria-labelledby="people-tab" >
                            <div class="assigment-wrap h-100 box-shadow bg-white">
                                <!-- Uploader section form -->
                                <form action="{{ route('admin.users.edit-password', $user) }}" method="POST" enctype="multipart/form-data" class="full-flex ">
                                    @csrf
                                    @method('PATCH')
                                    <input hidden name="id" value="{{ Crypt::encryptString($user->id)}}">
                                    <div class="full-flex  flex-column">
                                        <div class="uploader-content flex-column justify-content-center p-0 ">
                                            <div class="time-wrap">
                                        <span class="file-icon grey-text home-color-blue">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                                <div class="handin-date w-100">
                                                    <span class="time-header">Account gegevens aanpassen</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uploader-content full-flex flex-column">
                                            <div class="form-group">
                                                <label for="email">
                                                    Nieuw wachtoord
                                                </label>
                                                <input placeholder="min 8 characters" id="password" type="password"
                                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                       name="password" required autocomplete="new-password">
                                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">
                                                    Herhaal wachtwoord
                                                </label>
                                                <input placeholder="Herhaal wachtwoord" id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="feedback-wrap text-right border-top-light">
                                            <button type="submit" class="btn btn-passed bg-color-blue py-125 btn-hover">Opslaan</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Uploader section form -->
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </main>
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
@endsection
