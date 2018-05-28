@layout('_layout/dosen/index')

@section('title')Isi Kuisioner@endsection

@section('content')
<div class="box box-default">
  <div class="box-header with-border" align="center">
    <a href="{{site_url('dosen/homepage')}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
  </div>
 
  <div class="box-body">
    <div class="row">
      <div class="col-sm-6 col-lg-12">
        <!-- form alert -->
        @if (!empty(validation_errors()))
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          <h4><strong>Peringatan</strong></h4>
          <p>{{validation_errors()}}</p>
        </div>
        @endif
      </div>
      <!-- end form alert -->
    </div>

    <div style="padding-bottom: 2px">
      <form action="{{site_url('dosen/profil/update')}}" method="post">
        {{$csrf}}
        {{form_hidden('id', $user->id)}}

        <div class="form-group">
          <label for="password">Password Baru *min panjang 8 karakter</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div> 
        <div class="form-group">
          <label for="reenter_password">Ulangi Password Baru</label>
          <input type="password" name="reenter_password" class="form-control" id="reenter_password" placeholder="Ulangi Password">
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
