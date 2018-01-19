@extends('admin.dashboard')

@section('content')
<div class="container">
    <div class="row">
      <h1>Selamat Datang Di Halaman Admin Dashboard</h1>
    </div>
    <br>
    <h3>Daftar User Yang Menunggu Persetujuan Anda</h3>
    @if(session('msg'))
        <div class="alert alert-success">
          <p> {{ session('msg') }}</p>
        </div>
    @endif
    <div class="">
      <table class="table">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $key => $user)
            <tr>
              <td>{{++$key}}</td>
              <td>{{ $user -> name }}</td>
              <td>{{ $user -> email }}</td>
              <td>
                <form class="delete" action="/admin/approve/{{ $user -> id }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" name="button" class="btn btn-primary">Approve</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <script>
    $(".delete").on("submit", function(){
        return confirm("Apakah anda yakin ingin menyetujui sebagai member?");
    });
      </script>

      </ul>
    </div>
</div>
@endsection
