@layout('_layout/admin/index')

@section('title')Data Periode@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Periode
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
      <div class="box-header with-border">
        <a href="{{site_url('admin/master/periode/add')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Data</a>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-lg-6 col-md-6">
                <form class="form-inline" action="{{site_url('admin/master/periode/search')}}" method="get">

                  <div class="form-group">
                    <input type="hidden" value="{{(isset($search_data['keyword']))?$search_data['keyword']:''}}" name="keyword" class="form-control" id="keyword" placeholder="Cari Berdasarkan Nama" style="margin-right: 10px" autofocus="autofocus">
                  </div>
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
                <th>Semester</th>
                <th>Tahun</th>
                <th>Status</th>
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
                    <td>{{($row->semester == '1')?'Ganjil':'Genap'}}</td>
                    <td>{{$row->tahun}}</td>
                    <td>{{($row->status == '1')?'<label class="label label-info">Aktif</label>':'<label class="label label-warning">Tidak Aktif</label>'}}</td>
                    <td>
                      @if ($row->status == '0')
                        <a href="{{site_url('admin/master/periode/active/'.$row->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Aktifkan</a>
                      @else
                        <a href="{{site_url('admin/master/periode/unactive/'.$row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-check"></i> Non Aktifkan</a>
                      @endif

                      <a href="{{site_url('admin/master/periode/edit/'.$row->id)}}" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                      <a href="{{site_url('admin/master/periode/delete/'.$row->id)}}" onclick="return confirm('apakah anda yakin?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
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
