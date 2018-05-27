@layout('_layout/mahasiswa/index')

@section('title')Isi Kuisioner@endsection

@section('content')
<div class="box box-default">
  <div class="box-header with-border" align="center">
    <a href="{{site_url('mahasiswa/homepage')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
 
  <div class="box-body">
    <div style="padding-bottom: 2px">
      <form>
        <div class="form-group">
          <label for="password">Password Baru</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div> 
        <div class="form-group">
          <label for="reenter_password">Ulangi Password Baru</label>
          <input type="reenter_password" name="reenter_password" class="form-control" id="reenter_password" placeholder="Ulangi Password">
        </div> 
        <div class="form-group">
          <button class="btn btn-primary">Ubah</button>
        </div> 

      </form>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection
