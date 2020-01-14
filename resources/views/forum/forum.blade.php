@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Forum Corner', 'thumb' => 'people.jpg'])
    <div class="card-body card-body-cascade text-center">
        <!-- Title -->
        {{--<h4 class="card-title"><strong>Create a new forum post</strong></h4>--}}
        <h2 class="header-text text-black-50" style="text-shadow: unset; margin-top: 0.5em">
            <strong><i class="far fa-comments"></i> Create a new post:</strong>
        </h2>
        <a href="{{ route('createForum') }}" class="btn btn-primary">Create</a>

        </p>
    </div>
    <main class="pt-5 pb-5 mb-4 ">
        <div class="container-fluid px-lg-5 px-md-2 px-auto">
            <ul class="list-group">
                @foreach($posts as $post)
                    <a href="{{ route('showForum', $post->id) }}">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Titel: {{$post->title}}
                            <span class="badge badge-primary badge-pill" style="font-size: .9em"><i
                                    class="far fa-comment"></i> {{count($post->comments)}}</span>
                        </li>
                    </a>
                @endforeach
            </ul>
            <br>
            {{ $posts->links() }}
        </div>
    </main>

@endsection
