<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


//menggunakan Tabel atau Model apa
use App\User;
use App\Quote;
use App\Tag;
use Auth;
class QuoteController extends Controller
{
    public function index()
    {
        //with('tags') untuk mengurangi pengambilan data dari database secara loop
        $quotes = Quote::with('tags')
          ->with('user')
          ->get();
        return view('quotes.view', compact('quotes'));
    }


    public function home()
    {
        //
        $quotes = Quote::limit(6)
          ->orderBy('id', 'desc')
          ->get();
        $users = User::limit(4)
          ->orderBy('id', 'desc')
          ->get();
        return view('main.index', compact('quotes', 'users'));
    }

    public function dashboard(){
      return view('admin.dashboard');
    }

    public function create()
    {
        //fungsi untuk membuat quotes
        $tags = Tag::all();
        return view('quotes.create', compact('tags'));
    }

    public function validasiTag(Request $request){
      //mengghapus id tag 0 (tidak ada tag) dari array
      $request -> tags = array_diff($request -> tags, [0]);
      if(empty($request -> tags)){
        return false;
      }
      return true;
    }

    public function store(Request $request)
    {

      $validasi = new QuoteController;
      if($validasi -> validasiTag($request)){

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

          //untuk memasukkan array data ke database
          $quotes -> tags() -> attach( $request -> tags );

          return redirect('quotes')->with('msg', 'kutipan berhasil di submit');
        } else {
          //input() mengembalikan data user yang gagal di upload
          return redirect('/quotes/create')->withInput($request -> input())->with('tag_error', 'Tag Tidak Boleh Kosong');
        }
    }

    public function show($slug)
    {
        //
        $quote = Quote::with('comments.user')
          ->where('slug', $slug)
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
        $tags = Tag::all();
        return view ('quotes.edit', compact('quote', 'tags'));

    }

    public function update(Request $request, $id)
    {
      $validasi = new QuoteController;
      if($validasi -> validasiTag($request)){
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

          //untuk mengupdate data many to many antara tabel 'quotes' dan 'tags' dengan penghubung 'quote_tag'
          $quote -> tags() -> sync($request->tags);

          return redirect('quotes')->with('msg', 'kutipan berhasil di edit');

        } else abort(403);
      } else return redirect('/quotes/create')->withInput($request -> input())->with('tag_error', 'Tag Tidak Boleh Kosong');
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
