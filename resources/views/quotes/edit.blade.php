@extends('admin.dashboard')

@section('content')
<script src="{{ asset('js/tag.js') }}"></script>
<div class="container">
  <h2>Edit Kutipan Anda Disini</h2>

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

    <form class="" action="/quotes/{{ $quote -> slug }}" method="POST">
      <div class="form-group">
        <label for="title"> Judul </label>
        <input type="text" class="form-control" placeholder="judul" name="title" value="{{ old('title') ? old('title') : $quote -> title }}">
      </div>
        <div class="form-group">
          <label for="subject">Isi Kutipan</label><br>
          <textarea name="subject" class="form-control" rows="8" cols="80" placeholder="kutipan mu . . ."> {{ old('subject') ? old('subject') : $quote -> subject }} </textarea>
        </div>

        <div id="tag_wrapper">
          <label for="">Tag Maximal 3  :   </label>
          <button type="button" id="add_tag" class="btn btn-primary" name="button">Tambag Tag</button>

          @if(count($quote -> tags) == 0)
          <select class="" name="tags[]" id="tag_select">
            <option value="0"> Pilih Tag </option>
            @foreach($tags as $tag)
              <option value="{{ $tag -> id }}"> {{ $tag -> name }} </option>
            @endforeach
          </select>
          @else
            @foreach($quote -> tags as $oldTag)
              <select class="" name="tags[]" id="tag_select">
                <option value="0"> Pilih Tag </option>
                @foreach($tags as $tag)
                  <option
                      @if($oldTag -> id == $tag -> id)
                        selected="selected"
                      @endif
                   value="{{ $tag -> id }}"> {{ $tag -> name }} </option>
                @endforeach
              </select>
            @endforeach
          @endif
        </div>
        <br>
        <br>

        <button type="submit" name="button" class="btn btn-default">Edit Kutipan</button>

      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PUT">
    </form>
</div>
@endsection
