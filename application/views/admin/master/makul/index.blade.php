@layout('_layout/admin/index')

@section('title')Data Mata Kuliah @endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Mata Kuliah
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <a href="{{site_url('admin/master/makul/add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
          <a href="{{site_url('admin/master/makul/import')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Import Data Excel</a>
        </div>
        <div class="box-body"> 
          <table class="table table-hover table-striped">
            <thead>
              <th style="width: 3%">No.</th>
              <th>Kategori / Nama</th>
              <th>Program Studi</th>
              <th>Semester</th>
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
                  <td>{{($row->jenis=='0')?'TEORI':'PRAKTIKUM'}} / {{$row->nama}}</td>
                  <td>{{$row->prodi->nama}}</td>
                  <td>{{$row->semester}}</td>
                  <td>
                    <a href="{{site_url('admin/master/makul/edit/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                    <a href="{{site_url('admin/master/makul/delete/'.$row->id)}}" onclick="return confirm('apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                  </td>
                </tr>
                @endforeach
            <?php endif ?>
          </table>  
          <div class="box-footer clearfix">
            {{$pagination}}
          </div>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
