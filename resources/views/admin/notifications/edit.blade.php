@extends("layouts.admin.main")
@section("content")
    @include('layouts.admin.nav', ['title' => 'Nieuw bericht', 'thumb' => 'mountain-top.jpg'])
    <div class="container text-nowrap">
        <form action="{{ route('admin.notifications.edit', $notification->id) }}) }}" method="post">
            @csrf
            <label for="textarea-char-counter">Titel</label>
            <input type="text" class="form-control" name="title">

            <label for="textarea-char-counter">Bericht</label>
            <textarea name="message" class="form-control md-textarea" id="" cols="30" rows="10"></textarea>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFileLang" lang="es">
                <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
            </div>
            <button type="submit" class="btn btn-primary">Aanmaken</button>
        </form>
    </div>
@endsection
