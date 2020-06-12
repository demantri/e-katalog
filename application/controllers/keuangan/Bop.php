<?php 

class Bop extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('transaksi_model');
		$this->load->model('keuangan/Jurnal_model','m_jurnal');
		$this->load->model('keuangan/Rek_model', 'm_rek');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function bop_masuk(){
		$data['list'] = $this->db->where('is_created', '1')
								 ->where('jenis','masuk')
								 ->where('tipe', 'bop')
								 ->where('level', '3')
								 ->get('transaksi')->result_array();

		$data['last_code'] = $this->transaksi_model->generate_code('bop');
		$data['rek']	   = $this->m_rek->get_data();
		$this->template->load('layout/template','transaksi/keuangan/bop/in/index', $data);
	}

	public function add_bop(){
		$p = $this->input->post();
		$p['total_transaksi'] = format_angka($p['total_transaksi']);
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('total_transaksi', 'Nominal', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('rek_id', 'Rekening', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if($this->form_validation->run() == TRUE){

			if(strtotime($p['jangka_waktu']) > strtotime($p['tanggal_transaksi'])){
				$this->db->trans_begin();
				$rek_id = $p['rek_id'];
				unset($p['rek_id']);

				$p['tipe']  		= 'bop';
				$p['jenis']  		= 'masuk';
				$p['pembayaran'] 	= 'Tunai';
				$p['metode']	 	= 'Transfer';
				$p['level']		 	= '3';
				$p['total_bayar'] 	= $p['total_transaksi'];
				$p['sisa_bayar']  	= '0';
				$p['status']	  	= 'Lunas';
				$p['is_created']  	= '1';

				$this->transaksi_model->insert($p);

				$trans = $this->transaksi_model->last_data('bop');
				$this->transaksi_model->insert_pembayaran([
											'transaksi_id'  => $trans['id'],
											'jumlah_bayar'  => $trans['total_bayar'],
											'tanggal_bayar' => $trans['tanggal_transaksi']
										]);
				$last = $this->transaksi_model->get_last_pembayaran($trans['id']);
				$rek = [
					'rek_id' 				  => $rek_id,
					'transaksi_pembayaran_id' => $last['id']
				];
				$this->m_rek->insert_history($rek);

				$detail_rek = $this->m_rek->get_detail('id', $rek_id)->row_array();
				$detail_rek['saldo'] += $trans['total_bayar'];

				$this->m_rek->update(['saldo' => $detail_rek['saldo']], $rek_id);

				if($this->db->trans_status()){
					$this->db->trans_commit();
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
				}else{
					$this->db->trans_rollback();
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Tanggal Jangka waktu harus diatas tanggal penerimaan','warning'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('transaksi/keuangan/bop_in');
	}

	public function bop_keluar(){
		$data['list'] = $this->db->where('is_created', '1')
								 ->where('jenis','masuk')
								 ->where('tipe', 'bop')
								 ->where('level', '3')
								 ->get('transaksi')->result_array();
								 // print_r($data['list']); die;
		$this->template->load('layout/template','transaksi/keuangan/bop/out/index', $data);
	}

	public function bop_keluar_detail($transaksi_id){
		$trans = $this->transaksi_model->get_detail(['id' => $transaksi_id, 'jenis' => 'masuk']);
		// print_r($trans);die;
		if($trans->num_rows() > 0){
			$data['rek']   		= $this->m_rek->get_data();
			$data['transaksi']  = $trans->row_array();
			$data['item'] 		= $this->transaksi_model->get_list_item($data['transaksi']['tipe'], $data['transaksi']['id']);
			$data['total_penggunaan'] = $this->transaksi_model->get_total_list_item($data['transaksi']['tipe'], $data['transaksi']['id']);
			// print_r($data['transaksi']); die;
			$this->template->load('layout/template','transaksi/keuangan/bop/out/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
			redirect('transaksi/keuangan/bop_out');
		}
	}

	public function add_bop_keluar($transaksi_id){
		$p = $this->input->post();
		// print_r($p);die;	
		unset($p['kode_transaksi']);

		if(isset($p['rek_id'])){
			$rek_id = $p['rek_id'];
			unset($p['rek_id']);
		}

		$p['transaksi_id'] 		  = $transaksi_id;
		$p['subtotal'] 			  = format_angka($p['subtotal']);
		$p['tanggal_pengeluaran'] = date('Y-m-d');

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('subtotal', 'Nominal', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('keterangan_pengeluaran', 'Keterangan', 'required');

		if($this->form_validation->run() == TRUE){

			$this->db->trans_begin();

			$this->transaksi_model->insert_bop_keluar($p);

			$this->transaksi_model->insert_pembayaran([
										'transaksi_id'  => $transaksi_id,
										'jumlah_bayar'  => $p['subtotal'],
										'tanggal_bayar' => date('Y-m-d')
									]);

			if($p['metode_pengeluaran'] == 'Transfer'){

				$last = $this->transaksi_model->get_last_pembayaran($transaksi_id);
				$rek = [
					'rek_id' 				  => $rek_id,
					'transaksi_pembayaran_id' => $last['id']
				];

				$this->m_rek->insert_history($rek);

				$rek['rek_id'] = $this->input->post('rek_id');
				print_r($rek['rek_id']);die;
				$rek['transaksi_pembayaran_id'] = $last['id'];
				$this->m_rek->insert_history($rek);

				$detail_rek = $this->m_rek->get_detail('id', $rek['rek_id'])->row_array();
				// print_r($detail_rek); die;

				if($trans['jenis'] == 'masuk'){
					$detail_rek['saldo'] += $trans['total_bayar'];
				}else{
					$detail_rek['saldo'] -= $trans['total_bayar'];
				}
				$this->m_rek->update(['saldo' => $detail_rek['saldo']], $rek['rek_id']);
			} 

			if($trans['tipe'] == 'bop'){
				$this->generateBOP($transaksi_id);
				// $this->generateJurnal($transaksi_id, $trans['tipe'], $trans['pembayaran'], $p['metode_pengeluaran'], $p['subtotal'], $p);
				$this->generateJurnal($transaksi_id, $trans['tipe'], $trans['pembayaran'], $trans['metode_pengeluaran'], $trans['subtotal'], $trans);

				}

			

			if($this->db->trans_status()){
				$this->db->trans_commit();
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('transaksi/keuangan/bop_out/detail/'.$transaksi_id);
	}

	private function generateBOP($transaksi_id){
			$this->db->select('*, transaksi_bop.id AS transaksi_id')
					 ->where('transaksi_id', $transaksi_id)
					 ->join('transaksi', 'transaksi.id = transaksi_bop.transaksi_id');
			$trans = $this->db->get('transaksi_bop')->result_array();
		}

	private function generateJurnal($transaksi_id, $tipe, $pembayaran, $metode, $nominal, $trans = ''){
			$waktu_jurnal = date('Y-m-d H:i:s');

			if($tipe == 'bop'){
				if($pembayaran == 'Tunai'){
					if($metode == 'Transfer'){
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
				} else {
					$jurnal[0]['coa_id'] 	   = '1'; //Kas
					$jurnal[0]['transaksi_id'] = $transaksi_id;
					$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[0]['posisi']	   = 'd';
					$jurnal[0]['nominal']      = $nominal;

					$jurnal[1]['coa_id'] 	   = '2'; //Modal
					$jurnal[1]['transaksi_id'] = $transaksi_id;
					$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
					$jurnal[1]['posisi']	   = 'k';
					$jurnal[1]['nominal']      = $nominal;
				}
			}

			$this->m_jurnal->insert_multiple($jurnal);
		}
    
}