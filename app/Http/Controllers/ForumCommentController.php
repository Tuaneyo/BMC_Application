<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\NotifyUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ForumCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forum');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commented = [];

        $request->validate([
            'body' => 'required',
            'post_id' => 'required',
            'user_id' => 'required'
        ]);
        $comment = new Comment();
        $comment->title = ' ';
        $comment->body = $request->body;
        $comment->post_id = $request->post_id;
        $comment->user_id = $request->user_id;

        $post = Post::where('id', $request->post_id)->first();

        // create new notification in database
        //if((int)$post->user->id !== Auth::user()->id){
            //$commented->push(['post' => $post, 'commented' => User::where('id', $comment->user_id)->first()]);

            $user = User::where('id', $comment->user_id)->first();

            $post->user->notify(new NotifyUser($post, $user));
        //}

        //dd($user);
        $comment->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('forum.editComments', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->title = $request->title;
        $comment->body = $request->body;
        $comment->save();
        return redirect("/forum");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect("/forum");
    }
}
