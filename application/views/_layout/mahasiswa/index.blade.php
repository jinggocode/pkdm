<?php
if (!$this->ion_auth->logged_in())
{
  // redirect them to the login page
  redirect('auth/login', 'refresh');
}

$user = $this->ion_auth->user()->row();

if ($user->group_id == 2){
    redirect('auth/logout', 'refresh');
} else if ($user->group_id == 1){
    redirect('auth/logout', 'refresh');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title') | Aplikasi PKDM</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{base_url()}}assets/admin/dist/css/skins/skin-blue.min.css">
  
  <link rel="stylesheet" href="{{base_url()}}assets/css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    .fade {
      opacity: 0;
      -webkit-transition: opacity 0.15s linear;
      -moz-transition: opacity 0.15s linear;
      -o-transition: opacity 0.15s linear;
      transition: opacity 0.15s linear;
    }
    .fade.in {
      opacity: 1;
    }
  </style>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    @include('_layout/mahasiswa/navbar')
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Alert -->
    <?php $message = $this->session->userdata('message'); ?>
    @if($message)
        <div class="row" style="padding: 10px; padding-bottom: -5px">
          <div class="col-md-12">
              <div class="alert alert-{{ $message[1] }} alert-dismissable fade" id="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-info"></i> Info</strong></h4>
                  <p>{{ $message[0] }}</p>
              </div>
          </div>
        </div>
    @endif

    <div class="container">

      <!-- Main content -->
      <section class="content">
        @yield('content')
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>TI Poliwangi</b>
      </div>
      <strong>Copyright &copy; 2018 <a href="https://adminlte.io">Savicri Vidirila</a>.</strong>
    </div>
    <!-- /.container -->
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{base_url()}}assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{base_url()}}assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="{{base_url()}}assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{base_url()}}assets/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{base_url()}}assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{base_url()}}assets/admin/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
  $("#alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#alert").slideUp(300);
  });
  function showAlert() {
      $("#alert").addClass("in");
  }
  window.setTimeout(function () {
      showAlert();
  }, 3000);
</script>

@yield('script')
</body>
</html>
