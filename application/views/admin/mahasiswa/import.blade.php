@layout('_layout/admin/index')

@section('title')Data Mahasiswa@endsection

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
      <div class="box">
      <div class="box-header with-border">
        <a href="{{site_url('admin/mahasiswa')}}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a> 
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-lg-6 col-md-6">
                <form class="form-inline" action="{{site_url('admin/mahasiswa/import_action')}}" method="post" enctype="multipart/form-data">
                  {{ $csrf }}
                   
                  <p><a href="{{ site_url('excel/template/format_data_mahasiswa.xlsx') }}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Format Data Mahasiswa</a></p>

                  <div class="form-group"> 
                    <input type="file" name="file" class="form-control" id="file" style="margin-right: 10px" required><br>
                  </div>
                  <button name="submit" type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Import</button> <br>

                  <small>Upload data sesuai format!</small>
                </form> 
            </div> 
            
        </div> 
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection