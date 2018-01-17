<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class QuoteComment extends Model
{
    //

    protected $fillable = [
      'subject', 'quote_id', 'user_id'
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function quote(){
      return $this->belongsTo('App\Quote');
    }

    public function isOwner(){
      if(Auth::guest())
        return false;
      return Auth::user()->id == $this -> user -> id;
    }
}
