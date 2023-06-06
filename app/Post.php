<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    public function CategoryPost(){
        return $this->belongsTo('App\CategoryPost','category_id');
    }
}
