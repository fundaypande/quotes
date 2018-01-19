<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class AdminController extends Controller
{
  public function __construct()
  {
      $this->middleware('admin');
  }

  public function index()
  {
    $users = User::where('approve', '0')->get();
    return view('adminDashboard', compact('users'));
  }

  public function update(Request $request, $id)
  {
    //membuat validasi

    $user = User::findOrFail($id);
    $user -> update([
      'approve' => '1'
    ]);
    return redirect('/admin')->with('msg', 'user berhasil di approve');
  }


}
