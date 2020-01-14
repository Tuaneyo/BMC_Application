@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Forum Corner', 'thumb' => 'people.jpg'])
    <main class="pt-5 pb-5 mb-4 ">
        <div class="container-fluid px-lg-5 px-md-2 px-auto">
            <div class="row con-fluid-padding-top">
                <div class="container-fluid">
                    <form action="{{route('updateComment',['id' => $comment->id])}}" method="post" class="md-form">
                        {{csrf_field()}}
                        {{ method_field('PATCH') }}
                        <textarea name="body" id="" cols="60" rows="4" class="md-textarea">{{$comment->body}}</textarea>
                        <input hidden value="" name="user_id">
                        <br>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
                <div class="container-fluid">
                    <form action="{{ route('deleteComment', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-amber">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
