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

    public function edit($id)
    {
      $comment = QuoteComment::findOrFail($id);
      return view ('comments.edit', compact('comment'));
    }


    public function update(Request $request, $id)
    {
      //membuat validasi
       $this -> validate($request, [
         'subject' => 'required|min:5'
       ]);

      $comment = QuoteComment::findOrFail($id);
      if($comment -> isOwner()){
        $comment -> update([
          'subject' => $request -> subject
        ]);
        return redirect('/quotes/'.$comment -> quote -> slug)->with('msg', 'komentar berhasil di edit');
      } else abort(403);
    }


    public function destroy($id)
    {
      //die('masuk');
        $comment = QuoteComment::findOrFail($id);
        if($comment -> isOwner()){
          $comment -> delete();
        }else abort(403);

        return redirect('/quotes/'.$comment -> quote -> slug)->with('msg', 'komentar berhasil di hapus');
    }
}
