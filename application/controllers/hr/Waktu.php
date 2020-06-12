<?php 

class Waktu extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('hr/waktu_model', 'm_waktu');
		
		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_waktu->get_data();
		$this->template->load('layout/template','master_data/hr/waktu/index', $data);
	}


	public function update(){
		$p  = $this->input->post();
		$id = $p['id_waktu'];
		
		unset($p['id_waktu']);

		
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('jam_tiba_mulai', 'Waktu Tiba Mulai', 'required');
		$this->form_validation->set_rules('jam_tiba_terlambat', 'Waktu Tiba Terlambat', 'required');
		$this->form_validation->set_rules('jam_tiba_selesai', 'Waktu Tiba Selesai', 'required');
		$this->form_validation->set_rules('jam_pulang_mulai', 'Waktu Pulang Mulai', 'required');
		$this->form_validation->set_rules('jam_pulang_selesai', 'Waktu Pulang Selesai', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_waktu->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/hr/waktu');
	}

	public function set_waktu($waktu_id, $is_aktif){
		$cek = $this->m_waktu->get_detail('id', $waktu_id);

		if($cek->num_rows() > 0){
			$this->m_waktu->update(['is_aktif' => $is_aktif], $waktu_id);
			$this->session->set_flashdata('alert_message', show_alert('<span class="text-success"><i class="fa fa-check"></i> Data berhasil diubah</span>','success'));
			redirect('master_data/hr/waktu');

		}else{
			show_404();
		}
	}
    
}