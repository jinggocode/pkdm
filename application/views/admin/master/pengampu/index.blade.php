@layout('_layout/admin/index')

@section('title')Data Pengampu Mata Kuliah @endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pengampu Mata Kuliah
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <a href="{{site_url('admin/master/pengampu/add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
          <a href="{{site_url('admin/master/pengampu/import')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Import Data Excel</a>
        </div>
        <div class="box-body">
            
          <table class="table table-hover table-striped">
              <thead>
                <th style="width: 3%">No.</th>
                <th>Semester / Nama Makul</th>
                <th>Prodi / Kelas</th>
                <th>Nama Dosen</th>
                <th>Aksi</th>
              </thead>
              <?php if(empty($data)): ?>
                  <tr>
                      <td colspan="6" align="center">Tidak ada Data</td>
                  </tr>
              <?php else: ?>
                  <?php $start+= 1 ?>
                  @foreach($data as $row)
                  <tr>
                    <td>{{$start++}}.</td>
                    <td>SEMESTER {{$row->makul->semester}} - {{($row->makul->jenis == 0?'TEORI':'PRAKTIKUM')}} {{$row->makul->nama}}</td>
                    <td>{{$row->prodi->nama}} - {{$row->kelas->nama}}</td>
                    <td>{{$row->dosen->nama}}</td>
                    <td>
                      <a href="{{site_url('admin/master/pengampu/edit/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                      <a href="{{site_url('admin/master/pengampu/delete/'.$row->id)}}" onclick="return confirm('apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                  </tr>
                  @endforeach
              <?php endif ?>
            </table>
        </div>
        <div class="box-footer clearfix">
          {{$pagination}}
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
