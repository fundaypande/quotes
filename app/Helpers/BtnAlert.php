<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class BtnAlert extends Controller
{
    public static function($id){
      return view('alert.delete')->render();
    }
}
