<?php 

class Lokasi extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('asset/Lokasi_model', 'm_lokasi');
		$this->load->model('asset/Aktiva_model', 'm_aktiva');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_lokasi->get_data();
		$data['last_code'] = $this->m_lokasi->generate_code();
		$this->template->load('layout/template','master_data/asset/lokasi/index', $data);
	}

	public function add(){
		$p = $this->input->post();
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_lokasi->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/asset/lokasi');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_lokasi'];

		unset($p['id_lokasi']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_lokasi->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/asset/lokasi');
	}

	public function delete($id){

		if($this->m_lokasi->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/asset/lokasi');
	}

	public function penempatan(){
		$data['aktiva'] = $this->m_aktiva->get_data();
		$data['lokasi'] = $this->m_lokasi->get_data();

		$aset_id = $this->input->get('aset_id');

		if($aset_id){
			$data['list'] = $this->m_aktiva->get_unlocated($aset_id);
		}

		$this->template->load('layout/template','transaksi/asset/penempatan/index', $data);
	}

	public function insert_asset_location($aset_id){
		$this->form_validation->set_rules('lokasi_id', 'Lokasi', 'required');

		if($this->form_validation->run() == TRUE){
			
			foreach ($this->input->post('detail_aset') as $row){
				$data[] = $row;
			}

			if($this->m_aktiva->insert_location($data, $this->input->post('lokasi_id'))){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Aktiva berhasil ditempatkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fas fa-info-circle"></i></b> Harap Pilih Aktiva','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-ban"></i>Form Tidak Valid</b><br>'.validation_errors(),'warning'));
		}

		redirect('transaksi/asset/penempatan?aset_id='.$aset_id);
	}
    
}