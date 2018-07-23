@layout('_layout/admin/index')

@section('title')Data Dosen@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Dosen
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
      <div class="box-header with-border">
        <a href="{{site_url('admin/dosen/add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
        <a href="{{site_url('admin/dosen/import')}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Import Data Excel</a>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-lg-6 col-md-6">
                <form class="form-inline" action="{{site_url('admin/dosen/search')}}" method="get">
                  
                  <div class="form-group">
                    <select name="filter" required="required" id="filter" class="form-control">
                        <option value="">Cari Berdasarkan</option>
                        <option {{(isset($search_data['filter'])&& $search_data['filter'] == 'nama')?'selected':''}} value="nama">Nama</option> 
                        <option {{(isset($search_data['filter'])&& $search_data['filter'] == 'nik')?'selected':''}} value="nik">NIK</option> 
                    </select>
                  </div>
                  <div class="form-group"> 
                    <input type="text" value="{{(isset($search_data['keyword']))?$search_data['keyword']:''}}" name="keyword" class="form-control" id="keyword" placeholder="Cari Berdasarkan Judul" style="margin-right: 10px" autofocus="autofocus">
                  </div>
                  <button type="submit" class="btn btn-info"><i class="fa fa-search"></i> Cari</button> 

            </div>
            <div class="col-lg-6 col-md-6" align="right"> 
                <div class="form-inline">
                  <div class="form-group">  
                    <select name="sort" id="sort" class="form-control" onchange="this.form.submit();">
                        <option value="">Tampilkan Berdasarkan</option>
                        <option {{(isset($search_data['sort'])&& $search_data['sort'] == '1')?'selected':''}} value="1">Data Terbaru</option>
                        <option {{(isset($search_data['sort'])&& $search_data['sort'] == '2')?'selected':''}} value="2">Data Lama</option> 
                    </select>
                  </div>  
                </div>
                </form>
            </div>
        </div>
          <table class="table table-hover table-striped">
              <thead>
                <th style="width: 3%">No.</th> 
                <th style="width: 40%">Nama</th>
                <th>NIK</th> 
                <th>Prodi</th> 
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
                    <td>{{$row->nama}}</td> 
                    <td>{{$row->nik}}</td> 
                    <td>{{$row->prodi->nama}}</td> 
                    <td>
                      <a href="{{site_url('admin/dosen/view/'.$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                      <a href="{{site_url('admin/dosen/edit/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                      <a href="{{site_url('admin/dosen/delete/'.$row->id)}}" onclick="return confirm('apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
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