@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Nieuws', 'thumb' => 'people.jpg'])
    <main class="pt-3 ">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <create-post />
                </div>
                <div class="col-md-6">
                    <all-posts />
                </div>
            </div>
        </div>
    </main>


@endsection
