<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Analisa Data Rekomendasi
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Proses</li>
		<li class="active">Analisa Data Rekomendasi</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="row">
			<div class="col-md-12">
				<!-- <div class="box-header with-border">
					<h4 class="box-title"><i class="fa fa-warning"></i> Pilih Mahasiswa dengan menekan tombol centang yang telah disediakan, lalu klik tombol proses</h4>
					<br>
					<small>* Maksimal pemilihan 5 mahasiswa untuk diproses</small>
					<button id="tambah" type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Buat Baru</button>
				</div> -->
				<form class="form-" method="POST" action="proses/prosesrekomendasi.php" id="data">
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
							<thead class="bg-primary">
								<tr>
									<!-- <th width="3%">
										<input type="checkbox" name="checkall" id="checkall" class="checkall" value="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pilih Semua">
										Pilih
									</th> -->
									<th>NO</th>
				                  	<th>DATA</th>
					                <th>DETAIL</th>
					                <!-- <th>PRODI</th> -->
				                </tr>
							</thead>
							<tbody>
							<?php
								$q = new Query();
								$j = 1;
								$selmhs = $q->query("SELECT * FROM tr_rekomendasi ORDER BY created_at ASC");
								$store = $q->store($selmhs);
								foreach($store as $rs => $i) {
									echo "<tr>
											<td>".$j."</td>
											<td>Proses Rekomendasi ".$j."</td>
											<td><a class='detail' href='javascript:void(0)' data-recid='".$i['id']."'>Detail...</a></td>
										</tr>";
									$j++;
								}
							?>
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

		$('.detail').on('click', function(e) {
			e.preventDefault();
			var id = $(this).data('recid');
			$.ajax({
				url: 'page/verifikasianggota.php',
				type: 'POST',
				data: { 'id': id },
				beforeSend: function() {
					$('#loading-state').fadeIn('slow');
				},
				success: function(response) {
					// var res = JSON.parse(response);
					// console.log(res);
					// if(res.status === true) {
					// 	location.reload();
					// }
					$('#utama').html(response);
				},
				complete: function() {
					$('#loading-state').fadeOut('slow');
				}
			})
		})
	})
</script>