<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        "body", "user_id", 'post_id', 'type'
    ];

    public static $rules = [
        "body" => 'required',
        'user_id' => 'required'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
