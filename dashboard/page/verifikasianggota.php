<section class="content-header">
	<h1>
		Verifikasi Calon Anggota
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Keanggotaan</li>
		<li class="active">Verifikasi Calon Anggota</li>
	</ol>
</section>
<?php
	include '../../config/query.php';
	$q = new Query();
	$ids = $_POST['id'];
	$sel = $q->query("SELECT * FROM tr_rekomendasi WHERE id = '".$ids."'");
	$data = $q->fetching_single($sel);
	$a = json_decode($data['data']);
	// echo "<pre>";
	// print_r($a);
	// echo "</pre>";
?>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-table"></i> Tabel Konversi Nilai Mahasiswa</h3>
				</div>
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
						<thead>
							<th>NIM</th>
							<th>Nama</th>
							<?php
								$i = 1;
								// $C=array();
								// print_r($a->$i->C);	
								foreach($a->$i->C as $key => $value) {
									// print_r($key);
									echo "<th>C".$key."</th>";
								}
							// print_r($C);
							?>
						</thead>
						<tbody>
							<?php foreach($a as $rs => $item) { ?>
								<tr>
									<td>
										<?php echo $item->nim ?>
									</td>
									<td>
										<?php echo $item->nama ?>
									</td>
									<?php for($j=1;$j<=10;$j++) { ?>
										<td>
											<?php echo $item->C->$j ?>
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-table"></i> Matriks Keputusan Ternormalisasi (R)</h3>
				</div>
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
						<thead>
							<th>NIM</th>
							<th>Nama</th>
							<?php
								$i = 1;
								// $C=array();
								// print_r($a->$i->C);	
								foreach($a->$i->R as $key => $value) {
									// print_r($key);
									echo "<th>R".$key."</th>";
								}
							// print_r($C);
							?>
						</thead>
						<tbody>
							<?php foreach($a as $rs => $item) { ?>
								<tr>
									<td>
										<?php echo $item->nim ?>
									</td>
									<td>
										<?php echo $item->nama ?>
									</td>
									<?php for($j=1;$j<=10;$j++) { ?>
										<td>
											<?php echo $item->R->$j ?>
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-table"></i> Tabel Nilai Preferensi Peminatan PPSI (Vppsi)</h3>
				</div>
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
						<thead>
							<th>NIM</th>
							<th>Nama</th>
							<?php
								$i = 1;
								// $C=array();
								// print_r($a->$i->C);	
								foreach($a->$i->Vppsi as $key => $value) {
									// print_r($key);
									echo "<th>V1".$key."</th>";
								}
							// print_r($C);
							?>
						</thead>
						<tbody>
							<?php foreach($a as $rs => $item) { ?>
								<tr>
									<td>
										<?php echo $item->nim ?>
									</td>
									<td>
										<?php echo $item->nama ?>
									</td>
									<?php for($j=1;$j<=10;$j++) { ?>
										<td>
											<?php echo $item->Vppsi->$j ?>
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-table"></i> Tabel Nilai Preferensi Peminatan Ebisnis (Vebisnis)</h3>
				</div>
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
						<thead>
							<th>NIM</th>
							<th>Nama</th>
							<?php
								$i = 1;
								// $C=array();
								// print_r($a->$i->C);	
								foreach($a->$i->Vebisnis as $key => $value) {
									// print_r($key);
									echo "<th>V2".$key."</th>";
								}
							// print_r($C);
							?>
						</thead>
						<tbody>
							<?php foreach($a as $rs => $item) { ?>
								<tr>
									<td>
										<?php echo $item->nim ?>
									</td>
									<td>
										<?php echo $item->nama ?>
									</td>
									<?php for($j=1;$j<=10;$j++) { ?>
										<td>
											<?php echo $item->Vebisnis->$j ?>
										</td>
									<?php } ?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-table"></i> Tabel Hasil Rekomendasi</h3>
				</div>
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
						<thead>
							<th>NIM</th>
							<th>Nama</th>
							<th>Hasil PPSI</th>
							<th>Hasil Ebisnis</th>
							<th>Rekomendasi</th>
						</thead>
						<tbody>
							<?php foreach($a as $rs => $item) { ?>
								<tr>
									<td>
										<?php echo $item->nim ?>
									</td>
									<td>
										<?php echo $item->nama ?>
									</td>
									<td>
										<?php echo $item->hasilppsi ?>
									</td>
									<td>
										<?php echo $item->hasilebis ?>
									</td>
									<td>
										<?php echo $item->Rekomendasi ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('.num').keyup(function () {
            if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
                this.value = this.value.replace(/[^0-9\.]/g, '');
            }
        });
        $('.num').number(true);
		$('#simpan').on('submit', function(e) {
			e.preventDefault();
			var $this = $(this);
			bootbox.confirm('Simpan?', function(r) {
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
							console.log(res);
							if(res.status === 'true') {
								bootbox.alert('Verifikasi Berhasil', function(a) {
									window.location.href = "index.php?page=pendaftarananggota";
								})
							} else {
								bootbox.alert('Terjadi kesalahan, silahkan hubungi admin!');
							}
						},
						complete: function() {
							$('#loading-state').fadeOut('slow');
						},
						error: function(error) {
							console.log(error);
						}
					})
				}
			})
		})
	})
</script>