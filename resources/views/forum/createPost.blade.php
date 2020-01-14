@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Forum Corner', 'thumb' => 'people.jpg'])
    <main class="pt-5 pb-5 mb-4 ">
        <div class="container-fluid px-lg-5 px-md-2 px-auto">
            <div class="row con-fluid-padding-top">
                <div class="container-fluid">
                    <form action="{{ route('storeForum') }}" method="post" class="md-form">
                        @csrf
                        @method('POST')
                        <input type="text" name="title" class="form-control mb-4" placeholder="Title">
                        <textarea name="body" id="" cols="120" rows="4" class="md-textarea"></textarea>
                        <br>
                        <button class="btn btn-primary" type="submit">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
