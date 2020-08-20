<?php
	include "../../../config/query.php";
	session_start();
	$id_anggota = $_POST['id'];
	$nama = $_POST['nama'];
	$nipp = $_POST['nipp'];
	$unitpinjam = $_POST['unit_pinjam'];
	$besarpinjam = $_POST['besar_pinjaman'];
	$masaangsur = $_POST['masa_pinjam'];
	$ket = $_POST['ket'];
	$jmlangsur = $_POST['angsuran'];
	$now = date('Y-m-d H:i:s');
	$bunga = (int)$besarpinjam * 0.01;
	$jmlangsurfix = (int)$jmlangsur + (int)$bunga;

	$q = new Query();
	if(isset($_POST['status'])) {
		$update = $q->query("UPDATE tr_pinjam SET status = '".$_POST['status']."', updated_at = '".$now."' WHERE id = '".$_POST['id']."'");
		if($update){
			$res = array(
				'status' => 'true',
				'message' => 'Berhasil update'
			);
		} else {
			$res = array(
				'status' => 'false',
				'message' => $update
			);
		}
	} else {
		$sql = "INSERT INTO tr_pinjam VALUES('','".$id_anggota."', '".$unitpinjam."', '".$nama."', '".$besarpinjam."', '".$masaangsur."', '".$ket."', '".$jmlangsurfix."', '0', '".$_SESSION['user_id']."', '".$_SESSION['role_id']."', '".$now."', '".$now."')";
		$input = $q->query($sql);
		if($input) {
			$id = $q->lastid();
			$sqlsurat = "INSERT INTO tr_pernyataandiri VALUES('', '".$id."', '".$id_anggota."', '".$nama."', '1', '".$now."', '".$now."')";
			$inputsurat = $q->query($sqlsurat);
			if($inputsurat) {
				$res = array(
					'status' => 'true',
					'message' => 'success'
				);
			} else {
				$res = array(
					'status' => 'false',
					'message' => $inputsurat
				);
			}
			$res = array(
					'status' => 'true',
					'message' => 'success'
				);
		} else {
			$res = array(
					'status' => 'false',
					'message' => $input
				);
		}		
	}


	echo json_encode($res);
?>