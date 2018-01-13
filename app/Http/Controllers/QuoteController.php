<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//menggunakan Tabel atau Model apa
use App\User;
use App\Quote;
use Auth;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $quotes = Quote::
          join('users', 'users.id', '=', 'quotes.user_id')
          ->get();
        return view('quotes.view', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //fungsi untuk membuat quotes
        return view('quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //membuat validasi
        $this -> validate($request, [
          'title' => 'required|min:3',
          'subject' => 'required|min:5'
        ]);

        //membuat URL dengan title
        $slug = str_slug($request -> title, '-');

        //cek slug tidak duplikat
        if(Quote::where('slug', $slug) -> first() != null)
          $slug = $slug . '-' . time();

        $quotes = Quote::create([
          'title' => $request -> title,
          'slug' => $slug,
          'subject' => $request -> subject,
          'user_id' => Auth::user()->id
        ]);

        return redirect('quotes')->with('msg', 'kutipan berhasil di submit');
    }

    /**
     * Display the specified resource.
     *
     * @param  string slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //
        $quote = Quote::where('slug', $slug)
          ->join('users', 'users.id', '=', 'quotes.user_id')
          ->first();
        if(empty($quote)) abort(404);

        return view('quotes.single', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
