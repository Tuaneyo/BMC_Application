<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $posts = Post::paginate(15);
            return view('forum.forum', compact('posts'));
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check()) {
            return view('forum.createPost');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);
            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->user_id = Auth::user()->id;
            $post->save();
            return redirect('/forum');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::check()) {
            $post = Post::where('id', $id)->get()->first();
            return view('forum.showPost', compact('post'));
        } else {
            return redirect('/login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id)->first();
        if (Auth::User()->id == $post->user_id) {
            return view('forum.editPost', compact('post'));

        } else {
            return redirect('/forum');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id)->first();

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return redirect('/forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect('/forum');
    }
}
