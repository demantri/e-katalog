<?php 

class Vendor extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('asset/vendor_model', 'm_vendor');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_vendor->get_data();
		$data['last_code'] = $this->m_vendor->generate_code();
		$this->template->load('layout/template','master_data/asset/vendor/index', $data);
	}

	public function add(){
		$p = $this->input->post();
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_vendor', 'Kode Vendor', 'required');
		$this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'No Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('username', 'Username', 'required|max_length[50]|is_unique[a_vendor.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[50]');

		if($this->form_validation->run() == TRUE){

			if($this->m_vendor->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/asset/vendor');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_vendor'];

		unset($p['id_vendor']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_vendor', 'Kode Vendor', 'required');
		$this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'No Handphone', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('username', 'Username', 'required|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[50]');

		if($this->form_validation->run() == TRUE){

			if($this->m_vendor->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/asset/vendor');
	}

	public function delete($id){

		if($this->m_vendor->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/asset/vendor');
	}
    
}