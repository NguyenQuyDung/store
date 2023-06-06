<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoryPost extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    public function Post(){
        return $this->hasMany('App\Post');
    }
}
