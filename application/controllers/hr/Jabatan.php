<?php 

class Jabatan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('hr/jabatan_model', 'm_jabatan');
		
		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_jabatan->get_data();
		$data['last_code'] = $this->m_jabatan->generate_code();
		$this->template->load('layout/template','master_data/hr/jabatan/index', $data);
	}

	public function add(){
		$p = $this->input->post();
		$p['gaji'] = format_angka($p['gaji']);
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
		$this->form_validation->set_rules('gaji', 'Gaji', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){

			if($this->m_jabatan->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/hr/jabatan');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_jabatan'];
		$p['gaji'] = format_angka($p['gaji']);
		
		unset($p['id_jabatan']);

		
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
		$this->form_validation->set_rules('gaji', 'Gaji', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){

			if($this->m_jabatan->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/hr/jabatan');
	}

	public function delete($id){

		if($this->m_jabatan->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/hr/jabatan');
	}
    
}