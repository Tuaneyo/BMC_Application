@extends("layouts.dashboard.main")
@section("content")
    @include('layouts.dashboard.nav', ['title' => 'Forum Corner', 'thumb' => 'people.jpg'])
    <main class="pt-5 pb-5 mb-4 ">
        <div class="container-fluid px-lg-5 px-md-2 px-auto">
            <div class="row con-fluid-padding-top">
                <div class="container-fluid">
                    <form action="{{route('updateForum', $post->id)}}" method="post" class="md-form">
                        {{csrf_field()}}
                        {{ method_field('PATCH') }}
                        <input type="text" name="title" class="form-control mb-4" value="{{$post->title}}"
                               placeholder="Title">
                        <textarea name="body" id="" cols="120" rows="4" class="md-textarea">{{$post->body}}</textarea>
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <br>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
                <div class="container-fluid">
                    <form action="{{ route('deleteForum', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-amber">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection
