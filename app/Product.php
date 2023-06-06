<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Stmt\Return_;

class Product extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    // một sản phẩm thì sẽ có nhiều hình ảnh
    public function ProductImage()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }
    public function Tags()
    {
        return $this->belongsToMany('App\Tag', 'product_tags', 'product_id', 'tag_id');
    }
    public function Category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
    public function Favorite(){
        return $this->belongsToMany('App\User','favorites','product_id','user_id');
    }
    public function Order(){
        return $this->belongsToMany('App\Order');
    }
    public function Comment()
    {
        return $this->hasMany('App\Comment','id');
    }
}
