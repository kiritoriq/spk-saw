<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Statistik Data Rekomendasi
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Laporan</li>
		<li class="active">Statistik Data Rekomendasi</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border">
					
				</div>
				<form class="form-" method="POST" action="proses/prosesrekomendasi.php" id="data">
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
							<thead class="bg-primary">
								<tr>
									<!-- <th width="3%">
										<input type="checkbox" name="checkall" id="checkall" class="checkall" value="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pilih Semua">
										Pilih
									</th> -->
									<th>JUMLAH MAHASISWA</th>
				                  	<th>REKOMENDASI PPSI</th>
				                  	<th>REKOMENDASI EBISNIS</th>
				                  	<th>JUMLAH MAHASISWA YANG TELAH DI PROSES</th>
				                  	<!-- <th>JUMLAH PEMINAT PPSI</th>
				                  	<th>JUMLAH PEMINAT EBISNIS</th> -->
				                </tr>
							</thead>
							<tbody>
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
								// foreach($store as $rs => $i) {
								// 	echo "<tr>
								// 			<td>".$j++."</td>
								// 			<td>Proses Rekomendasi ".$j."</td>
								// 			<td><a class='detail' href='javascript:void(0)' data-recid='".$i['id']."'>Detail...</a></td>
								// 		</tr>";
								// }
							?>
								<tr>
									<td align="right"><?php echo $mhs['jml_mhs'] ?></td>
									<td align="right"><?php echo $rekppsi['jmlrek_ppsi'] ?></td>
									<td align="right"><?php echo $rekebis['jmlrek_ebis'] ?></td>
									<td align="right"><?php echo $jmlmhs_proses['mhs_proses'] ?></td>
									<!-- <td align="right"><?php //echo $mhsppsi['jmlmhs_ppsi'] ?></td>
									<td align="right"><?php //echo $mhsebis['jmlmhs_ebis'] ?></td> -->
								</tr>
							</tbody>
						</table>
						<p style="height: 50px;">&nbsp;</p>
				</div>
				<div class="box-footer clearfix">
					<div class="row">
						<div class="col-sm-6">
							<button type="submit" class="btn btn-warning btn-sm" style="display: none;" id="proses">Proses yang dipilih</button>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		// getinput();
		// $('.text-upper').css('text-transform', 'uppercase');

		var limit = 5;

		$('input.checkme').change(function(e) {
			e.preventDefault();
			if($(this).is(':checked')) {
				var length = $("input[class='checkme']:checked").length;
				console.log(length);
				if(length > limit){
					$(this).prop('checked', false);
				}
				if($("input[class='checkme']:checked").length == limit){
					$('#proses').fadeIn(300);
				}
			} else {
				$('#proses').fadeOut(300);
			}
		});

		$('#data').on('submit', function(e) {
			e.preventDefault();
			var $this = $(this);
			bootbox.confirm('Proses Data yang dipilih?', function(r) {
				if(r) {
					$.ajax({
						url: $this.attr('action'),
						type: 'POST',
						data: $this.serialize(),
						beforeSend: function() {
							$('#loading-state').fadeIn('slow');
						},
						success: function(response) {
							var res = JSON.parse(response);
							// console.log(res);
							if(res.status === true) {
								location.reload();
							}
							// $('#utama').html(response);
						},
						complete: function() {
							$('#loading-state').fadeOut('slow');
						}
					})
				}
			})
		})

		$('#detail').on('click', function(e) {
			e.preventDefault();
			var id = $(this).data('recid');
			$.ajax({
				
			})
		})
	})
</script>