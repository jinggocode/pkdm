@layout('_layout/admin/index')

@section('title')Data Pertanyaan Kuesioner @endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Data Pertanyaan Kuesioner
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
      <form class="form-horizontal" action="{{site_url('admin/kuesioner/pertanyaan/update')}}" method="post" enctype="multipart/form-data">
      {{$csrf}}
      {{form_hidden('id', $data->id)}}

        <div class="form-group">
          <label for="no_telp" class="col-sm-2 control-label">Kategori Kuesioner</label>
          <div class="col-sm-4">
            <select required name="id_kategori" id="id_kategori" class="form-control">
              <option value="">--Pilih Kategori Kuesioner--</option>
              @foreach ($kategori as $row)
                <option {{($row->id == $data->id_kategori)?'selected':''}} value="{{$row->id}}">{{$row->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="jenis_jawaban" class="col-sm-2 control-label">Jenis Jawaban Pertanyaan</label>
          <div class="col-sm-6">
            <select required name="jenis_jawaban" id="jenis_jawaban" class="form-control">
              <option value="">--Pilih Jenis Jawaban Pertanyaan--</option>
              <option {{('0' == $data->jenis_jawaban)?'selected':''}} value="0">Ya / Tidak</option>
              <option {{('1' == $data->jenis_jawaban)?'selected':''}} value="1">Kepuasan</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="jenis" class="col-sm-2 control-label">Jenis Pertanyaan</label>
          <div class="col-sm-6">
            <select required name="jenis" id="jenis" class="form-control">
              <option value="">--Pilih Jenis Pertanyaan--</option>
              <option {{('0' == $data->jenis)?'selected':''}} value="0">TEORI</option>
              <option {{('1' == $data->jenis)?'selected':''}} value="1">PRAKTIKUM</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="isi" class="col-sm-2 control-label">Isi Pertanyaan</label>
          <div class="col-sm-6">
            <input type="text" name="isi" class="form-control" value="{{$data->isi}}" id="isi">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection
