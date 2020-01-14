<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Post;
use App\Models\User;
use App\Models\UserAssigment;
use App\Notifications\NewsNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;

class NewsController extends Controller
{
    public function index()
    {

        $news = new \Illuminate\Database\Eloquent\Collection;
        $user = Auth::user();
        $posts = Post::where('user_id', $user->id)->with(['publisher', 'getComments'])->get();
        $rated = UserAssigment::where([['user_id', $user->id],['rated', 2]])
            ->orWhere([['rated', 1], ['user_id', $user->id]])->with(['component', 'user', 'comments'])->get();

        //dd($posts[0]->getComments->count());
        $news = $news->merge($rated);
        $news = $news->merge($posts);
        $news = $news->sortByDesc('updated_at');
        $unrated = UserAssigment::where([['user_id', $user->id],['rated', 0]])->with('component')->get();
        $component = Component::all();

        return view('dashboard.news.index', compact('user', 'news', 'unrated', 'component'));
    }

    /**
     * @param Request $request
     * @return
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $data = [];
            $inputs = $request->all();

            $inputs['user_id'] = Crypt::decryptString($request->user_id);
            $inputs['publisher_id'] = Crypt::decryptString($request->publisher_id );
            $request->validate(Post::$rules);
            $post = Post::create($inputs);
            if($post){
                $fields = ['id', 'name', 'lastname', 'file'];
                $user = User::find($post->user_id, $fields);
                $data['user'] = $user;
                $data['publisher'] = User::find($post->publisher_id, $fields);
                $data['post'] = $post;
                $data['user_id'] = Crypt::encryptString($user->id);
                $data['post_id'] = Crypt::encryptString($post->id);
                if(Auth::user()->hasRole(['administrator', 'docent'])){
                    $users = User::role('student')->get();
                    Notification::send($users, new NewsNotify(Auth::user(), $post->body));
                }
                return $data;
            }
            return  $request->all();

        }
    }

}
