@layout('_layout/pimpinan/index')

@section('title')Beranda @endsection

@section('content')

@if ($user->status_password == '0')
<div class="callout callout-danger">
  <h4>Segera lakukan perubahan password anda!</h4>

  <a style="text-decoration: none;" href="{{site_url('pimpinan/profil/ubah_password')}}" class="btn btn-primary">Ubah Password</a> 
</div>
@endif
  
<div class="box box-default"> 
  <div class="box-header with-border">
    <center>
        <a href="{{site_url('pimpinan/homepage/ajaran/'.$id_prodi)}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
    </center> 

    <h2><strong>Hasil Penilaian Dosen Prodi {{$prodi->nama}}</strong></h2>
  </div>
  <div class="box-body" style="font-size: 20px">
    <table class="table table-striped table-hover">
      <thead>
        <th style="width: 10%">Peringakat</th>
        <th>Nama Dosen</th>
        <th>Nilai Rata - rata</th>
      </thead>
      <tbody>
      <?php if(empty($data)): ?>
          <tr>
              <td colspan="6" align="center">Tidak ada Data</td>
          </tr> 
      <?php else: ?>
          <?php $no = 1 ?>
          @foreach($data as $row)  
            <tr>
              <td align="center">{{$no++}}.</td>
              <td>{{$row->nama}}</td>
              <td>
                {{ceil($row->nilai)}}

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
