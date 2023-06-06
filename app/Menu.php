<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Menu extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    public function menuChildren(){
        return $this->hasMany('App\Menu','parent_id');
    }
}
