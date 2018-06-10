@layout('_layout/admin/index')

@section('title')Data Penilaian@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Penilaian Tahun Ajaran <b>{{$periode->tahun}} Semester {{$periode->semester}}</b>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <center><a href="{{site_url('admin/laporan/penilaian/ajaran')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a></center> 
          
          <h4><b>Pilih Prodi</b></h4>
        </div>
        <div class="box-body">  
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
                        <a href="{{site_url('admin/laporan/penilaian/statistik/'.$periode->id.'/'.$row->id)}}" class="btn btn-success"><i class="fa fa-eye"></i> Lihat</a>
                    </td>
                  </tr>
                @endforeach
            <?php endif ?>
            </tbody>
          </table> 
        </div> 
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection