<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function home()
    {
        return view('notifications.home');
    }
    /**
     * get all the posts
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllPosts()
    {
        $posts = Post::with('post_iamges')->orderBy('created_at', 'desc')->get();
        return response()->json(['error' => false, 'data' => $posts]);
    }

    public function createPost(Request $request)
    {
        $user = Auth::user();
        $body = $request->body;
        $image = $request->image;
        $request->validate(Post::$rules);
        $post = Post::create([
           'body' => $body,
            'user_id' => $user->id
        ]);

        $imagePath = Storage::disk('uploads')->put($user->email . '/posts/' . $post->id, $image);
        PostImage::create([
           'post_image_path' => '/posts/' . $imagePath,
           'post_id' => $post->id
        ]);

        return response()->json(['error' => false, 'data' => $post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
