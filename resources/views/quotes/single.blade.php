@extends('layouts.app')

@section('content')
<div class="container">
  <h2> {{ $quote -> title }} </h2>
  <p>penulis : {{ $quote -> name }} - time : {{ $quote -> created_at }}</p>
  <hr>
  <p>{{ $quote -> subject }}</p>

  <!-- Menampilkan Error dari hasil pengecekan di QuoteController -> Store() -->

</div>
@endsection
