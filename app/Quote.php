<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use User;

class Quote extends Model
{

    protected $fillable = [
      'title', 'slug', 'subject', 'user_id'
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function comments(){
      return $this->hasMany('App\QuoteComment');
    }

    public function isOwner(){
      if(Auth::guest())
        return false;
      return Auth::user()->id == $this -> user -> id;
    }
}
