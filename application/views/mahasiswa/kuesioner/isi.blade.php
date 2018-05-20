@layout('_layout/mahasiswa/index')

@section('title')Isi Kuisioner@endsection

@section('content')
<div class="box box-default">
  <div class="box-header with-border">
    <a href="{{site_url('mahasiswa/homepage')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
  <div class="box-body">
    <div style="padding-bottom: 2px">
      <table class="table table-striped" style="width: 40%">
        <tr>
          <td>Nama Mata Kuliah</td>
          <td><b>{{($data->makul->jenis == '0')?'TEORI':'PRAKTEK'}} {{$data->makul->nama}}</b></td>
        </tr>
        <tr>
          <td>Nama Dosen</td>
          <td><b>{{$data->dosen->nama}}</b></td>
        </tr>
        <tr>
          <td>Semester</td>
          <td><b>{{$data->makul->semester}}</b></td>
        </tr>
      </table>
    </div>

    <form action="{{site_url('mahasiswa/kuesioner/save')}}" method="post">
    {{$csrf}}
    {{form_hidden('id_dosen', $data->dosen->id)}}
    {{form_hidden('id_pengampu', $data->id)}}

      @foreach ($kategori as $value)
      <div class="box box-success box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">{{$value->kategori->nama}}</h3>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.box-header -->

        <?php $pertanyaan = $this->kuesioner_model->where('id_kategori', $value->id_kategori)->get_all(); ?>

        @foreach ($pertanyaan as $row)
        <div class="box-body">
          <h5 class="card-title"><p>{{$row->isi}}</p></h5>
          <div style="padding-left: 18px">
            <label for="kurang {{$row->id}}">
            <input required="required" type="radio" name="{{$row->id}}" id="kurang {{$row->id}}" value="1" style="transform: scale(1.3);"> <span style="margin-right: 20px;">Kurang</span>
            </label>
            <label for="cukup {{$row->id}}">
            <input required="required" type="radio" name="{{$row->id}}" id="cukup {{$row->id}}" value="2" style="transform: scale(1.3);"> <span style="margin-right: 20px">Cukup</span>
            </label>
            <label for="baik {{$row->id}}">
            <input required="required" type="radio" name="{{$row->id}}" id="baik {{$row->id}}" value="3" style="transform: scale(1.3);"> <span style="margin-right: 20px">Baik</span>
            </label>
            <label for="sangatBaik {{$row->id}}">
            <input required="required" type="radio" name="{{$row->id}}" id="sangatBaik {{$row->id}}" value="4" style="transform: scale(1.3);"> <span style="margin-right: 20px">Sangat Baik</span>
            </label>
          </div>
        </div>
        @endforeach
        <!-- /.box-body -->
      </div>
      @endforeach

      <div align="center">
        <button type="submit" class="btn btn-primary"><i class="fa fa-external-link"></i> Submit</button>
        <a href="{{site_url('mahasiswa')}}" class="btn btn-warning"><i class="fa fa-close"></i> Batal</a>
      </div>
    </form>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
