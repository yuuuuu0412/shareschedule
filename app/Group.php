<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
      'name' => 'required',
      'password' => 'required',
      'adminid' => 'required',
    );
    public function posts()
    {
      return $this->hasMany('App\Post');
    }

}
