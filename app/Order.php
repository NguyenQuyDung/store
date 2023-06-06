<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    public function Customer(){
        return $this->hasMany('App\Customer');
    }
}
