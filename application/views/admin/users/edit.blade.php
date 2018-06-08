@layout('_layout/admin/index')

@section('title')Data Pengguna@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Pengguna
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
      <form class="form-horizontal" action="{{site_url('admin/users/update')}}" method="post" enctype="multipart/form-data">
      {{$csrf}}
      {{form_hidden('id', $data->id)}}

        <div class="form-group">
          <label for="first_name" class="col-sm-2 control-label">Nama</label>
          <div class="col-sm-6">
            <input type="text" name="first_name" class="form-control" value="{{$data->first_name}}" id="first_name">
          </div>
        </div> 
        <div class="form-group">
          <label for="username" class="col-sm-2 control-label">Username</label>
          <div class="col-sm-6">
            <input type="text" name="username" class="form-control" value="{{$data->username}}" id="username">
          </div>
        </div> 
        <div class="form-group">
          <label for="password" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-6">
            <input type="password" name="password" class="form-control" value="{{set_value('password')}}" id="password" placeholder="Isi untuk merubah password">
          </div>
        </div> 
        <div class="form-group">
          <label for="password_confirm" class="col-sm-2 control-label">Ulangi Passowrd</label>
          <div class="col-sm-6">
            <input type="password" name="password_confirm" class="form-control" value="{{set_value('password_confirm')}}" id="password_confirm">
          </div>
        </div>   
        <div class="form-group">
          <label for="group_id" class="col-sm-2 control-label">Hak Akses</label>
          <div class="col-sm-4">
            <select name="group_id" id="group_id" class="form-control">
              <option value=""></option>
              @foreach ($group as $value)
                <option {{($data->group_id == $value->id)?'selected':''}} value="{{$value->id}}">{{$value->description}}</option>
              @endforeach
            </select>
          </div>
        </div> 
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Ubah</button>
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