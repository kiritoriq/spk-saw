<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Data Rekomendasi Mahasiswa
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Laporan</li>
		<li class="active">Data Rekomendasi Mahasiswa</li>
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
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
							<thead class="bg-primary">
								<tr>
									<!-- <th width="3%">
										<input type="checkbox" name="checkall" id="checkall" class="checkall" value="1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pilih Semua">
										Pilih
									</th> -->
									<th width="2%">No.</th>
				                  	<th>NIM</th>
				                  	<th>Nama Mahasiswa</th>
				                  	<th>Rekomendasi</th>
				                  	<!-- <th>PRESENTASE PEMINAT PPSI</th>
				                  	<th>PRESENTASE PEMINAT EBISNIS</th> -->
					                <!-- <th>DETAIL</th> -->
					                <!-- <th>PRODI</th> -->
				                </tr>
							</thead>
							<tbody>
							<?php
                                $q = new Query();
                                $j = 1;
                                $i = 0;
                                $rekmhs = $q->query("SELECT b.nim, a.nama, b.rekomendasi FROM master_mhs a JOIN detail_rekomendasi b ON a.id = b.id_mhs");
                                $store = $q->store($rekmhs);
								foreach($store as $rs => $mhs) {
                                    $i++;
									echo "<tr>
											<td>".$j."</td>
											<td>".$mhs['nim']."</td>
											<td>".$mhs['nama']."</td>
											<td>".$mhs['rekomendasi']."</td>
                                        </tr>";
                                        $j++;
								}
							?>
							</tbody>
                            <tfoot>
                                <tr style="background-color: #3333;">
                                   <td colspan="3" align="right"><h5><strong>Jumlah</strong></h5></td>
                                   <td align="right"><h5><strong><?php echo $i; ?></strong></h5></td> 
                                </tr>
                            </tfoot>
						</table>
						<p style="height: 50px;">&nbsp;</p>
				</div>
				
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('#table1').dataTable();
		// getinput();
		// $('.text-upper').css('text-transform', 'uppercase');

		var limit = 5;

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