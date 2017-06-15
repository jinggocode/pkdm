@layout('layout/index')

@section('title')
	Detail Mahasiswa
@endsection

@section('content')

<h1>Detail Mahasiswa : <b>{{ $student->nama }}</b></h1>

<table class="table">
  <tr>
    <td>NIM</td>
    <td>{{ $student->nim }}</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>{{ $student->nama }}</td>
  </tr>
  <tr>
    <td>Username</td>
    <td>{{ $student->username }}</td>
  </tr>
  <tr>
    <td>Gender</td>
    <td>{{ $student->gender }}</td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>{{ $student->address }}</td>
  </tr>
  <tr>
    <td>Golongan</td>
    <td>{{ $student->golongan->golongan }}</td>
  </tr>
</table>

<a href="{{ site_url('student') }}" class="btn btn-primary">Kembali</a>

@endsection