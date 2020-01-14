@extends("layouts.admin.main")
@section("content")

    @include('layouts.admin.nav', ['title' => 'Gebruikers', 'thumb' => 'mountain-top.jpg'])
    <div class="table-responsive container text-nowrap">
        <form class="border border-light p-5" method="post" action="{{ route('admin.users.create') }}">
            @csrf
            <p class="h4 mb-4 text-center">Nieuwe gebruiker</p>

            <input name="name" type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Naam"
                   autocomplete="off"
                   style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">

            <input name="lastname" type="text" id="defaultRegisterFormLastName" class="form-control"
                   placeholder="Achternaam">

            <input name="email" type="email" id="defaultRegisterFormEmail" class="form-control mb-4"
                   placeholder="E-mail">

            <input name="password" type="password" id="defaultRegisterFormPassword" class="form-control"
                   placeholder="Wachtwoord"
                   aria-describedby="defaultRegisterFormPasswordHelpBlock" autocomplete="off"
                   style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">

            <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">Minimal 8 characters
                lenght
            </small>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="fileInput" aria-describedby="fileInput">
                    <label class="custom-file-label" for="fileInput">Profielfoto</label>
                </div>
            </div>
            <!-- Default checked -->
            <div class="custom-control custom-checkbox">
                <input name="active" type="checkbox" class="custom-control-input" id="defaultChecked2" checked>
                <label class="custom-control-label" for="defaultChecked2">Actief</label>
            </div>
            <p>Rol</p>
        @foreach($roles as $role)
            <!-- Material unchecked -->
                <div class="form-check">
                    <input name="roles[]" value="{{ $role->name }}" type="checkbox" class="form-check-input" id="materialUnchecked">
                    <label class="form-check-label" for="materialUnchecked">{{ $role->name }}</label>
                </div>
        @endforeach
        <!-- Basic dropdown -->
            <button class="btn btn-info my-4 btn-block" type="submit">Aanmaken</button>
        </form>
    </div>

@endsection
