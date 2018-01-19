@extends('main.post')

@section('content')
<div class="container">
  <h2> {{ $quote -> title }} </h2>
  <p>penulis : <a href="/profile/{{ $quote -> user -> id }}">{{ $quote -> user -> name }}</a> - time : {{ $quote -> created_at }}</p>
  <p>tag :
    @foreach($quote -> tags as $taga)
      <span>{{ $taga -> name }}</span>
    @endforeach
  </p>
  <hr>

  <p>{{ $quote -> subject }}</p>
  <br>
  <hr>


  <!--
  ** mengecek apakah postingan ini milik user yang login
  ** sehingga dapat mengedit dan mendelete postingannya sendiri
  ** isOwner() adalah function yang di buat di model Quote.php
  -->
  @if($quote -> isOwner())
    <a href="/quotes/{{ $quote -> slug }}/edit" class="btn btn-primary">Edit</a>
    <form method="POST" action="/quotes/{{ $quote -> id }}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="DELETE">
      <button type="submit" class="btn btn-danger" name="button">Hapus</button>
    </form>
  @endif
  <br>
  <hr>
  <a href="/quotes">Kembali Ke Quotes</a>
  <br><br><hr>

  <div class="comment">
    <h4>Daftar Komentar</h4>
    @if(session('msg'))
        <div class="alert alert-success">
          <p> {{ session('msg') }}</p>
        </div>
    @endif
    <!-- menampilkan komentar -->
    @foreach($quote -> comments as $comment)
      <p>{{ $comment -> subject }}</p>
      @if( $quote -> user_id == $comment -> user_id )
        <p><label for="">Moderator</label> : <a href="/profile/{{ $comment -> user -> id }}">{{ $comment -> user -> name }}</a></p>
      @else
        <p>Komentator : <a href="/profile/{{ $comment -> user -> id }}">{{ $comment -> user -> name }}</a></p>
      @endif

      <!-- update edit komentar -->
      @if($comment -> isOwner())
        <a href="/comments/{{ $comment -> id }}/edit" class="btn btn-primary">Edit</a>
        <form method="POST" action="/comments/{{ $comment -> id }}">
          {{ csrf_field() }}
          <input type="hidden" name="_method" value="DELETE">
          <button type="submit" class="btn btn-danger" name="button">Hapus</button>
        </form>
      @endif
      <hr>
    @endforeach

    @if(count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="/comments/{{$quote -> id}}">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="subject">Isi Komentar</label><br>
        <textarea name="subject" class="form-control" rows="8" cols="80" placeholder="komentar mu . . ."> {{ old('subject') }} </textarea>
      </div>
      <button type="submit" class="btn btn-primary" name="button">Kirim</button>
    </form>
  </div>
</div>
@endsection
