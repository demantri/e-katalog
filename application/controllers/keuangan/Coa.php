<?php 

class Coa extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('keuangan/coa_model', 'm_coa');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_coa->get_data();
		$this->template->load('layout/template','master_data/keuangan/coa/index', $data);
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_coa', 'Nama Akun', 'required');
		$this->form_validation->set_rules('kode_coa', 'Kode COA', 'required|is_unique[k_coa.kode_coa]');

		if($this->form_validation->run() == TRUE){

			if($this->m_coa->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/keuangan/coa');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_coa'];
		$s  = false;

		unset($p['id_coa']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_coa', 'Nama Akun', 'required');
		$this->form_validation->set_rules('kode_coa', 'Kode COA', 'required');

		$cek = $this->m_coa->get_detail('id', $id)->row_array();
		
		if($p['kode_coa'] == $cek['kode_coa']){
			$s = true;
		
		}else{
			$cek = $this->m_coa->get_detail('kode_coa', $p['kode_coa'])->num_rows();
			if($cek == 0){
				$s = true;
			}
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Kode COA sudah ada','warning'));
		}

		if($s){
			if($this->form_validation->run() == TRUE){

				if($this->m_coa->update($p, $id)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
			}
		}

		redirect('master_data/keuangan/coa');
	}

	public function delete($coa_id){

		if($this->m_coa->delete($coa_id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/keuangan/coa');
	}
    
}