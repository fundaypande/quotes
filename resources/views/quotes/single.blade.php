@extends('layouts.app')

@section('content')
<div class="container">
  <h2> {{ $quote -> title }} </h2>
  <p>penulis : <a href="/profile/{{ $quote -> user -> id }}">{{ $quote -> user -> name }}</a> - time : {{ $quote -> created_at }}</p>
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
  @else
    bodo
  @endif
  <br>
  <hr>
  <a href="/quotes">Kembali Ke Quotes</a>
</div>
@endsection
