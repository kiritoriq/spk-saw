<?php
	include('../../config/query.php');

	$nama = $_POST['nama'];
	// $email = $_POST['email'];
	$role_id = $_POST['role_id'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$q = new Query();
	if($_POST['ed'] != '1') {
		$input = $q->query("INSERT INTO users (id, nama, username, password, role_id, foto, created_at, updated_at) SELECT '', '".$nama."', '".$username."', '".$password."', '".$role_id."', 'avatar.png', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."'");
	} else {
		$input = $q->query("UPDATE users SET nama = '".$nama."', username = '".$username."', role_id = '".$role_id."', password = '".$password."' WHERE id = '".$_POST['id']."'");
	}
	if($input) {
		$rs = array(
			'status'=> 'true',
			'message' => 'Berhasil'
		);
	} else {
		$rs = array(
			'status'=> 'false',
			'message' => $input
		);
	}

	echo json_encode($rs);