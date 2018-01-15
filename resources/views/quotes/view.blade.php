@extends('admin.dashboard')

@section('content')
<div class="container">
  <h2>Ini Adalah Beberapa Kutipan Yang Dibuat</h2>

  <!-- Menampilkan Pesan Berhasil Membuat Quotes -->
  @if(session('msg'))
      <div class="alert alert-success">
        <p> {{ session('msg') }}</p>
      </div>
  @endif

  @if(session('msg-warning'))
      <div class="alert alert-warning">
        <p> {{ session('msg-warning') }}</p>
      </div>
  @endif


  <p>Daftar Kutipan</p>
  <center>
    <a href="/quotes/random" class="btn btn-primary">Random Quotes</a>
    <br>
    <br>
    <hr>
  </center>
  <div class="row">
    @foreach ($quotes as $quote)
    <div class="col-md-4">
      <div class="thumbnail">
        <div class="caption">
          {{ $quote -> title }}
          <p><a href="/quotes/{{ $quote -> slug }}" class="btn btn-primary"> Lihat Lutipan </a></p>
          <p>Penulis : {{ $quote -> name }}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
