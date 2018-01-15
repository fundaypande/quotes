<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteComment extends Model
{
    //

    protected $fillable = [
      'id', 'subject', 'quote_id', 'user_id'
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function quote(){
      return $this->belongsTo('App\Quote');
    }
}
