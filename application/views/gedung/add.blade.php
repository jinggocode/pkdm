@layout('layout/index')

@section('title')
	List Mahasiswa
@endsection

@section('content')
<form action="{{ site_url('student/save') }}" method="post">
{{ $csrf }}
  <div class="form-group">
    <label for="NIM">NIM</label>
    {{ form_error('nim') }}
    <input value="{{ (isset($student['nim'])) ? $student['nim'] : '' }}" name="nim" type="text" class="form-control" id="NIM" placeholder="NIM">
  </div>
  <div class="form-group">
    <label for="Nama">Nama</label>
    <input value="{{ (isset($student['nama'])) ? $student['nama'] : '' }}" name="nama" type="text" class="form-control" id="Nama" placeholder="Nama">
  </div>
  <div class="form-group">
    <label for="Username">Username</label>
    <input value="{{ (isset($student['username'])) ? $student['username'] : '' }}" name="username" type="text" class="form-control" id="Username" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="Gender">Gender</label>
    <select name="gender"  class="form-control" id="Gender">
    	<option value="">- Gender -</option>
    	<option value="L">Laki - laki</option>
    	<option value="P">Perempuan</option>
    </select> 
  </div>
  <div class="form-group">
    <label for="Address">Address</label>
    <textarea placeholder="Address" name="address" id="Address" class="form-control"> {{ (isset($student['address'])) ? $student['address'] : '' }}</textarea> 
  </div>
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection