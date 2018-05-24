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
  <div class="box box-success">
  <div class="box-header with-border">
  <h2 class="box-title"><i class="fa fa-plus-square-o"></i> Edit Data</h2>
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
      <form class="form-horizontal" action="{{site_url('admin/dosen/update')}}" method="post" enctype="multipart/form-data">
      {{$csrf}}
      {{form_hidden('id', $data->id);}}

        <div class="form-group">
          <label for="nama" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-6">
            <input autofocus="autofocus" type="text" name="nama" class="form-control" value="{{$data->nama}}" id="nama">
          </div>
        </div> 
        <div class="form-group">
          <label for="nik" class="col-sm-2 control-label">NIK</label>
          <div class="col-sm-6">
            <input autofocus="autofocus" type="text" name="nik" class="form-control" value="{{$data->nik}}" id="nik">
          </div>
        </div> 
        <div class="form-group">
          <label for="nik" class="col-sm-2 control-label">Prodi</label>
          <div class="col-sm-4">
            <select name="id_prodi" id="id_prodi" class="form-control"> 
              @foreach ($prodi as $value)
                <option {{($data->id_prodi == $value->id)?'selected':''}} value="{{$value->id}}">{{$value->nama}}</option>
              @endforeach
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
<script src="{{base_url('assets/js/money.js')}}"></script>  
<!-- CK Editor -->
<script src="{{base_url('assets/admin/')}}bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('isi')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<script type="text/javascript">
var articles = (function(){ 
    // bind events 
    $("[type='file']").on('change', eventPreviewGambar); 

    init(); 

    // Events  
    function eventPreviewGambar(event){
        readURL(event.target);
    } 

    function readURL(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

})();
</script>
@endsection