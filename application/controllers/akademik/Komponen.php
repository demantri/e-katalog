<?php 

class Komponen extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('akademik/komponen_model', 'm_komponen');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_komponen->get_data();
		$data['last_code'] = $this->m_komponen->generate_code();
		$this->template->load('layout/template','master_data/akademik/komponen/index', $data);
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_komponen', 'Kode Komponen', 'required');
		$this->form_validation->set_rules('nama_komponen', 'Nama Komponen', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_komponen->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/akademik/komponen_biaya');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_komponen'];
		unset($p['id_komponen']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_komponen', 'Kode Komponen', 'required');
		$this->form_validation->set_rules('nama_komponen', 'Nama Komponen', 'required');

		if($this->form_validation->run() == TRUE){

			if(!isset($p['cicilan'])){
				$p['cicilan'] = 0;
			}

			if($this->m_komponen->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/akademik/komponen_biaya');
	}

	public function delete($id){

		if($this->m_komponen->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan','danger'));
		}

		redirect('master_data/akademik/komponen_biaya');
	}
    
}