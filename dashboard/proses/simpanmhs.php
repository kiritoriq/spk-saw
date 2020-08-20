<?php

	include '../../config/query.php';
	$q = new Query();
	$fak = $_POST['fak'];
	$th = $_POST['th'];
	$noinduk = $_POST['noinduk'];
	$nama = $_POST['nama'];
	$nilai = array(
		'C1' => floatval($_POST['C1']),
		'C2' => floatval($_POST['C2']),
		'C3' => floatval($_POST['C3']),
		'C4' => floatval($_POST['C4']),
		'C5' => floatval($_POST['C5']),
		'C6' => floatval($_POST['C6']),
		'C7' => floatval($_POST['C7']),
		'C8' => floatval($_POST['C8']),
		'C9' => floatval($_POST['C9']),
		'C10' => floatval($_POST['C10']),
	);

	$rating = array();
	foreach($nilai as $c) {
		$r = $q->convertRating($c);
		array_push($rating, $r);
	}

	$sel = $q->query("SELECT * FROM master_mhs WHERE no_induk = '".$noinduk."'");
	
	if($sel->num_rows == 0) {
		$inputmhs = $q->query("INSERT INTO master_mhs VALUES(DEFAULT, '".$nama."', '".$fak."', '".$th."', '".$noinduk."', '".$nilai['C1']."', '".$nilai['C2']."', '".$nilai['C3']."', '".$nilai['C4']."', '".$nilai['C5']."', '".$nilai['C6']."', '".$nilai['C7']."', '".$nilai['C8']."', '".$nilai['C9']."', '".$nilai['C10']."', '".date('Y-m-d H:i:s')."', DEFAULT)");
		$last_id = $q->lastid();
		if($inputmhs) {
			$inputrating = $q->query("INSERT INTO tr_nilairating VALUES(DEFAULT, '".$last_id."', '".$fak.".".$th.".".$noinduk."', '".$rating[0]."', '".$rating[1]."', '".$rating[2]."', '".$rating[3]."', '".$rating[4]."', '".$rating[5]."', '".$rating[6]."', '".$rating[7]."', '".$rating[8]."', '".$rating[9]."', '".date('Y-m-d H:i:s')."', DEFAULT)");
			if($inputrating) {
				$rs = array(
					'status' => 'true',
					'message' => 'berhasil',
					'nim' => $fak.".".$th.".".$noinduk
				);
			}
		}
	} else {
		$rs = array(
			'status' => 'false',
			'message' => 'No. induk sudah ada'
		);
	}

	echo json_encode($rs);

?>