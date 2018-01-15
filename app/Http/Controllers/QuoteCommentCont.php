<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//menggunakan Tabel atau Model apa
use App\User;
use App\Quote;
use App\QuoteComment;
use Auth;
class QuoteCommentCont extends Controller
{

    public function store(Request $request, $id)
    {
      $quote = Quote::findOrFail($id);

       //membuat validasi
        $this -> validate($request, [
          'subject' => 'required|min:5'
        ]);

        $comment = QuoteComment::create([
          'subject' => $request -> subject,
          'user_id' => Auth::user()->id,
          'quote_id' => $id
        ]);
        return redirect('quotes/'.$quote -> slug)->with('msg', 'komentar berhasil di submit');
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
