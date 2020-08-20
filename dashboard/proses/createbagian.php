<?php
	include('../../../config/query.php');

	$namabag = $_POST['namabagian'];
	$ket = $_POST['ket'];
	$date = date('Y-m-d H:i:s');
	$output = "";
	$q = new Query();
	$sql = "INSERT INTO master_bagian VALUES('', '".$namabag."', '".$ket."', '".$date."', '".$date."')";
	// $input = true;
	$input = $q->query($sql);
	if($input) {
		$output = "true";
	} else {
		$output = "false";
	}
	echo $output;
?>