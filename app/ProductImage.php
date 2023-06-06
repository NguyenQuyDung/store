<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductImage extends Model
{
    use SoftDeletes;
    // cho tất cả các trường đc phép insert
    protected $guarded = [];
    public function Product()
    {
        return $this->belongsTo('App\Product', 'id');
    }
}
