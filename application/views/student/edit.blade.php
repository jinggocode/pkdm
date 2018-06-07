@layout('layout/index')

@section('title')
	List Mahasiswa
@endsection

@section('content')
<form action="{{ site_url('student/update') }}" method="post">
{{ $csrf }} 

  <div class="form-group">
    <label for="NIM">NIM</label>
    {{ form_error('nim') }}
    <input value="{{ $student->nim }} " name="nim" type="text" class="form-control" id="NIM" placeholder="NIM">
  </div>
  <div class="form-group">
    <label for="Nama">Nama</label>
    <input value="{{ $student->nama }} " name="nama" type="text" class="form-control" id="Nama" placeholder="Nama">
  </div>
  <div class="form-group">
    <label for="Username">Username</label>
    <input value="{{ $student->username }} " name="username" type="text" class="form-control" id="Username" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="Gender">Gender</label>
    <select name="gender" class="form-control" id="Gender">
      <option value="">- Gender -</option>
      <option value="L" {{ ($student->gender == "L") ? 'selected' : '' }}>Laki - laki</option>
      <option value="P" {{ ($student->gender == "P") ? 'selected' : '' }}>Perempuan</option>
    </select> 
  </div>
  <div class="form-group">
    <label for="golongan_id">Golongan</label>
    <select name="golongan_id" class="form-control" id="golongan_id">
      <option value="">- Pilih Golongan -</option>
      
      @foreach($golongan as $data)
        <option value="{{ $data->id }}" {{ ($student->gedung_id == $data->id) ? 'selected' : '' }}>{{ $data->golongan }}</option>
      @endforeach
      
    </select> 
  </div>
  <div class="form-group">
    <label for="Address">Address</label>
    <textarea placeholder="Address" name="address" id="Address" class="form-control">{{ $student->address }} </textarea> 
  </div> 
  <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection