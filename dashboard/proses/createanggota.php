<?php

	include '../../../config/query.php';
	session_start();
	$status = $_POST['status'];
	$id = $_POST['id'];
	$nik = $_POST['nik'];
	$gaji = $_POST['gaji'];
	$username = $_POST['username'];
	$pasori = $_POST['password'];
	$password = md5($_POST['password']);
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$tmplahir = $_POST['tmplahir'];
	$tgllahir = date('Y-m-d', strtotime($_POST['tgllahir']));
	$jenkel = $_POST['jenkel'];
	$alamat = $_POST['alamat'];
	$nipp = $_POST['nipp'];
	$instansi = $_POST['instansi'];
	$telprumah = $_POST['telprumah'];
	$telphp = $_POST['telphp'];
	$now = date('Y-m-d H:i:s');

	$q = new Query();
	$sql = "UPDATE tr_calonanggota SET is_aktif = '1' WHERE id = '".$id."'";
	$update = $q->query($sql);
	if($update) {
		$sqlinput = "INSERT INTO tr_anggota VALUES('', '".$nik."','".$nama."', '".$email."','".$tmplahir."', '".$tgllahir."', '".$jenkel."', '".$alamat."', '".$telprumah."', '".$telphp."', '".$status."', '".$nipp."', '".$instansi."', '1', '".$username."', '".$pasori."','".$_SESSION['user_id']."', '".$_SESSION['role_id']."','".$now."', '".$now."', '')";
		$input = $q->query($sqlinput);
		if($input) {
			$sqluser = "INSERT INTO users VALUES('','".$nama."', '".$email."', '".$username."', '".$password."', '20', 'avatar.png', '".$now."', '".$now."')";
			$inputuser = $q->query($sqluser);
			if($inputuser) {
				$res = array(
					'status' => 'true',
					'message' => 'Penyimpanan sukses'
				);
			} else {
				$res = array(
					'status' => 'false',
					'message' => $inputuser
				);
			}
		} else {
			$res = array(
					'status' => 'false',
					'message' => $input
				);
		}
	} else {
		$res = array(
			'status' => 'false',
			'message' => $update
		);
	}

	echo json_encode($res);

?>