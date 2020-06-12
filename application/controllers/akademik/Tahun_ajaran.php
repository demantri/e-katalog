<?php 

class Tahun_ajaran extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('akademik/tahun_ajaran_model', 'm_ta');
		$this->load->model('akademik/komponen_model', 'm_komponen');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_ta->get_data();
		$this->template->load('layout/template','master_data/akademik/tahun_ajaran/index', $data);
	}

	public function add(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_ta', 'Tahun Ajaran', 'required');
		$this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
		$this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');

		if($this->form_validation->run() == TRUE){

			if(strtotime($p['waktu_mulai']) < strtotime($p['waktu_selesai'])){

				if($this->m_ta->insert($p)){
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
				
				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Waktu Mulai harus dibawah waktu selesai'.strtotime($p['waktu_mulai']),'danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/akademik/tahun_ajaran');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_ta'];
		unset($p['id_ta']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_ta', 'Tahun Ajaran', 'required');
		$this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required');
		$this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_ta->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/akademik/tahun_ajaran');
	}

	public function set_active($id, $num){
		if(in_array($num, ['1', '0'])){

			$this->db->update('ak_tahun_ajaran', ['is_aktif' => '0']);
			if($this->m_ta->update(['is_aktif' => $num], $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Jenis Approval tidak diketahui','danger'));
		}

		redirect('master_data/akademik/tahun_ajaran');
	}

	public function delete($id){

		if($this->m_ta->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/akademik/tahun_ajaran');
	}

	public function detail($id){
		$data['ta']            = $this->m_ta->get_detail('id', $id)->row_array();
		$data['komponen']      = $this->m_komponen->get_data();
		$data['komponen_list'] = $this->m_komponen->get_komponen_ta($id);
		$this->template->load('layout/template','master_data/akademik/tahun_ajaran/detail', $data);
	}

	public function insert_komponen($ta_id){
		$p = $this->input->post();
		$p['nominal'] = format_angka($p['nominal']);
		$p['tahun_ajaran_id'] = $ta_id;

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('komponen_biaya_id', 'Komponen', 'required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){

			if($this->m_ta->insert_komponen($p)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/akademik/tahun_ajaran/detail/'.$ta_id);
	}

	public function update_komponen($ta_id){
		$p  = $this->input->post();

		$id = $p['ta_komponen_id'];
		unset($p['ta_komponen_id']);

		$p['nominal'] = format_angka($p['nominal']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){

			if($this->m_ta->update_komponen($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/akademik/tahun_ajaran/detail/'.$ta_id);
	}

	public function delete_komponen($ta_id, $ta_komponen_id){

		if($this->m_ta->delete_komponen($ta_komponen_id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/akademik/tahun_ajaran/detail/'.$ta_id);
	}
}