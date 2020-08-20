<?php
	session_start();
	include('../config/query.php');

	// $email = $_POST['email'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$q = new Query();
	// $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";
	$sql = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
	$select = $q->query($sql);
	$count = $select->num_rows;
	$store = $q->store($select);

	if($count > 0){
		foreach ($store as $rs => $i) {
			$_SESSION['email'] = $i[2];
			$_SESSION['user_id'] = $i[0];
			$_SESSION['name'] = $i[1];
			$_SESSION['status'] = "logged in";
			$_SESSION['role_id'] = $i[5];
				$sqlrole = "SELECT * FROM roles WHERE id = '".$i[5]."'";
				$select_role = $q->query($sqlrole);
				$data = $q->fetching_single($select_role);
			$_SESSION['role'] = $data['role'];
			$_SESSION['image'] = $i[6];
			header('location:../dashboard');				
		}
	} else {
		header('location:index.php?pesan=gagal');
	}
?>