<nav class="navbar navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <a href="{{site_url('dosen/homepage')}}" class="navbar-brand"><img style="display:inline-block; margin-top: -7px; max-width:100px; margin-right: 3px" src="{{base_url('assets/image/logo.png')}}" width="34" alt=""> <b>PKDM Poliwangi</b></a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <i class="fa fa-bars"></i>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
       
      <div class="navbar-custom-menu">

        <?php $user = $this->ion_auth->user()->row(); ?>

        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{base_url()}}assets/image/user.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{$user->first_name}}</span> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{base_url()}}assets/image/user.png" class="img-circle" alt="User Image">

                <p>
                  {{$user->first_name}}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{site_url('dosen/profil/ubah_password')}}" class="btn btn-default btn-flat">Ubah Password</a>
                </div>
                <div class="pull-right">
                  <a href="{{site_url('auth/logout')}}" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
