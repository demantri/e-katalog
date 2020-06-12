<?php 

class Bank extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('keuangan/pemilik_model', 'm_pemilik');
		$this->load->model('keuangan/rek_model', 'm_rek');
		$this->load->model('transaksi_model', 'm_transaksi');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function dana($tipe){
		if(in_array($tipe, ['in','out'])){

			if($tipe == 'in'){
				$trans = 'masuk';
			}else{
				$trans = 'keluar';
			}

			$data['tipe'] 	   = $tipe;
			$data['rek']  	   = $this->m_rek->get_data();
			$data['req']       = $this->m_transaksi->get_detail([
														'tipe'  => 'bank', 
														'jenis' => $trans,
														'level' => '1'
													])->result_array();

			$data['list']      = $this->m_transaksi->get_detail([
														'tipe'  => 'bank', 
														'jenis' => $trans,
														'level' => '3'
													])->result_array();
			$data['last_code'] = $this->m_transaksi->generate_code('bank', 'M');
			$this->template->load('layout/template','transaksi/keuangan/setoran_bank/index', $data);

		}else{
			show_404();
		}
		
	}

	public function add($tipe){
		if(in_array($tipe, ['in', 'out'])){
			$p = $this->input->post();

			$p['total_transaksi'] 	= format_angka($p['total_transaksi']);
			$p['total_bayar']	    = $p['total_transaksi'];
			$p['tanggal_transaksi'] = date('Y-m-d H:i:s');
			$p['is_created']		= '1';
			$p['tipe']				= 'bank';
			$p['pembayaran']		= 'Tunai';
			$p['metode']			= 'Cash';
			$p['status']			= 'Lunas';

			if($tipe == 'in'){
				$p['jenis'] = 'masuk';
				$p['level'] = '1';
			}else{
				$p['jenis'] = 'keluar';

				if($p['total_transaksi'] > 5000000){
					$p['level'] = '1';
				}else{
					$p['level'] = '3';
				}
			}

			$this->form_validation->set_data($p);
			$this->form_validation->set_rules('total_transaksi', 'Nominal', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('rek_id', 'Rekening', 'required|numeric');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

			if($this->form_validation->run() == TRUE){

				$rek_id = $p['rek_id'];
				unset($p['rek_id']);

				$this->db->trans_begin();
				$this->m_transaksi->insert($p);

				$trans = $this->m_transaksi->last_data('bank');
				$this->m_transaksi->insert_pembayaran([
											'transaksi_id'  => $trans['id'],
											'jumlah_bayar'  => $trans['total_bayar'],
											'tanggal_bayar' => $trans['tanggal_transaksi']
										]);
				$last = $this->m_transaksi->get_last_pembayaran($trans['id']);
				$rek = [
					'rek_id' 				  => $rek_id,
					'transaksi_pembayaran_id' => $last['id']
				];
				$this->m_rek->insert_history($rek);

				$detail_rek = $this->m_rek->get_detail('id', $rek_id)->row_array();

				if($tipe == 'in'){
					$detail_rek['saldo'] += $trans['total_bayar'];
				}else{
					$detail_rek['saldo'] -= $trans['total_bayar'];
				}

				$this->m_rek->update(['saldo' => $detail_rek['saldo']], $rek_id);

				if($this->db->trans_status()){
					$this->db->trans_commit();
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
				}else{
					$this->db->trans_rollback();
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fas fa-info-circle"></i></b> Form tidak valid<br>'.validation_errors(),'warning'));
			}

			redirect('transaksi/keuangan/setoran_bank/'.$tipe);

		}else{
			show_404();
		}

	}
}