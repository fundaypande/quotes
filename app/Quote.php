<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{

    protected $fillable = [
      'title', 'slug', 'subject', 'user_id'
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }
}
