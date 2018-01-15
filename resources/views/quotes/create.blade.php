@extends('admin.dashboard')

@section('content')
<div class="container">
  <h2>Submit Kutipan Anda Disini</h2>
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


    <form class="" action="/quotes" method="POST">
      <div class="form-group">
        <label for="title"> Judul </label>
        <input type="text" class="form-control" placeholder="judul" name="title" value="{{ old('title') }}">
      </div>
        <div class="form-group">
          <label for="subject">Isi Kutipan</label><br>
          <textarea name="subject" class="form-control" rows="8" cols="80" placeholder="kutipan mu . . ."> {{ old('subject') }} </textarea>
        </div>

        <button type="submit" name="button" class="btn btn-default">Submit Kutipan</button>

      {{ csrf_field() }}
    </form>
</div>
@endsection
