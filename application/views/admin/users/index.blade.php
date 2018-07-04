@layout('_layout/admin/index')

@section('title')Data Pengguna  @endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pengguna (Admin dan Pimpinan) 
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <a href="{{site_url('admin/users/add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
        </div>
        <div class="box-body"> 
          <table class="table table-hover table-striped">
              <thead>
                <th style="width: 3%">No.</th> 
                <th style="width: 30%">Nama</th>
                <th>Username</th>
                <th>Hak Akses</th> 
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
                    <td>{{$row->first_name}}</td> 
                    <td>{{$row->username}}</td> 
                    <td>{{$row->group->description}}</td> 
                    <td> 
                      <a href="{{site_url('admin/users/edit/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                      <a href="{{site_url('admin/users/delete/'.$row->id)}}" onclick="return confirm('apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
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