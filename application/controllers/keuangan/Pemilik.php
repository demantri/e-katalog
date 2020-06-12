<?php 

class Pemilik extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('keuangan/pemilik_model', 'm_pemilik');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_pemilik->get_data();
		$this->template->load('layout/template','master_data/keuangan/pemilik/index', $data);
	}

	public function add(){
		$p = $this->input->post();
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required');
		$this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_pemilik->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fas fa-info-circle"></i></b> Form tidak valid<br>'.validation_errors(),'warning'));
		}

		redirect('master_data/keuangan/pemilik');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_pemilik'];

		unset($p['id_pemilik']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required');
		$this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_pemilik->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal diubah','success'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fas fa-info-circle"></i></b> Form tidak valid<br>'.validation_errors(),'warning'));
		}

		redirect('master_data/keuangan/pemilik');
	}

	public function delete($id){

		if($this->m_pemilik->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dihapus','success'));
		}

		redirect('master_data/keuangan/pemilik');
	}
    
}