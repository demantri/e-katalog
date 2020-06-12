<?php 

class Kategori extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('asset/Kategori_model', 'm_kategori');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_kategori->get_data();
		$data['last_code'] = $this->m_kategori->generate_code();
		$this->template->load('layout/template','master_data/asset/kategori/index', $data);
	}

	public function add(){
		$p = $this->input->post();
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
		$this->form_validation->set_rules('masa_pakai', 'Masa Pakai', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){

			if($this->m_kategori->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/asset/kategori');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_kategori'];

		unset($p['id_kategori']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
		$this->form_validation->set_rules('masa_pakai', 'Masa Pakai', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){

			if($this->m_kategori->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/asset/kategori');
	}

	public function delete($id){

		if($this->m_kategori->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/asset/kategori');
	}
    
}