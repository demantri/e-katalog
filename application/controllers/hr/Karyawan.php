<?php 

class Karyawan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('hr/karyawan_model', 'm_karyawan');
		$this->load->model('hr/jabatan_model', 'm_jabatan');
		
		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_karyawan->get_data();
		$data['jabatan']   = $this->m_jabatan->get_data();
		$data['last_code'] = $this->m_karyawan->generate_code();
		$this->template->load('layout/template','master_data/hr/karyawan/index', $data);
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telepon', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[hr_karyawan.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('rfid', 'Rfid', 'required|is_unique[hr_karyawan.rfid]');

		if($this->form_validation->run() == TRUE){

			if($this->m_karyawan->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/hr/karyawan');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_karyawan'];
		unset($p['id_karyawan']);
		
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_karyawan', 'Nama Karyawan', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'No Telepon', 'required|numeric|max_length[13]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('rfid', 'Rfid', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_karyawan->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/hr/karyawan');
	}

	public function delete($id){

		if($this->m_karyawan->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/hr/karyawan');
	}
    
}