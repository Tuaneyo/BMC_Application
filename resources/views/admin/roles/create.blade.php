@extends("layouts.admin.main")
@section("content")

    @include('layouts.admin.nav', ['title' => 'Nieuwe rol', 'thumb' => 'mountain-top.jpg'])
    <div class="table-responsive container text-nowrap">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form class="border border-light p-5" method="post" action="{{ route('admin.roles.create') }}">
            @csrf
            @method("PATCH")
            <p class="h4 mb-4 text-center">Nieuwe rol</p>

            <input name="name" type="text" id="defaultRegisterFormFirstName" class="form-control" placeholder="Naam"
                   autocomplete="off"
                   style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%;">

            <p>Rechten</p>
        @foreach($permissions as $permission)
            <!-- Material unchecked -->
                <div class="form-check">
                        <input name="permissions[]" value="{{ $permission->name }}" type="checkbox" class="form-check-input" id="materialUnchecked">
                        <label class="form-check-label" for="materialUnchecked">{{ $permission->name }}</label>
                </div>
        @endforeach
        <!-- Basic dropdown -->
            <button class="btn btn-info my-4 btn-block" type="submit">Aanmaken</button>
        </form>
    </div>

@endsection
