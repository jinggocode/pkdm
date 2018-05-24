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
  <h2 class="box-title"><i class="fa fa-plus-square-o"></i> Edit Data</h2>
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
      <form class="form-horizontal" action="{{site_url('admin/mahasiswa/update')}}" method="post" enctype="multipart/form-data">
      {{$csrf}}
      {{form_hidden('id', $data->id);}}
      {{form_hidden('id_user', $data->id_user);}}

        <div class="form-group">
          <label for="nama" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-6">
            <input autofocus="autofocus" type="text" name="nama" class="form-control" value="{{$data->nama}}" id="nama">
          </div>
        </div>
        <div class="form-group">
          <label for="nim" class="col-sm-2 control-label">NIM</label>
          <div class="col-sm-6">
            <input autofocus="autofocus" type="text" name="nim" class="form-control" value="{{$data->nim}}" id="nim">
          </div>
        </div>
        <div class="form-group">
          <label for="id_angkatan" class="col-sm-2 control-label">Angkatan</label>
          <div class="col-sm-4">
            <select name="id_angkatan" id="id_angkatan" class="form-control select2">
              <option value="">- Pilih Angkatan -</option>
              @foreach ($angkatan as $row)
                <option {{($data->id_angkatan == $row->id)?'selected':''}} value="{{$row->id}}">{{$row->nama}} </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="id_kelas" class="col-sm-2 control-label">Kelas</label>
          <div class="col-sm-4">
            <select name="id_kelas" id="id_kelas" class="form-control select2">
              @foreach ($kelas as $value)
                <option {{($data->id_kelas == $value->id)?'selected':''}} value="{{$value->id}}">{{$value->prodi->nama}} - {{$value->nama}}</option>
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
