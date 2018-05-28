@layout('_layout/dosen/index')

@section('title')Beranda @endsection

@section('content')

@if ($user->status_password == '0')
<div class="callout callout-danger">
  <h4>Segera lakukan perubahan password anda!</h4>

  <a style="text-decoration: none;" href="{{site_url('dosen/profil/ubah_password')}}" class="btn btn-primary">Ubah Password</a> 
</div>
@endif
  
<div class="box box-default">
  <div class="box-header with-border"> 
    <center>
        <a href="{{site_url('dosen/homepage')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
    </center>

    <h2><strong>Nama Mata Kuliah</strong></h2>
  </div>
  <div class="box-body" style="font-size: 20px">
    <div class="row">
      <div class="col-md-4">
        <table class="table table-bordered table-striped">
          <tr>
            <td>Kurang</td>
            <td><b>10</b></td>
          </tr>
          <tr>
            <td>Cukup</td>
            <td><b>10</b></td>
          </tr>
          <tr>
            <td>Baik</td>
            <td><b>10</b></td>
          </tr>
          <tr>
            <td>Sangat Baik</td>
            <td><b>10</b></td>
          </tr>
        </table>
      </div>
    </div> 
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
