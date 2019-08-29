<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
  protected $guarded = array('id');
  public static $rules = array(
    'groupid' => 'required',
    'participants' =>'required',
    'password' => 'required',
  );
}