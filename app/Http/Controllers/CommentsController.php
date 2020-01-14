<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\UserAssigment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class CommentsController extends Controller
{
    public function store(Request $request)
    {
        if($request->ajax()) {
            $request->validate(Comment::$rules);
            $dcArr = self::dCrypt($request->all());

            $post = self::checkPostType($request);
            $user = User::find($dcArr['inputs']['user_id']);
            // check correct post
            //dd($dcArr);
            if (isset($user) && Auth::user()->id === $user->id && isset($dcArr['obj'])) {
                $input = $dcArr['inputs'];
                $comment = new Comment();
                $comment->body = $input['body'];
                $comment->post_id = $input['post_id'];
                $comment->user_id = $input['user_id'];
                $comment->type = $dcArr['type'];
                $comment->save();
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    public static function checkPostType($req)
    {
        $postType = [];
        if(isset($req->post_id)){
            $postType['obj'] = Post::find($req->post_id);
            $postType['type'] = Post::class;
        }else if(isset($req->component_id)){
            $postType['obj'] = Component::find($req->component_id);
            $postType['type'] = Component::class;
        }
        return $postType;
    }

    public static function dCrypt($req)
    {
        $dCryptedArr = [];
        $user = $req['user_id'];

        $req['user_id'] = Crypt::decryptString($user);
        if(isset($req['post_id']) || !empty($req['post_id'])){
            $req['post_id'] = Crypt::decryptString($req['post_id']);
            $dCryptedArr['obj'] = Post::find($req['post_id']);
            $dCryptedArr['type'] = Post::class;
        }else if(isset($req['component_id']) || !empty($req['component_id'])){
            $req['component_id'] = Crypt::decryptString($req['component_id']);
            $dCryptedArr['obj'] = Component::find($req['component_id']);
            $dCryptedArr['type'] = UserAssigment::class;
            $req['post_id'] = $req['component_id'];
            unset($req['component_id']);
        }
        $dCryptedArr['inputs'] = $req;
        return $dCryptedArr;
    }

}
