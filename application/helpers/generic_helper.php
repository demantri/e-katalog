<?php
	function toDatatable($data,$totalData){	
		$output = array(
			'draw' => intval($_POST['draw']),
			'recordsTotal' => $totalData,
			'recordsFiltered' => $totalData,
			'data' => $data
		);
		return $output;
	}

	function show_alert($message, $status){
		return '<div class="alert alert-'.$status.' alert-dismissible">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  '.$message.'
				</div>';
	}

	function show_tipe_transaksi($tipe, $opt = ''){
		if($tipe == 'perolehan'){
         $prefix = "Perolehan";

	    }else if($tipe == 'setoran'){
	         $prefix = "Setoran Pemilik";

	    }else if($tipe == 'penarikan'){
	         $prefix = 'Penarikan Pemilik';
	      
	    }else if($tipe == 'bop'){
	         $prefix = 'BOP';
	      
	    }else if($tipe == 'bank'){
	    	if($opt == 'masuk'){
	    		$prefix = 'Setoran Bank Masuk';
	    	}else{
	        	$prefix = 'Setoran Bank Keluar';
	    	}

	    }else if($tipe == 'tabungan_siswa'){
	         $prefix = 'Tabungan Siswa';
	    
	    }else if($tipe == 'komponen_pendidikan'){
	    	$prefix = 'Komponen Pembayaran Pendaftaran';

	    }else if($tipe == 'komponen_operasional'){
	    	$prefix = 'Komponen Pembayaran Bulanan';
	    
	    }else if($tipe == 'undur_diri'){
	    	$prefix = 'Undur Diri Siswa';
	    
	    }else if($tipe == 'pinjaman'){
	    	$prefix = 'Pinjaman Karyawan';

	    }else if($tipe == 'transaksi_beban'){
	    	$prefix = 'Transaksi Beban';
	    }

	    return $prefix;
	}

	function show_level($lv){
		if($lv == '0'){
			$msg = '<span class="badge badge-danger"><i class="fa fa-ban"></i> Ditolak</span>';
		
		}else if($lv == '1'){
			$msg = '<span class="badge badge-info"><i class="fa fa-clock"></i> Pending</span>';

		}else if($lv == '2'){
			$msg = '<span class="badge badge-primary"><i class="fa fa-clock"></i> Menunggu Acc</span>';
		
		}else if($lv == '3'){
			$msg = '<span class="badge badge-success"><i class="fa fa-check"></i> Disetujui</span>';
		}

		return $msg;
	}

	function generateRandom($n){ 
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	    $randomString = ''; 
	  
	    for ($i = 0; $i < $n; $i++) { 
	        $index = rand(0, strlen($characters) - 1); 
	        $randomString .= $characters[$index]; 
	    } 
	  
	    return $randomString; 
	} 

	function searchKey($array, $key, $value){
	    $results = [];

	    if (is_array($array)) {
	        if (isset($array[$key]) && $array[$key] == $value) {
	            $results[] = $array;
	        }

	        foreach ($array as $subarray) {
	            $results = array_merge($results, searchKey($subarray, $key, $value));
	        }
	    }

	    return $results;
	}

	function diffMonth($date1, $date2){

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        return str_replace('-', '',  $diff);
	}

	function calculatePenyusutan($harga_asset, $residu, $masa_pakai, $tgl_perolehan, $jumlah, $diff = ''){
	    $num = 0;

	    $tgl = substr($tgl_perolehan, 8, 2);
	    $bln = substr($tgl_perolehan, 5, 2);
	    $num = $bln;

	    if($tgl >= '15'){
	      $num = $num + 1;

	      if($bln == '12'){
	        $num = 1;
	      }
	    }

	     $num = 12 - $num;

	    if($diff != '' || $diff == 0){
	    	$harga_penyusutan = (($harga_asset - $residu) / (($masa_pakai * 12) - $diff));
	    }else{
	    	$harga_penyusutan = ($num / 12) * (($harga_asset - $residu) / $masa_pakai);
	    }

	   
	    //$total_penyusutan = ($harga_asset - $harga_penyusutan) * $jumlah;
	    return $harga_penyusutan; 
  }
