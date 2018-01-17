@extends('admin.dashboard')

@section('content')
<div class="container">
  <h2>Edit Komentar Anda Pada Quote "{{ $comment -> quote -> title }}"</h2>
  <!-- Menampilkan Error dari hasil pengecekan di QuoteController -> Store() -->
  @if(count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
      </div>
  @endif

    <form class="" action="/comments/{{$comment -> id}}" method="POST">
        <div class="form-group">
          <label for="subject">Isi Komentar</label><br>
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <textarea name="subject" class="form-control" rows="8" cols="80" placeholder="komentar mu . . ."> {{ old('subject') ? old('subject') : $comment -> subject }} </textarea>
        </div>
        <button type="submit" name="button" class="btn btn-default">Edit Komentar</button>
    </form>
</div>
@endsection
