<?php 

class Panjar extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('transaksi_model');
		$this->load->model('keuangan/Jurnal_model','m_jurnal');
		$this->load->model('keuangan/Rek_model', 'm_rek');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list'] = $this->db->where('is_created', '1')
								 ->where('jenis','masuk')
								 ->where('tipe', 'bop')
								 ->where('level', '3')
								 ->get('transaksi')->result_array();

		$data['last_code'] = $this->transaksi_model->generate_code('panjar');
		$data['rek']	   = $this->m_rek->get_data();
		$this->template->load('layout/template','transaksi/keuangan/panjar/index', $data);
	}

	public function add_bop(){
		$p = $this->input->post();
		$p['total_transaksi'] = format_angka($p['total_transaksi']);
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('total_transaksi', 'Nominal', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('rek_id', 'Rekening', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if($this->form_validation->run() == TRUE){

			$this->db->trans_begin();
			$rek_id = $p['rek_id'];
			unset($p['rek_id']);

			$p['tanggal_transaksi'] = date('Y-m-d');
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
		$this->template->load('layout/template','transaksi/keuangan/bop/out/index', $data);
	}

	public function bop_keluar_detail($transaksi_id){
		$trans = $this->transaksi_model->get_detail(['id' => $transaksi_id, 'jenis' => 'masuk']);
		
		if($trans->num_rows() > 0){
			$data['rek']   		= $this->m_rek->get_data();
			$data['transaksi']  = $trans->row_array();

			$data['item'] 		= $this->transaksi_model->get_list_item($data['transaksi']['tipe'], $data['transaksi']['id']);
			$data['total_penggunaan'] = $this->transaksi_model->get_total_list_item($data['transaksi']['tipe'], $data['transaksi']['id']);
			$this->template->load('layout/template','transaksi/keuangan/bop/out/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
			redirect('transaksi/keuangan/bop_out');
		}
	}

	public function add_bop_keluar($transaksi_id){
		$p = $this->input->post();
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
				$rek['transaksi_pembayaran_id'] = $last['id'];
				$this->m_rek->insert_history($rek);

				$detail_rek = $this->m_rek->get_detail('id', $rek['rek_id'])->row_array();
				if($trans['jenis'] == 'masuk'){
					$detail_rek['saldo'] += $trans['total_bayar'];
				}else{
					$detail_rek['saldo'] -= $trans['total_bayar'];
				}

				$this->m_rek->update(['saldo' => $detail_rek['saldo']], $rek['rek_id']);
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
    
}