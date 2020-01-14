@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Show a post', 'thumb' => 'people.jpg'])
    <main class="pt-5 pb-5 mb-4 ">
        <div class="container-fluid px-lg-5 px-md-2 px-auto">
            <div class="row con-fluid-padding-top">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            Forum post
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">{{$post->title}}</h2>
                            <h5 class="card-text">{{$post->body}}</h5>
                            @if(Auth::user()->id == $post->user_id)
                                <a href="{{ route('editForum', $post->id) }}" class="btn btn-primary">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="container-fluid" style="margin-top: 1.5em">
                    <form action="{{ route('comment') }}" method="post" class="md-form">
                        @csrf
                        @method('POST')
                        <div class="card">
                            <div class="card-body">
                                <div class="input-group">


                                    <div class="md-form input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text md-addon"><i class="far fa-comments"
                                                                                       style="font-size: 2em"></i></span>
                                        </div>
                                        <textarea class="md-textarea form-control" name="body"
                                                  aria-label="With textarea"></textarea>
                                    </div>

                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                    <button type="submit" class="btn btn-primary" style="color: white;">Submit Comment
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <br>
                <br>

                @if(count($post->comments) >= 1)
                    <h2 class="header-text text-black-50" style="text-shadow: unset; margin-top: 2em">
                        <strong><i class="far fa-comments"></i> Comments:</strong>
                    </h2>
                @endif

                @foreach($post->comments->reverse() as $comment)
                    <?php
                    $commenter = \App\Models\User::find($comment->user_id)
                    ?>
                    <br>
                    <div class="container-fluid" style="margin-top: 1em">
                        <div class="card">
                            <div class="card-body">
                                <div class="input-group">
                                    <strong> {{$commenter->name}}:</strong> &nbsp{{$comment->title}}
                                    <br>
                                    {{$comment->body}}
                                    <br>
                                    @if(Auth::user()->id == $comment->user_id)
                                        <a href="{{ route('editComment', $comment->id) }}"
                                           class="btn btn-primary">Edit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        </div>
    </main>


@endsection
