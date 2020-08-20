<?php
    $q = new Query();
    $countmhs = $q->query("SELECT COUNT(*) as jml_mhs FROM master_mhs");
								$mhs = $q->fetching_single($countmhs);

								$countrekppsi = $q->query("SELECT COUNT(*) as jmlrek_ppsi FROM detail_rekomendasi WHERE rekomendasi = 'PPSI'");
								$rekppsi = $q->fetching_single($countrekppsi);
								$countrekebis = $q->query("SELECT COUNT(*) as jmlrek_ebis FROM detail_rekomendasi WHERE rekomendasi = 'Ebisnis'");
								$rekebis = $q->fetching_single($countrekebis);
								
								$countmhsppsi = $q->query("SELECT COUNT(*) as jmlmhs_ppsi FROM tr_peminatan WHERE peminatan = 'PPSI'");
								$mhsppsi = $q->fetching_single($countmhsppsi);
								$countmhsebis = $q->query("SELECT COUNT(*) as jmlmhs_ebis FROM tr_peminatan WHERE peminatan = 'Ebisnis'");
                $mhsebis = $q->fetching_single($countmhsebis);
                
                $jmlmhs = $q->query("SELECT COUNT(*) as mhs_proses FROM detail_rekomendasi");
								$jmlmhs_proses = $q->fetching_single($jmlmhs);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
		<small>Control Panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<section class="content">
	<div class="row">
        <div class="col-md-12">

          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Grafik Data Rekomendasi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="bar-chart" style="height: 200px"></canvas>
            </div>
            <!-- /.box-body-->
            <!-- .box-footer -->
            <div class="box-footer">
              <table id="table1" class="table table-bordered table-striped">
                <thead class="bg-primary">
                  <tr>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>JUMLAH MAHASISWA</td>
                    <td><?php echo $mhs['jml_mhs'] ?></td>
                  </tr>
                  <tr>
                    <td>REKOMENDASI PPSI</td>
                    <td><?php echo $rekppsi['jmlrek_ppsi'] ?></td>
                  </tr>
                  <tr>
                    <td>REKOMENDASI EBISNIS</td>
                    <td><?php echo $rekebis['jmlrek_ebis'] ?></td>
                  </tr>
                  <tr>
                    <td>JUMLAH MAHASISWA YANG TELAH DI PROSES</td>
                    <td><?php echo $jmlmhs_proses['mhs_proses'] ?></td>
                  </tr>
                  <!-- <tr>
                    <td>JUMLAH PEMINAT PPSI</td>
                    <td><?php echo $mhsppsi['jmlmhs_ppsi'] ?></td>
                  </tr>
                  <tr>
                    <td>JUMLAH PEMINAT EBISNIS</td>
                    <td><?php echo $mhsebis['jmlmhs_ebis'] ?></td>
                  </tr> -->
                </tbody>
              </table>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

        	
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
      var arrdata = [
          '<?php echo $mhs['jml_mhs'] ?>',
          '<?php echo $rekppsi['jmlrek_ppsi'] ?>',
          '<?php echo $rekebis['jmlrek_ebis'] ?>',
          '<?php echo $jmlmhs_proses['mhs_proses'] ?>'
          // '<?php echo $mhsppsi['jmlmhs_ppsi'] ?>',
          // '<?php echo $mhsebis['jmlmhs_ebis'] ?>'
        ];
      // console.log(arrdata);
    /*
     * BAR CHART
     * ---------
     */
    var ctx = document.getElementById('bar-chart').getContext('2d');;
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [
              'JUMLAH MAHASISWA',
              'REKOMENDASI PPSI',
              'REKOMENDASI EBISNIS',
              'JUMLAH MHS YANG TELAH DI PROSES',
              // 'JUMLAH PEMINAT PPSI',
              // 'JUMLAH PEMINAT EBISNIS'
            ],
          datasets: [{
            data: arrdata,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                // 'rgba(153, 102, 255, 0.2)'
            ],
          }]
        },
        options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          },
          legend: {
            display: true,
            labels: {
              generateLabels(chart) {
                var data = chart.data;
                // console.log(data.datasets)
                if(data.labels.length && data.datasets.length) {
                  return data.labels.map(function(label, i) {
                    return {
                      text: label,
                      fillStyle: data.datasets[0].backgroundColor[i]
                    }   
                  });
                } else {
                  return [];
                }
              }
            }
          }
      }
    });

    })
</script>