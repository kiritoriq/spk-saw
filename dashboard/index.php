<?php 
  session_start();
    if($_SESSION['status']!="logged in"){
      header("location:../login/index.php");
    }
  require_once('header.php');
  $page = (isset($_GET['page']))?$_GET['page'] : 'maindashboard';
  require_once('sidebar.php');
  include('../config/query.php');
?>
<script>
  $(document).ready(function() {
    $('#loading-state').delay(850).fadeOut();
  })
</script>

<style>
  #loading-state {
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,.7);
    position: fixed;
    z-index: 2000;
    display: nones;
}

.loadings {
    position: relative;
    /*left:46%; */
    top:45%;
    color: white;
}
</style>
<?php
  function tanggalindonesia($date) {
    $x = explode('-', $date);
    $tgl = $x[0];
    $bulan = "";
    $thn = $x[2];
    switch($x[1]) {
      case '01':
        $bulan = 'Januari';
        break;
      case '02':
        $bulan = 'Februari';
        break;
      case '03':
        $bulan = 'Maret';
        break;
      case '04':
        $bulan = 'April';
        break;
      case '05':
        $bulan = 'Mei';
        break;
      case '06':
        $bulan = 'Juni';
        break;
      case '07':
        $bulan = 'Juli';
        break;
      case '08':
        $bulan = 'Agustus';
        break;
      case '09':
        $bulan = 'September';
        break;
      case '10':
        $bulan = 'Oktober';
        break;
      case '11':
        $bulan = 'November';
        break;
      case '12':
        $bulan = 'Desember';
        break;
    }

    return $tgl." ".$bulan." ".$thn; 
  }
?>

  <div id="loading-state">
      <p class='loadings' align='center'>
          <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>            
      </p>
  </div>
  <!-- Content Wrapper. Contains page content -->
  <div id="utama" class="content-wrapper">
        <!-- Main content -->
          <?php
            switch($page) {
              case 'maindashboard':
                if($_SESSION['role_id'] > 10) {
                  include('page/dashboardanggota.php');
                } else {
                  include('page/maindashboard.php');
                }
              break;

              case 'datamhs':
                include('page/listmhs.php');
              break;

              case 'prosesrekomendasi':
                include('page/rekomendasi.php');
              break;
              
              case 'analisadata':
                include('page/daftaranalisadata.php');
              break;
              
              case 'datarekomendasi':
                include('page/datarekomendasimhs.php');
              break;

              case 'datapeminatan':
                include('page/datapeminatanmhs.php');
              break;

              case 'statistikrekomendasi':
                include('page/statistikrekomendasi.php');
              break;

              case 'user':
                include('page/listuser.php');
              break;
         }
  require_once('footer.php');
?>
