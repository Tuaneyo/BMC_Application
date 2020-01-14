<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    private $default_image = "https://via.placeholder.com/256";


    public function getMessageImage() {
        if(\Storage::disk('feed_image')->exists($this->avatar)){
            return \Storage::disk('feed_image')->url($this->avatar);
        }
        else{
            return $this->default_image;
        }
    }
}
