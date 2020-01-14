<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentDescription extends Model
{
    protected $table = 'assignments_description';
    protected $fillable = [
        "component_id", "description"
    ];


    public function Component()
    {
        return $this->belongsTo('App\Models\Component');
    }


    public static $rules = [
        'component_id' => 'required',
        'description' => 'required'
    ];
}
