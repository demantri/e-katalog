<?php 

class Cashflow extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('transaksi_model');
		$this->load->model('keuangan/Jurnal_model','m_jurnal');
		$this->load->model('keuangan/Rek_model', 'm_rek');
		//$this->load->model('asset/Aktiva_model', 'm_aktiva');
		//$this->load->model('asset/Kategori_model', 'm_kategori');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function cash_in(){
		$data['req'] = $this->transaksi_model->get_detail([
													'is_created' => '1',
													'level'   	 => '2',
													'jenis'		 => 'masuk'
												])->result_array();

		$data['list'] = $this->db->where('is_created', '1')
								 ->where('jenis','masuk')
								 ->where('level', '3')
								 ->or_where('level', '0')
								 ->get('transaksi')->result_array();

		$this->template->load('layout/template','transaksi/keuangan/cashflow/in/index', $data);
	}

	public function cash_out(){
		$data['req'] = $this->transaksi_model->get_detail([
													'is_created' => '1',
													'level'   	 => '2',
													'jenis'		 => 'keluar'
												])->result_array();

		$data['list'] = $this->db->where('is_created', '1')
								 ->where('jenis', 'keluar')
								 ->where('level', '3')
								 ->or_where('level', '0')
								 ->get('transaksi')->result_array();

		$this->template->load('layout/template','transaksi/keuangan/cashflow/out/index', $data);
	}

	public function cash_out_detail($transaksi_id){
		$perolehan = $this->transaksi_model->get_detail(['id' => $transaksi_id, 'jenis' => 'keluar']);
		
		if($perolehan->num_rows() > 0){
			$data['rek']   		= $this->m_rek->get_data();
			$data['transaksi']  = $perolehan->row_array();
			$data['item'] = $this->transaksi_model->get_list_item($data['transaksi']['tipe'], $data['transaksi']['id']);
			$data['pembayaran'] = $this->transaksi_model->get_list_pembayaran($data['transaksi']['id']);
			$this->template->load('layout/template','transaksi/keuangan/cashflow/out/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
			redirect('transaksi/review/cashflow');
		}
	}

	public function cash_in_detail($transaksi_id){
		$perolehan = $this->transaksi_model->get_detail(['id' => $transaksi_id, 'jenis' => 'masuk']);
		
		if($perolehan->num_rows() > 0){
			$data['transaksi']  = $perolehan->row_array();
			$i = 0;

			if($data['transaksi']['tipe'] != 'komponen_pendidikan'){
				$get_item = $this->transaksi_model->get_list_item($data['transaksi']['tipe'], $data['transaksi']['id']);
				foreach ($get_item as $key => $value) {
					$item[$i]['komponen'] = $row['nama_pemilik']; 
					$item[$i]['qty'] 	  = '1';
					$item[$i]['subtotal'] = $data['transaksi']['total_transaksi']; 
				}

			}else{
				$item[$i]['komponen'] = 'Pendaftaran'; 
				$item[$i]['qty'] 	  = '1';
				$item[$i]['subtotal'] = $data['transaksi']['total_transaksi']; 
			}

			$data['rek']   		= $this->m_rek->get_data();
			$data['item']       = $item;
			$this->template->load('layout/template','transaksi/keuangan/cashflow/in/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
			redirect('transaksi/review/cashflow');
		}
	}

	public function set_approval($set, $transaksi_id){
		if(in_array($set, ['approve', 'deny'])){

			$this->db->trans_begin();

			if($set == 'approve'){
				$p['metode']  = $this->input->post('metode');
				$p['level']   = '3';
				$p['keterangan_acc'] = $this->input->post('keterangan');

				$trans = $this->transaksi_model->get_detail('id', $transaksi_id)->row_array();

				if($trans['tipe'] == 'pinjaman'){
					$trans['total_bayar'] = $trans['total_transaksi'];
				}
				
				$this->transaksi_model->insert_pembayaran([
										'transaksi_id'  => $transaksi_id,
										'jumlah_bayar'  => $trans['total_bayar'],
										'tanggal_bayar' => date('Y-m-d H:i:s')
									]);

				$last = $this->transaksi_model->get_last_pembayaran($transaksi_id);

				if($p['metode'] == 'Transfer'){
					$rek['rek_id'] = $this->input->post('rek_id');
					$rek['transaksi_pembayaran_id'] = $last['id'];
					$this->m_rek->insert_history($rek);

					$detail_rek = $this->m_rek->get_detail('id', $rek['rek_id'])->row_array();

					if($trans['jenis'] == 'masuk'){
						$detail_rek['saldo'] += $trans['total_bayar'];
					}else{
						$detail_rek['saldo'] -= $trans['total_bayar'];
					}

					$this->m_rek->update(['saldo' => $detail_rek['saldo']], $rek['rek_id']);

					if($trans['pembayaran'] == 'Tunai'){
						$p['status'] = 'Lunas';
					
					}else{
						$p['status'] = 'Belum Lunas';
					}
				}

				//var_dump($p);

				if($trans['tipe'] == 'perolehan'){
					$this->generateAsset($transaksi_id);
					$this->generateJurnal($transaksi_id, $trans['tipe'], $trans['pembayaran'], $p['metode'], $trans['total_transaksi'], $trans);
				} 
				else if($trans['tipe'] == 'transaksi_beban'){
					$this->generateBeban($transaksi_id);
					$this->generateJurnal($transaksi_id, $trans['tipe'], $trans['pembayaran'], $p['metode'], $trans['total_transaksi'], $trans);
				}
				else if($trans['tipe'] == 'bop') {
					$this->generateJurnal($transaksi_id, $trans['tipe'], $trans['pembayaran'], $p['metode'], $trans['total_transaksi'], $trans);
				}

			}else{
				$p['level'] = '0';
				$p['keterangan_deny'] = 'Ditolak oleh Bagian Keuangan <br>'.$this->input->post('keterangan');
			}

			$this->transaksi_model->update($p, $transaksi_id);

			if($this->db->trans_status()){
				$this->db->trans_commit();
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Status Berhasil diubah','success'));

			}else{
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Status gagal diubah','success'));
			}

			if($trans['jenis'] == 'masuk'){
				$jenis = 'cash_in';
			}else{
				$jenis = 'cash_out';
			}
			
			redirect('transaksi/keuangan/'.$jenis.'/detail/'.$transaksi_id);

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Transaksi tidak diketahui','danger'));
			redirect('transaksi/review/cashflow');
		}
	}

		private function generateAsset($transaksi_id){
			$this->db->select('*, transaksi_aset.id AS transaksi_aset_id')
					 ->where('transaksi_id', $transaksi_id)
					 ->join('a_aset', 'a_aset.id = transaksi_aset.aset_id');

			$trans = $this->db->get('transaksi_aset')->result_array();

			foreach ($trans as $row){
				$this->db->select('COUNT(id) AS total')
						 ->where('aset_id', $row['aset_id'])
						 ->group_by('aset_id');

				$start = $this->db->get('a_aset_detail')->result_array();

				$n = 0;
				foreach ($start as $row2) { $n++; $num = $row2['total'] + 1;
					for ($i = $num; $i < ($num + $row['jumlah']); $i++){ 
						$aset[$i]['transaksi_aset_id'] = $row['transaksi_aset_id'];
						$aset[$i]['aset_id']		   = $row['aset_id'];
						$aset[$i]['kode_detail_aset']  = $row['kode_aset']."-".$i;
					}
				}

				if($n == 0){
					$k = 0;
					for ($i=0; $i < $row['jumlah']; $i++) { $k++;
						$aset[$i]['transaksi_aset_id'] = $row['transaksi_aset_id'];
						$aset[$i]['aset_id']		   = $row['aset_id'];
						$aset[$i]['kode_detail_aset']  = $row['kode_aset']."-".$k;
					}
				}
			}

			//echo "<pre>".print_r($aset, true)."</pre>";
			$this->db->insert_batch('a_aset_detail', $aset);
		}

		private function generateBeban($transaksi_id){
			$this->db->select('*, transaksi_beban.id AS transaksi_beban_id')
					 ->where('transaksi_id', $transaksi_id)
					 ->join('k_beban', 'k_beban.id = transaksi_beban.id');

			$trans = $this->db->get('transaksi_beban')->result_array();
		}

		private function generateBOP($transaksi_id){
			$this->db->select('*, transaksi_bop.id AS transaksi_id')
					 ->where('transaksi_id', $transaksi_id)
					 ->join('transaksi', 'transaksi.id = transaksi_bop.transaksi_id');
			$trans = $this->db->get('transaksi_bop')->result_array();
		}

		private function generateJurnal($transaksi_id, $tipe, $pembayaran, $metode, $nominal, $trans = ''){
			$waktu_jurnal = date('Y-m-d H:i:s');

			if($tipe == 'perolehan'){
				if($pembayaran == 'Tunai'){
					if($metode == 'Transfer'){
						$jurnal[0]['coa_id'] 	   = '2'; //Aktiva Tetap
						$jurnal[0]['transaksi_id'] = $transaksi_id;
						$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[0]['posisi']	   = 'd';
						$jurnal[0]['nominal']      = $trans['total_transaksi'];

						$jurnal[1]['coa_id'] 	   = '3'; //Bank
						$jurnal[1]['transaksi_id'] = $transaksi_id;
						$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[1]['posisi']	   = 'k';
						$jurnal[1]['nominal']      = $trans['total_transaksi'];
					
					}else{
						$jurnal[0]['coa_id'] 	   = '2'; //Aktiva Tetap
						$jurnal[0]['transaksi_id'] = $transaksi_id;
						$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[0]['posisi']	   = 'd';
						$jurnal[0]['nominal']      = $trans['total_transaksi'];

						$jurnal[1]['coa_id'] 	   = '1'; //Kas
						$jurnal[1]['transaksi_id'] = $transaksi_id;
						$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[1]['posisi']	   = 'k';
						$jurnal[1]['nominal']      = $trans['total_transaksi'];
					}
				
				}else{
					$jurnal[0]['coa_id'] 	   = '2'; //Aktiva Tetap
					$jurnal[0]['transaksi_id'] = $transaksi_id;
					$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[0]['posisi']	   = 'd';
					$jurnal[0]['nominal']      = $trans['total_transaksi'];

					$jurnal[1]['coa_id'] 	   = '1'; // Kas
					$jurnal[1]['transaksi_id'] = $transaksi_id;
					$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[1]['posisi']	   = 'k';
					$jurnal[1]['nominal']      = $trans['total_bayar'];

					$jurnal[2]['coa_id'] 	   = '4'; //Utang
					$jurnal[2]['transaksi_id'] = $transaksi_id;
					$jurnal[2]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[2]['posisi']	   = 'k';
					$jurnal[2]['nominal']      = $trans['sisa_bayar'];
				}
				
			}else if($tipe == 'setoran'){
				$jurnal[0]['coa_id'] 	   = '5'; //Modal
				$jurnal[0]['transaksi_id'] = $transaksi_id;
				$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
				$jurnal[0]['posisi']	   = 'd';
				$jurnal[0]['nominal']      = $nominal;

				$jurnal[1]['coa_id'] 	   = '1'; //Kas
				$jurnal[1]['transaksi_id'] = $transaksi_id;
				$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
				$jurnal[1]['posisi']	   = 'k';
				$jurnal[1]['nominal']      = $nominal;
			
			}else if($tipe == 'penarikan'){
				$jurnal[0]['coa_id'] 	   = '1'; //Kas
				$jurnal[0]['transaksi_id'] = $transaksi_id;
				$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
				$jurnal[0]['posisi']	   = 'd';
				$jurnal[0]['nominal']      = $nominal;

				$jurnal[1]['coa_id'] 	   = '5'; //Modal
				$jurnal[1]['transaksi_id'] = $transaksi_id;
				$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
				$jurnal[1]['posisi']	   = 'k';
				$jurnal[1]['nominal']      = $nominal;

			}else if($tipe == 'transaksi_beban'){
				if ($pembayaran == 'Tunai') {
					if ($metode == 'Transfer') {
						$jurnal[0]['coa_id'] 	   = '11'; //Aktiva Tetap
						$jurnal[0]['transaksi_id'] = $transaksi_id;
						$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[0]['posisi']	   = 'd';
						$jurnal[0]['nominal']      = $trans['total_transaksi'];

						$jurnal[1]['coa_id'] 	   = '3'; //Bank
						$jurnal[1]['transaksi_id'] = $transaksi_id;
						$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[1]['posisi']	   = 'k';
						$jurnal[1]['nominal']      = $trans['total_transaksi'];
					} else {
						$jurnal[0]['coa_id'] 	   = '11'; // BEBAN ATK
						$jurnal[0]['transaksi_id'] = $transaksi_id;
						$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[0]['posisi']	   = 'd';
						$jurnal[0]['nominal']      = $trans['total_transaksi'];

						$jurnal[1]['coa_id'] 	   = '1'; //KAS
						$jurnal[1]['transaksi_id'] = $transaksi_id;
						$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[1]['posisi']	   = 'k';
						$jurnal[1]['nominal']      = $trans['total_transaksi'];
					}
				} else {
					if ($metode == 'Transfer') {
						$jurnal[0]['coa_id'] 	   = '11'; //BEBAN
						$jurnal[0]['transaksi_id'] = $transaksi_id;
						$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[0]['posisi']	   = 'd';
						$jurnal[0]['nominal']      = $trans['total_transaksi'];

						$jurnal[1]['coa_id'] 	   = '3'; // bank
						$jurnal[1]['transaksi_id'] = $transaksi_id;
						$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[1]['posisi']	   = 'k';
						$jurnal[1]['nominal']      = $trans['total_bayar'];

						$jurnal[2]['coa_id'] 	   = '4'; //Utang
						$jurnal[2]['transaksi_id'] = $transaksi_id;
						$jurnal[2]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[2]['posisi']	   = 'k';
						$jurnal[2]['nominal']      = $trans['sisa_bayar'];
					} else {
						$jurnal[0]['coa_id'] 	   = '11'; //beban
						$jurnal[0]['transaksi_id'] = $transaksi_id;
						$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[0]['posisi']	   = 'd';
						$jurnal[0]['nominal']      = $trans['total_transaksi'];

						$jurnal[1]['coa_id'] 	   = '1'; // Kas
						$jurnal[1]['transaksi_id'] = $transaksi_id;
						$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[1]['posisi']	   = 'k';
						$jurnal[1]['nominal']      = $trans['total_bayar'];

						$jurnal[2]['coa_id'] 	   = '4'; //Utang
						$jurnal[2]['transaksi_id'] = $transaksi_id;
						$jurnal[2]['waktu_jurnal'] = $waktu_jurnal;
						$jurnal[2]['posisi']	   = 'k';
						$jurnal[2]['nominal']      = $trans['sisa_bayar'];
					}
				}

			}else if($tipe == 'bop'){
				if ($metode == 'Cash') {
					$jurnal[0]['coa_id'] 	   = '12'; //Aktiva Tetap
					$jurnal[0]['transaksi_id'] = $transaksi_id;
					$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[0]['posisi']	   = 'd';
					$jurnal[0]['nominal']      = $trans['total_transaksi'];

					$jurnal[1]['coa_id'] 	   = '1'; //Bank
					$jurnal[1]['transaksi_id'] = $transaksi_id;
					$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[1]['posisi']	   = 'k';
					$jurnal[1]['nominal']      = $trans['total_transaksi'];
				} else {
					$jurnal[0]['coa_id'] 	   = '2'; //Aktiva Tetap
					$jurnal[0]['transaksi_id'] = $transaksi_id;
					$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[0]['posisi']	   = 'd';
					$jurnal[0]['nominal']      = $trans['total_transaksi'];

					$jurnal[1]['coa_id'] 	   = '1'; //Kas
					$jurnal[1]['transaksi_id'] = $transaksi_id;
					$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[1]['posisi']	   = 'k';
					$jurnal[1]['nominal']      = $trans['total_transaksi'];
				}
			}

			$this->m_jurnal->insert_multiple($jurnal);
		}
    
}