@layout('_layout/admin/index')

@section('title')Data Kelas@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tambah Data Kelas
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box box-success">
  <div class="box-header with-border"> 
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
      <form class="form-horizontal" action="{{site_url('admin/master/kelas/save')}}" method="post" enctype="multipart/form-data">
      {{$csrf}}
        <div class="form-group">
          <label for="nama" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-6">
            <input type="text" name="nama" class="form-control" value="{{set_value('nama')}}" id="nama">
          </div>
        </div>   
        <div class="form-group">
          <label for="no_telp" class="col-sm-2 control-label">Program Studi</label>
          <div class="col-sm-4">
            <select name="id_prodi" id="id_prodi" class="form-control">
              <option value="">--Pilih Program Studi--</option>
              @foreach ($prodi as $row)
                <option {{($row->id == set_value('id_prodi')?'selected':'')}} value="{{$row->id}}">{{$row->nama}}</option>
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