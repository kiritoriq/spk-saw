<section class="content-header">
	<h1>
		Input Data Mahasiswa
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Master Data</li>
		<li>Data Mahasiswa</li>
		<li class="active">Buat Baru</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border">
				</div>
				<form id="simpan" class="form-horizontal" method="POST" action="proses/simpanmhs.php">
					<div class="box-body">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label col-sm-3">Nomor Induk Mahasiswa:</label>
								<div class="col-sm-1">
									<input type="text" class="form-control" name="fak" value="A12" readonly>
								</div>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="th" maxlength="4" placeholder="Tahun Masuk (angkatan)">
								</div>
								<div class="col-sm-2">
									<input type="text" class="form-control" name="noinduk" maxlength="5" placeholder="Nomor induk Mahasiswa" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-3">Nama Lengkap:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="nama" placeholder="Masukkan nama Mahasiswa" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2 control-label"></label>
								<div class="col-md-6">
									<table id="tabel" class="table table-bordered table-striped">
										<thead class="bg-primary">
											<tr>
												<th width="20%">Kode MK</th>
												<th >Mata Kuliah</th>
												<th width="15%">Nilai MK</th>
											</tr>
										</thead>
										<?php
											include('../../config/query.php');
											$q = new Query();
											$makul = $q->query("SELECT * FROM mast_makul");
											$store = $q->store($makul);
										?>
										<tbody>
											<?php 
												foreach($store as $rs => $i) {
													echo "<tr>
															<td>".$i[1]."</td>
															<td>".$i[2]."</td>
															<td>
																<div align='center'>
																	<input type='text' id='".$i[1]."' name='".$i[1]."' class='num titik score form-control' maxlength='5' style='text-align: right;' required>
																</div>
															</td>
														</tr>";
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="callout callout-warning">
								<h4><i class="fa fa-warning"></i> Perhatian!</h4>
								<ul>
									<li>Harap mengisikan nilai pada kolom nilai hanya dengan angka!</li>
									<li>Masukkan nilai dengan bilangan desimal 1 angka dibelakang koma, contoh: (85.5)</li>
									<li>Isikan nilai dengan menggunakan titik (.) sebagai pemisah bilangan desimal</li>
									<li>Nilai dengan rentang lebih dari 100 akan dikonversi menjadi 0 - 100</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-7">
		                        <button type="submit" id="tombolsimpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
		                        &nbsp;
		                        &nbsp;
		                        <a href="index.php?page=daftarbagian" class="btn btn-warning"><i class="fa fa-times-circle-o"></i> Batal</a>
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
		$('.tgl').datetimepicker({
			format: "DD-MM-YYYY",
			defaultDate: "01/01/1970" 
		});

		$('.num').keyup(function () {
	        if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
	           this.value = this.value.replace(/[^0-9\.]/g, '');
	        }
	    });
	
		$(".titik").keyup(function() {
			var input = $(this),
			text = input.val().replace(",", ".");
			input.val(text);
		});

		$('.score').each(function(index) {
			console.log(index+1);
			var i = index+1;
			$('#C'+i).keyup(function(e) {
				e.preventDefault();
				var nilai = parseFloat($(this).val()) || 0;

				if(nilai > 100) { nilai = nilai / 10; $('#C'+i).val(nilai.toFixed(1)); }
			})
		});

		$('input').css('text-transform', 'uppercase');
		$('#simpan').on('submit', function(e) {
			var $this = $(this);
			e.preventDefault();
			bootbox.confirm('Simpan?', function(r) {
				if(r){
					$.ajax({
						url: $this.attr('action'),
						type: 'POST',
						data: $this.serialize(),
						success: function(response) {
							var res = JSON.parse(response);
							console.log(res);
							if(res.status === "true"){
								bootbox.alert('Berhasil Disimpan', function() {
									window.location.href = 'index.php?page=datamhs';
								});
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
				} else {

				}
			})
		})
	})
</script>