@layout('_layout/admin/index')

@section('title')Data Mahasiswa@endsection

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{base_url('assets/admin/')}}bower_components/select2/dist/css/select2.min.css">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Mahasiswa
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box box-success">
  <div class="box-header with-border">
  <h2 class="box-title"><i class="fa fa-plus-square-o"></i> Tambah Data</h2>
  </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-6 col-lg-12">
          <!-- form alert -->
          @if (!empty(validation_errors()))
          <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h4><strong>Peringatan</strong></h4>
            <p>{{validation_errors()}}</p>
          </div>
          @endif
        </div>
        <!-- end form alert -->
      </div>
      <form class="form-horizontal" action="{{site_url('admin/mahasiswa/save')}}" method="post" enctype="multipart/form-data">
      {{$csrf}}
        <div class="form-group">
          <label for="nama" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-6">
            <input autofocus="autofocus" type="text" name="nama" class="form-control" value="{{set_value('nama')}}" id="nama">
          </div>
        </div>
        <div class="form-group">
          <label for="nim" class="col-sm-2 control-label">NIM</label>
          <div class="col-sm-6">
            <input autofocus="autofocus" type="text" name="nim" class="form-control" value="{{set_value('nim')}}" id="nim">
          </div>
        </div>
        <div class="form-group">
          <label for="id_prodi" class="col-sm-2 control-label">Program Studi</label>
          <div class="col-sm-4">
            <select name="id_prodi" id="id_prodi" class="form-control">
              <option value="">- Pilih Program Studi -</option>
              @foreach ($prodi as $value)
                <option {{(set_value('id_prodi') == $value->id)?'selected':''}} value="{{$value->id}}">{{$value->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="id_kelas" class="col-sm-2 control-label">Kelas</label>
          <div class="col-sm-4">
            <select name="id_kelas" id="id_kelas" class="form-control">
              <option value="">- Pilih Kelas -</option>
              @foreach ($kelas as $value)
                <option {{(set_value('id_kelas') == $value->id)?'selected':''}} value="{{$value->id}}">{{$value->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="id_angkatan" class="col-sm-2 control-label">Angkatan</label>
          <div class="col-sm-4">
            <select name="id_angkatan" id="id_angkatan" class="form-control">
              <option value="">- Pilih Angkatan -</option>
              @foreach ($angkatan as $row)
                <option {{(set_value('id_angkatan') == $row->id)?'selected':''}} value="{{$row->id}}">{{$row->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection

@section('script')
<script src="{{base_url('assets/js/money.js')}}"></script>
<!-- CK Editor -->
<script type="text/javascript">

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endsection
