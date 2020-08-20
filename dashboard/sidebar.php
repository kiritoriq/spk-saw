  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar elevation-4">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../assets/dist/img/<?php echo $_SESSION['image']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['name']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <?php if($_SESSION['role_id'] > 2) { ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li class="treeview <?php if($page == 'maindashboard' || $page == 'datarekomendasi') echo 'active'; else echo ''; ?>">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if($page == 'maindashboard') echo 'active'; else echo ''; ?>">
                <a href="index.php?page=maindashboard"><i class="fa  fa-chevron-circle-right"></i> Dashboard</a>
              </li>
              <li class="<?php if($page == 'datarekomendasi') echo 'active'; else echo ''; ?>">
                <a href="index.php?page=datarekomendasi"><i class="fa  fa-chevron-circle-right"></i> Data Rekomendasi Mahasiswa</a>
              </li>
            </ul>
          </li>
        </ul>
      <?php } else { ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li class="<?php if($page == 'maindashboard') echo 'active'; else echo ''; ?>">
            <a href="index.php?page=maindashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="treeview <?php if($page == 'datamhs') echo 'active'; else echo ''; ?>">
            <a href="#">
              <i class="fa fa-archive"></i> <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if($page == 'datamhs') echo 'active'; else echo ''; ?>">
                <a href="index.php?page=datamhs"><i class="fa  fa-chevron-circle-right"></i> Data Mahasiswa</a>
              </li>
            </ul>
          </li>
          <li class="treeview <?php if($page == 'prosesrekomendasi' || $page == 'analisadata') echo 'active'; else echo ''; ?>">
            <a href="#">
              <i class="fa fa-forward"></i> <span>Proses</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if($page == 'prosesrekomendasi') echo 'active'; else echo ''; ?>">
                <!-- <a href="index.php?page=inputsimpan"><i class="fa fa-chevron-circle-right"></i> Entry Simpan</a> -->
                <a href="index.php?page=prosesrekomendasi"><i class="fa fa-chevron-circle-right"></i> Proses Rekomendasi</a>
              </li>
              <li class="<?php if($page == 'analisadata') echo 'active'; else echo ''; ?>">
                <a href="index.php?page=analisadata"><i class="fa fa-chevron-circle-right"></i> Analisa Data Rekomendasi</a>
              </li>
            </ul>
          </li>
          <li class="treeview <?php if($page == 'statistikrekomendasi' || $page == 'datarekomendasi' || $page == 'datapeminatan') echo 'active'; else echo ''; ?>">
            <a href="#">
              <i class="fa fa-files-o"></i> <span>Laporan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php if($page == 'datarekomendasi') echo 'active'; else echo ''; ?>">
                <a href="index.php?page=datarekomendasi"><i class="fa  fa-chevron-circle-right"></i> Data Rekomendasi Mahasiswa</a>
              </li>
              <!-- <li class="<?php //if($page == 'datapeminatan') echo 'active'; else echo ''; ?>">
                <a href="index.php?page=datapeminatan"><i class="fa  fa-chevron-circle-right"></i> Data Peminatan Mahasiswa</a>
              </li> -->
              <li class="<?php if($page == 'statistikrekomendasi') echo 'active'; else echo ''; ?>">
                <a href="index.php?page=statistikrekomendasi"><i class="fa  fa-chevron-circle-right"></i> Statistik Rekomendasi</a>
              </li>
              
            </ul>
          </li>

          <?php if($_SESSION['role_id'] == 1) {
            echo '<li class="treeview '.(($page=='user')?"active":"").'">
                  <a href="#">
                    <i class="fa fa-gear"></i> <span>Setting</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="'.(($page=='user')?"active":"").'">
                      <a href="index.php?page=user"><i class="fa  fa-chevron-circle-right"></i> Users</a>
                    </li>
                  </ul>
                </li>';
                    // <li class="submenu">
                    //   <a href=""><i class="fa  fa-chevron-circle-right"></i> Laporan Kegiatan</a>
                    // </li>
                    // <li class="submenu">
                    //   <a href=""><i class="fa  fa-chevron-circle-right"></i> Laporan Simpan Potong Gaji</a>
                    // </li>
          } ?>
        </ul>
      <?php } ?>
    </section>
    <!-- /.sidebar -->
  </aside>