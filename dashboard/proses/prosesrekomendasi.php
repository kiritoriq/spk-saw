<?php
    include('../../config/query.php');
    $q = new Query();
    $ids = $_POST['id'];
    $now = date('Y-m-d H:i:s');
    $i = 1;
						$A = array();
						foreach($ids as $id) {
							// array_push($A, $i);
							$sel = $q->query("SELECT a.*, b.nama FROM tr_nilairating a JOIN master_mhs b ON a.id_mhs = b.id WHERE a.id_mhs = '".$id."'");
							$item = $q->fetching_single($sel);
							// echo $item['id']."/".$item['nama'];
							$A[$i]['id'] = $item['id'];
							$A[$i]['nama'] = $item['nama'];
							$A[$i]['nim'] = $item['nim'];
							$A[$i]['C']['1'] = $item['C1'];
							$A[$i]['C']['2'] = $item['C2'];
							$A[$i]['C']['3'] = $item['C3'];
							$A[$i]['C']['4'] = $item['C4'];
							$A[$i]['C']['5'] = $item['C5'];
							$A[$i]['C']['6'] = $item['C6'];
							$A[$i]['C']['7'] = $item['C7'];
							$A[$i]['C']['8'] = $item['C8'];
							$A[$i]['C']['9'] = $item['C9'];
							$A[$i]['C']['10'] = $item['C10'];
							$i++;
						}
						$bobot = array();
						$b = 1;
						$selbobot = $q->query("SELECT bobot_ppsi, bobot_ebisnis FROM mast_makul");
						$store = $q->store($selbobot);
						foreach($store as $result => $i) {
							$bobot['ppsi']['C'.$b] = $i[0];
							$bobot['ebisnis']['C'.$b] = $i[1];
							$b++;
                        }
                        /* Hitung R dan V */
						$j = 1;
						foreach($A as $rs => $item) {
							for($k = 1; $k<11; $k++) {
								$max = max($A['1']['C'][$k], $A['2']['C'][$k], $A['3']['C'][$k], $A['4']['C'][$k], $A['5']['C'][$k]);
								$R = floatval($item['C'][$k]) / floatval($max);
								$A[$j]['R'][$k] = $R;
								$prefppsi = floatval($R)*floatval($bobot['ppsi']['C'.$k]);
								$prefebisnis = floatval($R)*floatval($bobot['ebisnis']['C'.$k]);
								$A[$j]['Vppsi'][$k] = $prefppsi;
								$A[$j]['Vebisnis'][$k] = $prefebisnis;
							}
						$j++;
						}
                        /* End of Hitung R dan V */
                        /* Hitung nilai Pref dan menentukan rekomendasi*/
						for($l=1;$l<=5;$l++) {
                            $nilaippsi = 0;
                            $nilaiebis = 0;
                                for($m=1;$m<11;$m++){
                                    $nilaippsi = floatval($nilaippsi)+floatval($A[$l]['Vppsi'][$m]);
                                    $nilaiebis = floatval($nilaiebis)+floatval($A[$l]['Vebisnis'][$m]);
                                }
                                $A[$l]['hasilppsi'] = $nilaippsi;
                                $A[$l]['hasilebis'] = $nilaiebis;
                                if(floatval($A[$l]['hasilppsi']) < floatval($A[$l]['hasilebis'])){
                                    $A[$l]['Rekomendasi'] = 'Ebisnis';
                                } else {
                                    $A[$l]['Rekomendasi'] = 'PPSI';
                                }
                            }
                            /* End of Hitung nilai Pref dan menentukan rekomendasi*/
    $a_baru = json_encode($A);
	$insert_hasil = $q->query("INSERT INTO tr_rekomendasi (id,data,created_at,updated_at) SELECT '', '".$a_baru."', '".$now."', ''");
	// $insert_hasil = true;
	$rec_id = $q->lastid();
    if($insert_hasil) {
        foreach($A as $rs => $i) {
            $insertdetail = $q->query("INSERT INTO detail_rekomendasi VALUES(DEFAULT, '".$rec_id."', '".$i['id']."', '".$i['nim']."', '".$i['Rekomendasi']."', '".$now."', '".$now."')");
        }
        $result = array(
            'status' => true,
			'msg' => "Berhasil",
        );
    } else {
        $result = array(
            'status' => false,
            'msg' => $insert_hasil
        );
    }
    
    echo json_encode($result);
?>