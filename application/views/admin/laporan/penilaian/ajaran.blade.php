@layout('_layout/admin/index')

@section('title')Data Penilaian@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Laporan Penilaian
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h4><b>Pilih Tahun Ajaran</b></h4>
        </div>
        <div class="box-body">  
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
                        <a href="{{site_url('admin/laporan/penilaian/prodi/'.$row->id_periode)}}" class="btn btn-success"><i class="fa fa-eye"></i> Lihat</a>
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