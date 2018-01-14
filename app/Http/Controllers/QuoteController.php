<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//menggunakan Tabel atau Model apa
use App\User;
use App\Quote;
use Auth;
class QuoteController extends Controller
{
    public function index()
    {
        //
        $quotes = Quote::
          join('users', 'users.id', '=', 'quotes.user_id')
          ->get();
        return view('quotes.view', compact('quotes'));
    }

    public function create()
    {
        //fungsi untuk membuat quotes
        return view('quotes.create');
    }

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

    public function show($slug)
    {
        //
        $quote = Quote::where('slug', $slug)
          //->join('users', 'users.id', '=', 'quotes.user_id')
          ->first();
        if(empty($quote)) abort(404);
        return view('quotes.single', compact('quote'));
    }

    public function random()
    {
        $quote = Quote::inRandomOrder()
          //->join('users', 'users.id', '=', 'quotes.user_id')
          ->first();
        if(empty($quote)) abort(404);
        return view('quotes.single', compact('quote'));
    }

    public function edit($id)
    {
      $quote = Quote::where('slug', $id)->first();
      return view ('quotes.edit', compact('quote'));
    }

    public function update(Request $request, $id)
    {
      //membuat validasi
       $this -> validate($request, [
         'title' => 'required|min:3',
         'subject' => 'required|min:5'
       ]);

      $quote = Quote::where('slug', $id)->first();
      if($quote -> isOwner()){
        $quote -> update([
          'title' => $request -> title,
          'subject' => $request -> subject
        ]);
        return redirect('quotes')->with('msg', 'kutipan berhasil di edit');
      } else abort(403);
    }

    public function destroy($id)
    {
      //die('masuk');
        $quote = Quote::findOrFail($id);
        if($quote -> isOwner()){
          $quote -> delete();
        }else abort(403);

        return redirect('quotes')->with('msg', 'kutipan berhasil di hapus');
    }
}
