<?php 

class Rek extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('keuangan/Rek_model', 'm_rek');
		$this->load->model('transaksi_model');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_rek->get_data();
		$data['last_code'] = $this->m_rek->generate_code();
		$this->template->load('layout/template','master_data/keuangan/rekening/index', $data);
	}

	public function add(){
		$p = $this->input->post();
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|numeric');
		$this->form_validation->set_rules('atas_nama', 'Pemilik Rekening', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_rek->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fas fa-info-circle"></i></b> Form tidak valid<br>'.validation_errors(),'warning'));
		}

		redirect('master_data/keuangan/rekening');
	}

	public function detail($id_rek){
		$rek = $this->m_rek->get_detail('id', $id_rek);
		
		if($rek->num_rows() > 0){
			$data['rek']  = $rek->row_array();
			$data['list'] = $this->m_rek->get_rek_history('rek_id', $id_rek);

			$data['balance_in'] = $this->m_rek->get_balance([
													'rek_id' => $id_rek,
													'jenis'  => 'masuk'
												]);

			$data['balance_out'] = $this->m_rek->get_balance([
													'rek_id' => $id_rek,
													'jenis'  => 'keluar'
												]);

			$this->template->load('layout/template','master_data/keuangan/rekening/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
			redirect('transaksi/asset/perolehan');
		}
		
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_rekening'];

		unset($p['id_rekening']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|numeric');
		$this->form_validation->set_rules('atas_nama', 'Pemilik Rekening', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_rek->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal diubah','success'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fas fa-info-circle"></i></b> Form tidak valid<br>'.validation_errors(),'warning'));
		}

		redirect('master_data/keuangan/rekening');
	}

	public function delete($id){

		if($this->m_rek->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dihapus','success'));
		}

		redirect('master_data/keuangan/rekening');
	}
    
}