<?php 

class Tunjangan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('hr/tunjangan_model', 'm_tunjangan');
		
		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_tunjangan->get_data();
		$this->template->load('layout/template','master_data/hr/tunjangan/index', $data);
	}

	public function tunjangan_dll(){
		$data['list']      = $this->db->where('tipe !=', 'lembur')->get('hr_tunjangan')->result_array();
		$this->template->load('layout/template','master_data/hr/tunjangan/dll', $data);
	}

	public function add(){
		$p = $this->input->post();
		$p['nominal'] = format_angka($p['nominal']);
		$this->form_validation->set_data($p);

		if(isset($p['source'])){
			$url = site_url('master_data/hr/tunjangan_lain');
			$this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric|greater_than[0]');
		}else{

			$this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric|greater_than[0]');
			$url = site_url('master_data/hr/tunjangan');
		}

		unset($p['source']);

		$this->form_validation->set_rules('nama_tunjangan', 'Nama Tunjangan', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_tunjangan->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect($url);
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_tunjangan'];
		unset($p['id_tunjangan']);

		$p['nominal'] = format_angka($p['nominal']);
		$this->form_validation->set_data($p);

		if(isset($p['source'])){
			$url = site_url('master_data/hr/tunjangan_lain');
			$this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric|greater_than[0]');

		}else{
			$url = site_url('master_data/hr/tunjangan');
			$this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric|greater_than[0]');
		}

		unset($p['source']);

		$this->form_validation->set_rules('nama_tunjangan', 'Nama Tunjangan', 'required');
		if($this->form_validation->run() == TRUE){

			if($this->m_tunjangan->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect($url);
	}

	public function delete($tipe, $id){

		if($this->m_tunjangan->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/hr/'. $tipe);
	}
    
}