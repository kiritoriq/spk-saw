<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Users
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li>Setting</li>
		<li class="active">Users</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="row">
			<div class="col-md-12">
				<div class="box-header with-border">
					<!-- <h4 class="box-title">Daftar Simpan</h4> -->
					<button id="tambah" type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Buat Baru</button>
				</div>
				<div class="box-body">
					<table id="table1" class="table table-bordered table-striped">
						<thead class="bg-primary">
							<tr>
			                  <th>Nama</th>
			                  <!-- <th>Email</th> -->
			                  <th>Username</th>
			                  <th>Role</th>
			                  <th>Aksi</th>
			                </tr>
						</thead>
						<tbody>
							<?php 
								$q = new Query();
								$sel = $q->query("SELECT * FROM users ORDER BY created_at DESC");
								$store = $q->store($sel);
								foreach($store as $rs => $i) {
									$roles = $q->query("SELECT * FROM roles WHERE id = '".$i[5]."'");
									$item = $q->fetching_single($roles); 
									// <td>".$i[2]."</td>
									echo "<tr>
											<td>".$i[1]."</td>
											<td>".$i[3]."</td>
											<td>".$item['role']."</td>
											<td>
												<div class='btn-group'>
						                          <button data-toggle='dropdown' class='btn btn-default dropdown-toggle' type='button' aria-expanded='false'>
						                          <span class='caret'></span> Aksi
						                          </button>
						                          <ul class='dropdown-menu pull-right'>
						                          	".(($i[0]!=1)?'<li><a class="edit" href="" id="edit" data-recid="'.$i[0].'"><i class="fa fa-pencil"></i> Edit</a></li><li><a class="hapus" href="" data-recid="'.$i[0].'"><i class="fa fa-times"></i> Hapus</a></li>':'<li><i class="fa fa-times"></i> Tidak ada Aksi yang dapat dilakukan</li>')."
						                            
						                          </ul>
						                        </div>
											</td>
											</tr>";
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('#table1').DataTable();
		// getinput();
		// $('.text-upper').css('text-transform', 'uppercase');

		$('#tambah').on('click', function(e) {
			e.preventDefault();
			$.ajax({
				url: 'page/createusers.php',
				type: 'get',
				beforeSend: function() {
					$('#loading-state').fadeIn('slow');
				},
				success: function(response) {
					$('#utama').html(response);
				},
				complete: function() {
					$('#loading-state').fadeOut('slow');
				}
			})
		})

		//Edit User
		$('.edit').on('click', function(e) {
			e.preventDefault();
			var id = $(this).data('recid');
			bootbox.confirm('Yakin Hapus?', function(r) {
				if(r) {
					$.ajax({
						url: 'page/createusers.php',
						type: 'post',
						data: {'id': id},
						beforeSend: function() {
							$('#loading-state').fadeIn('slow');
						},
						success: function(response) {
							$('#utama').html(response);
						},
						complete: function() {
							$('#loading-state').fadeOut('slow');
						}
					})
				}
			})
		})

		//Hapus User
		$('.hapus').on('click', function(e) {
			e.preventDefault();
			var id = $(this).data('recid');
			bootbox.confirm('Yakin Hapus?', function(r) {
				if(r) {
					$.ajax({
						url: 'proses/deleteuser.php',
						type: 'post',
						data: {'id': id},
						success: function(response) {
							var res = JSON.parse(response);
							console.log(res);
							if(res.status === 'true') {
								bootbox.alert('Berhasil dihapus', function() {
									window.location.href = 'index.php?page=user';
								});
							} else {
								bootbox.alert('Terjadi Kesalahan, hubungi admin!');
							}
						}
					})
				}
			})
		})
	})
</script>