<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        "body", "user_id", "publisher_id"
    ];

    public static $rules = [
        'body' => 'required',
        'user_id' => 'required',
        'publisher_id' => 'required'
    ];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }

    public function getComments()
    {
        return $this->comments()->where("type", Post::class);
    }

    public function post_images()
    {
        return $this->hasOne(PostImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commented($id)
    {
        return Comment::where('id', $id)->first();
    }

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id', 'id');
    }
}
