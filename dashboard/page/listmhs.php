<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Data Mahasiswa
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Master Data</li>
		<li class="active">Data Mahasiswa</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border">
					<button id="tambah" type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Buat Baru</button>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table id="table1" class="table table-bordered table-striped">
							<?php
								$q = new Query();
								$makul = $q->query("SELECT * FROM mast_makul");
								$store = $q->store($makul);
							?>
							<thead class="bg-primary">
								<tr>
				                  <th rowspan="2" style="text-align: center;">NIM</th>
				                  <th rowspan="2" style="text-align: center;">Nama Lengkap</th>
				                  <th colspan="10" style="text-align: center;">Daftar Nilai</th>
				                </tr>
				                <tr>
				                	<?php foreach($store as $rs => $i) {
				                		echo "<th style='text-align: center;'>".$i[2]."</th>";
				                	} ?>
				                </tr>
							</thead>
							<tbody>
								<?php
									$selmhs = $q->query("SELECT * FROM master_mhs");
									$storemhs = $q->store($selmhs);
									foreach($storemhs as $result => $item) {
										echo "<tr>
											<td>".$item[2].".".$item[3].".".$item[4]."</td>
											<td>".$item[1]."</td>
											<td style='text-align: right;'>".$item[5]."</td>
											<td style='text-align: right;'>".$item[6]."</td>
											<td style='text-align: right;'>".$item[7]."</td>
											<td style='text-align: right;'>".$item[8]."</td>
											<td style='text-align: right;'>".$item[9]."</td>
											<td style='text-align: right;'>".$item[10]."</td>
											<td style='text-align: right;'>".$item[11]."</td>
											<td style='text-align: right;'>".$item[12]."</td>
											<td style='text-align: right;'>".$item[13]."</td>
											<td style='text-align: right;'>".$item[14]."</td>
										</tr>";
									}
								?>
								<!-- <tr>
									<td>A12.2016.05489</td>
									<td>Ahmad Thoriq Fahlevi</td>
									<td>80</td>
									<td>80</td>
									<td>80</td>
									<td>80</td>
									<td>80</td>
									<td>80</td>
									<td>80</td>
									<td>80</td>
									<td>80</td>
									<td>80</td>
								</tr> -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('#table1').DataTable({
			'ordering': false,
		});
		// selectlist(1);
		// $('.text-upper').css('text-transform', 'uppercase');

		$('#tambah').on('click', function(e) {
			e.preventDefault();
			$.ajax({
				url: 'page/inputmhs.php',
				type: 'get',
				beforeSend: function() {
					$('#loading-state').fadeIn('slow');
				},
				success: function(response) {
					$('#utama').html(response);
				},
				complete: function() {
					$('#loading-state').fadeOut('slow');
				},
				error: function(error) {
					console.log(error);
				}
			})
		})
	})
</script>