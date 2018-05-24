@layout('_layout/admin/index')

@section('title')Data Periode@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Data Periode
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
      <form class="form-horizontal" action="{{site_url('admin/master/periode/update')}}" method="post" enctype="multipart/form-data">
      {{$csrf}}
      {{form_hidden('id', $data->id);}}

        <div class="form-group">
          <label for="semester" class="col-sm-2 control-label">Semester</label>
          <div class="col-sm-3">
            <select name="semester" id="semester" class="form-control">
              <option value="">-Pilih Semester-</option>
              <option {{($data->semester == '1')?'selected':''}} value="1">Ganjil</option>
              <option {{($data->semester == '2')?'selected':''}} value="2">Genap</option>
            </select>
          </div>
        </div>   
        <div class="form-group">
          <label for="tahun" class="col-sm-2 control-label">Tahun</label>
          <div class="col-sm-3">
            <select name="tahun" id="tahun" class="form-control">
              <option value="">-Pilih Tahun-</option>
              <option {{($data->tahun == '2018')?'selected':''}} value="2018">2018</option>
              <option {{($data->tahun == '2019')?'selected':''}} value="2019">2019</option>
              <option {{($data->tahun == '2020')?'selected':''}} value="2020">2020</option>
              <option {{($data->tahun == '2021')?'selected':''}} value="2021">2021</option>
              <option {{($data->tahun == '2021')?'selected':''}} value="2021">2021</option>
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
@endsection