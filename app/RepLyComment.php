<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepLyComment extends Model
{
    protected $guarded = [];
    function Comment()
    {
        return $this->belongsTo('App\Comment');
    }
}
