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
    <center>
        <a href="{{site_url('dosen/homepage')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
    </center>
  
    <h2><strong>{{$periode->periode->tahun}} - SEMESTER {{($periode->periode->semester == '1')?'GANJIL':'GENAP'}}</strong></h2>
  </div>
  <div class="box-body" style="font-size: 20px">
    <table class="table table-striped table-hover">
      <thead>
        <th>Angkatan - Kelas</th>
        <th>Mata Kuliah</th>
        <th>Aksi</th>
      </thead>
      <tbody>
      <?php if(empty($makul)): ?>
          <tr>
              <td colspan="6" align="center">Tidak ada Data</td>
          </tr>
      <?php else: ?>
          <?php $no = 1 ?>
          @foreach($makul as $row)  
            <tr>
              <td>ANGKATAN {{$row->mahasiswa->angkatan->nama}} - KELAS {{$row->mahasiswa->kelas->nama}} </td>
              <td>{{($row->pengampu->makul->jenis == '0')?'TEORI':'PRAKIKUM'}} {{$row->pengampu->makul->nama}}</td>
              <td> 
                  <a href="{{site_url('dosen/statistik/grafik/'.$row->id_pengampu.'/'.$row->id_periode)}}" class="btn btn-info"><i class="fa fa-send"></i> Lihat</a>
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
