<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAssigment extends Model
{
    protected $table = "assignments";
    protected $fillable = [
        "user_id", "component_id", "file1", "rated", "feedback"
    ];

    public static $rules = [
        'fassigment' => 'required|mimes:jpeg,png,jpg,doc,docx,xlsx,xls,zip,pdf|max:20480'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function component()
    {
        return $this->belongsTo('App\Models\Component', 'component_id', 'id');
    }


    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'component_id');
    }

    public function getComments()
    {
        return $this->comments()->where("type", UserAssigment::class);
    }

    public function files()
    {
        return $this->where('rated', '=', 0);
    }

}
