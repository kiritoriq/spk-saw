<?php
	include('../../config/query.php');

	$id = $_POST['id'];
	$q = new Query();
	$del = $q->query("DELETE FROM users WHERE id = '".$id."'");
	if($del) {
		$res = array(
			'status' => 'true',
			'message' => 'Berhasil'
		);
	} else {
		$res = array(
			'status' => 'false',
			'message' => $del
		);
	}

	echo json_encode($res);