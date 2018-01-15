<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Quote;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function profile($id = null){
      if($id == null){
        $user = User::findOrFail(Auth::User() -> id);
      } else {
        $user = User::findOrFail($id);
      }

      return view('profile', compact('user'));
    }

    public function template(){
      return view('main.index');
    }

}
