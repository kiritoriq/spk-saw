<?php
	include('../../../config/query.php');

	$id = $_POST['id'];
	$namabag = $_POST['namabagian'];
	$ket = $_POST['ket'];
	$date = date('Y-m-d H:i:s');
	$status = "";
	if(isset($_POST['status'])){
		$status = $_POST['status'];
	} else {
		$status = "1";
	}
	$output = "";
	$q = new Query();
	$sql = "UPDATE master_bagian SET namabag = '".$namabag."', ket = '".$ket."', status = '".$status."',updated_at = '".$date."' WHERE id='".$id."'";
	// $input = true;
	$input = $q->query($sql);
	if($input) {
		$output = "true";
	} else {
		$output = "false";
	}
	echo $output;
?>