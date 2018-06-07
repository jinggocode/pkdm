@layout('_layout/admin/index')
@section('title')Data User@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Kelola Data</a></li>
        <li class="active">Data User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
      <div class="box-header with-border">
        <a href="{{site_url('admin/user/add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
      </div>
        <div class="box-body">
          <table class="table table-hover table-striped">
                <thead>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Aksi</th>
                </thead>
                @foreach($tampildata as $row)
                <tr>
                  <td>1</td>
                  <td>{{$row->nama}}</td>
                  <td>{{$row->email}}</td>
                  <td>{{$row->password}}</td>
                  <td>
                    <a href="{{site_url('admin/user/view/'.$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                    <a href="{{site_url('admin/user/edit/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                    <a href="{{site_url('admin/user/delete/'.$row->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                  </td>
                </tr>
                @endforeach
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