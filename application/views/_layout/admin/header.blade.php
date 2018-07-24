  <header class="main-header">
    <!-- Logo -->
    <a href="{{site_url('admin')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">J</span>
      <!-- logo for regular state and mobile devices --> 
      <span class="logo-lg">ADMIN PKDM</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <?php $user = $this->ion_auth->user()->row(); ?>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{base_url()}}assets/image/user.png" class="user-image" alt="User Image">
              <span class="hidden-xs">{{$user->first_name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{base_url()}}assets/image/user.png" class="img-circle" alt="User Image">

                <p>
                  {{$user->first_name}}
                  <small>Administrator</small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer"> 
                <div class="pull-right">
                  <a href="{{site_url('auth/logout')}}" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li> 
        </ul>
      </div>
    </nav>
  </header>