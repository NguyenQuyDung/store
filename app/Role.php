<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
  //
  use SoftDeletes;
  protected $guarded = [];
  public function permissions()
  {
    return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
  }
}
