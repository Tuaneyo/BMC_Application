<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Component extends Model
{
    protected $fillable = [
        "name", "thumb"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignment()
    {
        return $this->hasMany('App\Models\UserAssigment', 'component_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function AssignmentDesc()
    {
        return $this->hasMany('App\Models\AssignmentDescription', 'component_id', 'id');
    }







}
