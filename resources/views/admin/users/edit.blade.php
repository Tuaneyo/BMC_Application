@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => 'Gebruiker aanpassen', 'thumb' => 'planet.jpg'])
    <main class="pt-3 ">
        <div class="container p-0 mb-5">
            <div class="row position-relative">
                <div class="col-md-12">
                    <div class="user-f-wrap d-flex">
                        <div class="user-img ">
                            <img
                                @if(file_exists(public_path('uploads/avatar/'.$user->id . '/' . $user->file)) && !empty($user->file) )
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
                            <a id="back-btn " href="{{ route('admin.users.index') }}" class="btn btn-back" >
                                <i class="fas fa-arrow-left"></i>
                                Terug
                            </a>
                            <a href="{{ route('profile', $user->id) }}"  class="btn btn-account m-0 bg-color-blue no-box-shadow">naar profiel</a>
                        </div>
                    </div>

                </div>
                <div class="modal fade mt-lg-5 mt-md-5 mt-0 pt-lg-3 pt-md-3 mt-0" id="pfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content p-0">
                            <!-- deadline section form -->
                            <form  action="{{ route('admin.users.edit-img', $user) }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="d-flex align-items-center justify-content-end border-top-light">
                                        <button type="submit" class="btn  btn-passed bg-color-blue  py-4 btn-hover">Opslaan</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Uploader section form -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="assigment-wrap h-100 box-shadow bg-white">
                        <!-- Uploader section form -->
                        <form action="{{ route('admin.users.edit-password', $user) }}" method="POST" enctype="multipart/form-data" class="full-flex ">
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
                                    <button type="submit" class="btn btn-passed bg-color-purple-blue py-125 btn-hover">Opslaan</button>
                                </div>
                            </div>
                        </form>
                        <!-- Uploader section form -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="assigment-wrap h-100 box-shadow bg-white">
                        <!-- change role section -->
                        <form action="{{ route('admin.users.edit-role', $user) }}" method="POST" enctype="multipart/form-data" class="full-flex ">
                            @csrf
                            @method('PATCH')
                            <input hidden name="id" value="{{ Crypt::encryptString($user->id)}}">
                            <div class="full-flex  flex-column">
                                <div class="uploader-content flex-column justify-content-center p-0">
                                    <div class="time-wrap">
                                        <span class="file-icon grey-text home-color-blue">
                                            <i class="fas fa-user-tag"></i>
                                        </span>
                                        <div class="handin-date w-100">
                                            <span class="time-header">Rol toekennen aan <span class="home-color-blue">{{ $user->name }}</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class=" d-flex justify-content-center align-items-center full-flex py-5">
                                    @foreach($roles as $role)
                                        <div class="d-flex flex-column aj-center roles-wrap">
                                            @switch($role->name)
                                                @case('student')
                                                    <div class="student st @if($user->hasRole($role)) active @endif">
                                                        <i class="fas fa-user-graduate"></i>
                                                        <span>student</span>
                                                    </div>
                                                    @break
                                                @case('docent')
                                                    <div class="teacher st @if($user->hasRole($role)) active @endif">
                                                        <i class="fas fa-chalkboard-teacher"></i>
                                                        <span>docent</span>
                                                    </div>
                                                    @break
                                            @endswitch
                                            <input type="radio" name="roles" class="mt-2 roles-radio" value="{{ $role->id }}" @if($user->hasRole($role)) checked @endif>
                                        </div>
                                    @endforeach
                                    <!-- Safte reasons -->
                                        <script type="application/javascript">
                                            $(function() {
                                                $('.student').on('click', function () {
                                                    $(this).addClass('active');
                                                    $('.teacher').removeClass('active');
                                                    $(this).closest('.roles-wrap').find('.roles-radio').prop('checked', true).trigger("click");
                                                });

                                                $('.teacher').on('click', function () {
                                                    $(this).addClass('active');
                                                    $('.student').removeClass('active');
                                                    $(this).closest('.roles-wrap').find('.roles-radio').prop('checked', true).trigger("click");
                                                });
                                            });
                                        </script>
                                </div>
                                <!-- roles clickable -->
                                <div class="feedback-wrap text-right border-top-light">
                                    <button type="button" class="btn btn-passed bg-color-blue py-125 btn-hover" data-toggle="modal" data-target="#warningModal">Opslaan</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade mt-lg-5 mt-md-5 mt-0 pt-lg-5 pt-md-5 mt-0" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content ">
                                            <div class="d-flex flex-lg-row flex-md-row flex-column w-100">
                                                <div class="d-flex modal-img ">
                                                    <img src="{{ asset('img/tegels/warning.gif') }}" class="img-fluid z-depth-1 " alt="1">
                                                </div>
                                                <div class="d-flex flex-column w-100 p-4">
                                                    <div class="modal-header-wrap">
                                                        <h2 class="modal-title">Let op!</h2>
                                                    </div>
                                                    <div class="warning-body my-3">
                                                        Je staat op het punt om een ander rol te geven aan:
                                                        <span class="home-color-blue">{{ $user->name }} {{ $user->lastname }}</span>.
                                                        Klik op bevestigen om wijziging op te slaan.
                                                    </div>
                                                    <div class="modal-ft my-1">
                                                        <input type="submit" class="btn btn-primary ml-0" value="Bevestigen"/>
                                                        <input type="button" class="btn-grey btn " data-dismiss="modal" value="Annuleren" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- rolesclickable -->
                            </div>
                        </form>
                        <!-- Uploader section form -->
                    </div>
                </div>
            </div>

            <div class="profile-header-wrap mb-4 mt-5">
                <div class="icon-wrap">
                    <span class="icon"><i class="fas fa-info"></i></span>
                </div>
                <div class="header">
                    <span>Gebruikers informatie</span>
                </div>
            </div>
            <!-- user info -->
            <div class="row mt-4">
                <div class="col-lg-3 col-md-6 col-12 mt-3 mb-3 user-info-wrap">
                    <div class="d-flex flex-column justify-content-center align-items-center user-content box-shadow">
                        <span class="user-icon" style="color: #4f68d8;"><i class="fas fa-file-alt"></i></span>
                        <span class="user-text text-black-50">Bestanden ingeleverd</span>
                        <span class="user-int text-grey" >{{ $assignments }}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-3 mb-3 user-info-wrap">
                    <div class="d-flex flex-column justify-content-center align-items-center user-content box-shadow">
                        <span class="user-icon" style="color: #4f68d8;"><i class="fas fa-star"></i></span>
                        <span class="user-text text-black-50">Bestanden beoordeeld</span>
                        <span class="user-int text-grey" >{{ $rated }}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-3 mb-3 user-info-wrap">
                    <div class="d-flex flex-column justify-content-center align-items-center user-content box-shadow">
                        <span class="user-icon" style="color: #4f68d8;"><i class="fas fa-clock"></i></span>
                        <span class="user-text text-black-50">Nog nakijken</span>
                        <span class="user-int text-grey" >{{ $notRated }}</span>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-3 mb-3 user-info-wrap">
                    <div class="d-flex flex-column justify-content-center align-items-center user-content box-shadow">
                        <span class="user-icon" style="color: #4f68d8;"><i class="fas fa-calendar-plus"></i></span>
                        <span class="user-text text-black-50">Datum registratie</span>
                        <span class="user-int text-grey" >{{ date('d-m-Y', strtotime($user->created_at) ) }}</span>
                    </div>
                </div>
            </div>

            <div class="row mt-4 mb-5 ">
                <div class="col-md-12">

                    <div class="delete-wrap border-top-light">
                        <div class="info-delete text-right mt-4 mb-2">
                            <small>* Druk op de knop "Verwijderen" gebruiker te verwijderen</small>
                        </div>
                        <!-- roles clickable -->
                        <div class="feedback-wrap text-right">
                            <button type="button" class="btn btn-passed btn-danger btn-sm  btn-hover"
                                    data-toggle="modal" data-target="#deleteModal">Verwijderen</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade mt-lg-5 mt-md-5 mt-0 pt-lg-5 pt-md-5 mt-0" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="d-flex flex-lg-row flex-md-row flex-column w-100">
                                        <div class="d-flex modal-img ">
                                            <img src="{{ asset('img/tegels/warning.gif') }}" class="img-fluid z-depth-1 " alt="1">
                                        </div>
                                        <div class="d-flex flex-column w-100 p-4">
                                            <div class="modal-header-wrap">
                                                <h2 class="modal-title">Let op!</h2>
                                            </div>
                                            <div class="warning-body my-3">
                                                Weet je zeker dat je <span class="home-color-blue">{{ $user->name }} {{ $user->lastname }}</span>
                                                wilt verwijderen? Alle gegevens van deze persoon zullen permanent worden verwijderd. Het is daarna niet meer
                                                mogelijk om dit ongedaan te maken.
                                            </div>
                                            <div class="modal-ft my-1">
                                                <form action="{{ route('admin.users.delete-user', $user->id) }}" METHOD="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" class="btn btn-danger ml-0" value="Verwijderen"/>
                                                </form>
                                                <input type="button" class="btn-grey btn " data-dismiss="modal" value="Annuleren" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- rolesclickable -->
                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
