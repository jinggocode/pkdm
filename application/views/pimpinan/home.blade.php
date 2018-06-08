@layout('_layout/pimpinan/index')

@section('title')Beranda@endsection

@section('content')

@if ($user->status_password == '0')
<div class="callout callout-danger">
  <h4>Segera lakukan perubahan password anda!</h4>

  <a style="text-decoration: none;" href="{{site_url('pimpinan/profil/ubah_password')}}" class="btn btn-primary">Ubah Password</a> 
</div>
@endif
  
<div class="box box-default">
  <div class="box-header with-border">
    <h2><strong>Pilih Program Studi</strong></h2>
  </div>
  <div class="box-body" style="font-size: 20px">
    <table class="table table-striped table-hover">
      <thead>
        <th>Nama Prodi</th>
        <th>Aksi</th>
      </thead>
      <tbody>
      <?php if(empty($prodi)): ?>
          <tr>
              <td colspan="6" align="center">Tidak ada Data</td>
          </tr> 
      <?php else: ?>
          <?php $no = 1 ?>
          @foreach($prodi as $row)  
            <tr>
              <td>{{$row->nama}}</td>
              <td> 
                  <a href="{{site_url('pimpinan/homepage/ajaran/'.$row->id)}}" class="btn btn-success"><i class="fa fa-eye"></i> Lihat</a>
              </td>
            </tr>
          @endforeach
      <?php endif ?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
