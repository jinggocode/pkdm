@layout('_layout/admin/index')

@section('title')Data Penilaian@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hasil Penilaian Prodi {{$prodi->nama}}
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border"> 
          <center><a href="{{site_url('admin/laporan/penilaian/prodi/1/'.$periode->id)}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a></center>

          <h4><b>Tahun Ajaran {{$periode->tahun.' Semester '.$periode->semester}}</b></h4>
        </div>
        <div class="box-body">  
          <table class="table table-striped table-hover">
            <thead>
              <th style="width: 10%">Peringakat</th>
              <th>Nama Dosen</th>
              <th>Nilai Rata - rata</th>
              <th>Aksi</th>
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
                    <td> 
                        <a href="{{site_url('admin/laporan/penilaian/detail/'.$periode->id.'/'.$row->id_dosen)}}" class="btn btn-success"><i class="fa fa-eye"></i> Detail</a>
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