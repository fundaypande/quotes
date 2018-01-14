@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <h1>Halaman Profile {{$user -> name}}</h1>

          <ul class="list-group">
            @foreach($user -> quotes as $quote)
              <a href="/quotes/{{ $quote -> slug }}"><li class="list-group-item"> {{ $quote -> title }} </li></a>
            @endforeach
          </ul>

    </div>
</div>
@endsection
