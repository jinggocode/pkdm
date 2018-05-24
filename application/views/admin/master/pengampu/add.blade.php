@layout('_layout/admin/index')

@section('title')Data Pengampu Mata Kuliah@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tambah Data Pengampu Mata Kuliah
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box box-success">
  <div class="box-header with-border">
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
      <form class="form-horizontal" action="{{site_url('admin/master/pengampu/save')}}" method="post" enctype="multipart/form-data">
      {{$csrf}}
        <div class="form-group">
          <label for="id_prodi" class="col-sm-2 control-label">Prodi</label>
          <div class="col-sm-4">
            <select name="id_prodi" id="id_prodi" class="form-control">
              <option value="">--Pilih Prodi--</option>
              @foreach ($prodi as $row)
                <option {{($row->id == set_value('id_prodi')?'selected':'')}} value="{{$row->id}}">{{$row->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="id_kelas" class="col-sm-2 control-label">Kelas</label>
          <div class="col-sm-4">
            <select name="id_kelas" id="id_kelas" class="form-control"> 
              
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="id_makul" class="col-sm-2 control-label">Mata Kuliah</label>
          <div class="col-sm-4">
            <select name="id_makul" id="id_makul" class="form-control">

            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="id_dosen" class="col-sm-2 control-label">Dosen</label>
          <div class="col-sm-4">
            <select name="id_dosen" id="id_dosen" class="form-control">
              
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->
@endsection

@section('script') 
<!-- Select2 -->
<script src="https://adminlte.io/themes/AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Page script -->
<script>
$(function () {
  //Initialize Select2 Elements
  $('.select2').select2() 
})
</script>

<script src="https://d19m59y37dris4.cloudfront.net/hub/1-3-0/vendor/jquery.cookie/jquery.cookie.js">
</script>

<script> 
$(document).ready(function(){

  $.ajaxSetup({
      data: {
          csrf_test_name: $.cookie('csrf_cookie_name')
      }
  });

  $('#id_prodi').change(function(){ 
    var id_prodi = $('#id_prodi').val(); 
    
    $.ajax({
        type : 'GET',
        url : '<?php echo base_url('admin/master/pengampu/get/getProdi'); ?>',
        data :  'id_prodi=' + id_prodi,
        success: function (data) {  
          $("#id_kelas").html(data); 
        }
    });
  });

  $('#id_kelas').change(function(){ 
    var id_prodi = $('#id_prodi').val(); 
    
    $.ajax({
        type : 'GET',
        url : '<?php echo base_url('admin/master/pengampu/get/getMakul'); ?>',
        data :  'id_prodi=' + id_prodi,
        success: function (data) {  
          $("#id_makul").html(data);
        }
    });
  }); 
 
  $('#id_makul').change(function(){ 
    var id_prodi = $('#id_prodi').val(); 
    
    $.ajax({
        type : 'GET',
        url : '<?php echo base_url('admin/master/pengampu/get/getDosen'); ?>',
        data :  'id_prodi=' + id_prodi,
        success: function (data) {  
          $("#id_dosen").html(data);
        }
    });
  }); 
});
</script>
@endsection
