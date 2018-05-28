@layout('_layout/dosen/index')

@section('title')Beranda@endsection

@section('content')

@if ($user->status_password == '0')
<div class="callout callout-danger">
  <h4>Segera lakukan perubahan password anda!</h4>

  <a style="text-decoration: none;" href="{{site_url('dosen/profil/ubah_password')}}" class="btn btn-primary">Ubah Password</a> 
</div>
@endif
  
<div class="box box-default">
  <div class="box-header with-border">
    <h2><strong>Pilih Tahun Ajaran</strong></h2>
  </div>
  <div class="box-body" style="font-size: 20px">
    <table class="table table-striped table-hover">
      <thead>
        <th>Tahun Ajaran</th>
        <th>Aksi</th>
      </thead>
      <tbody>
      <?php if(empty($tahun_ajaran)): ?>
          <tr>
              <td colspan="6" align="center">Tidak ada Data</td>
          </tr> 
      <?php else: ?>
          <?php $no = 1 ?>
          @foreach($tahun_ajaran as $row) 

            <tr>
              <td>{{$row->periode->tahun}} - SEMESTER {{($row->periode->semester == '1')?'GANJIL':'GENAP'}}</td>
              <td> 
                  <a href="{{site_url('dosen/statistik/makul/'.$row->id_periode)}}" class="btn btn-info"><i class="fa fa-send"></i> Lihat</a>
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
