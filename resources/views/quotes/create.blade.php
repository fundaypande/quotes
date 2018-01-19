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


  @if(session('tag_error'))
    <div class="alert alert-danger">
      {{ session('tag_error') }}
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

        <div id="tag_wrapper">
          <label for="">Tag Maximal 3  :   </label>
          <button type="button" id="add_tag" class="btn btn-primary" name="button">Tambag Tag</button>

          <select class="" name="tags[]" id="tag_select">
            <option value="0"> Pilih Tag </option>
            @foreach($tags as $tag)
              <option value="{{ $tag -> id }}"> {{ $tag -> name }} </option>
            @endforeach
          </select>
        </div>
        <br>
        <br>

      <script src="{{ asset('js/tag.js') }}"></script>

        <button type="submit" name="button" class="btn btn-default">Submit Kutipan</button>

      {{ csrf_field() }}
    </form>
</div>
@endsection
