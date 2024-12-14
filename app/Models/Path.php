<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Path extends Model
{
    function course ()
    {
        return $this->belongsTo('App\Models\Courses');
    }

    function lesson ()
    {
        return $this->hasMany('App\Models\Lessons');
    }
}
