@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => $notification->title, 'thumb' => 'people.jpg'])
    <!-- Section: Blog v.1 -->
{{--        <!-- Grid row -->--}}
{{--        <div class="row">--}}

{{--            <!-- Grid column -->--}}
{{--                <div class="col-lg-7">--}}

{{--                    <!-- Post title -->--}}
{{--                    <h3 class="font-weight-bold mb-3"><strong>{{ $notification->title }}</strong></h3>--}}
{{--                    <!-- Excerpt -->--}}
{{--                    <p>--}}
{{--                        {{ str_limit($notification->body, $limit = 150, $end = '...') }}--}}
{{--                    </p>--}}
{{--                    <!-- Post data -->--}}
{{--                    <p>by <a><strong>Carine Fox</strong></a> op {{ date('d-m-Y', strtotime($notification->created_at)) }}</p>--}}
{{--                    <!-- Read more button -->--}}
{{--                    <a class="btn btn-success btn-md">Read more</a>--}}

{{--                </div>--}}
{{--                <!-- Grid column -->--}}

{{--        </div>--}}
<main>
    <div class="container">
        <div class="jumbotron">
            <p class="lead text-center">{{ $notification->body }}</p>
        </div>
        <h1>Reacties</h1>
        <hr class="my-4">
        <div class="card">
                <h5 class="card-header h5">Featured</h5>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#!" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection
