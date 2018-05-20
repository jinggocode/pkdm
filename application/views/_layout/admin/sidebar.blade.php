  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <?php $page     = $this->uri->segment(2); ?>
      <?php $sub_page = $this->uri->segment(3); ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">DAFTAR MENU</li>
        <li class="{{($page == '' || $page == 'homepage')?'active':''}}"><a href="{{site_url('admin/homepage')}}"><i class="fa fa-dashboard"></i> <span>Beranda</span></a></li>
        <li class="{{($page == 'mahasiswa')?'active':''}}"><a href="{{site_url('admin/mahasiswa')}}"><i class="fa fa-user"></i> <span>Data Mahasiswa</span></a></li>
        <li class="{{($page == 'dosen')?'active':''}}"><a href="{{site_url('admin/dosen')}}"><i class="fa fa-user"></i> <span>Data Dosen</span></a></li>
        <li class="treeview {{($page == 'kuesioner')?'active':''}}">
          <a href="#">
            <i class="fa fa-database"></i> <span>Data Kuesioner</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($sub_page == 'index')?'active':''}}">
              <a href="{{site_url('admin/kuesioner/pertanyaan')}}"><i class="fa fa-circle-o"></i> Pertanyaan</a>
            </li>
            <li class="{{($sub_page == 'kategori')?'active':''}}">
              <a href="{{site_url('admin/kuesioner/kategori')}}"><i class="fa fa-circle-o"></i> Kategori Pertanyaan</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{($page == 'master')?'active':''}}">
          <a href="#">
            <i class="fa fa-database"></i> <span>Data Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{($sub_page == 'prodi')?'active':''}}">
              <a href="{{site_url('admin/master/prodi')}}"><i class="fa fa-circle-o"></i> Program Studi</a>
            </li>
            <li class="{{($sub_page == 'angkatan')?'active':''}}">
              <a href="{{site_url('admin/master/angkatan')}}"><i class="fa fa-circle-o"></i> Angkatan</a>
            </li>
            <li class="{{($sub_page == 'kelas')?'active':''}}">
              <a href="{{site_url('admin/master/kelas')}}"><i class="fa fa-circle-o"></i> Kelas</a>
            </li>
            <li class="{{($sub_page == 'makul')?'active':''}}">
              <a href="{{site_url('admin/master/makul')}}"><i class="fa fa-circle-o"></i> Mata Kuliah</a>
            </li>
            <li class="{{($sub_page == 'periode')?'active':''}}">
              <a href="{{site_url('admin/master/periode')}}"><i class="fa fa-circle-o"></i> Periode Kuesioner</a>
            </li>
            <li class="{{($sub_page == 'pengampu')?'active':''}}">
              <a href="{{site_url('admin/master/pengampu')}}"><i class="fa fa-circle-o"></i> Pengampu Kuliah</a>
            </li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
