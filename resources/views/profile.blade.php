@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="row">
      @if(session('msg-warning'))
          <div class="alert alert-warning">
            <p> {{ session('msg-warning') }}</p>
          </div>
      @endif
      <h1>Halaman Profile {{$user -> name}}</h1>
      @if(($user -> approve) == '0')
      <div class="alert alert-warning">
        <p> Maaf Anda Belum DiSetujui Sebagai Member - Anda Belum Bisa Membuat Quote</p>
      </div>
      @endif
          <ul class="list-group">
            @foreach($user -> quotes as $quote)
              <a href="/quotes/{{ $quote -> slug }}"><li class="list-group-item"> {{ $quote -> title }} </li></a>
            @endforeach
          </ul>
    </div>
</div>
@endsection
