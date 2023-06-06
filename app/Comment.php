<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    public function Product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
    function ReplyComment()
    {
        return $this->hasMany('App\ReplyComment');
    }
}
