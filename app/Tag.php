<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function quotes(){
      return $this->belongsToMany('App\Quote');
    }
}
