<?php 

class Jurnal extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('keuangan/Rek_model', 'm_rek');
		$this->load->model('transaksi_model');
		$this->load->model('keuangan/Jurnal_model', 'm_jurnal');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->db->select('*, jurnal.status AS status_jurnal, jurnal.id AS jurnal_id')
									  ->join('transaksi', 'transaksi.id = jurnal.transaksi_id')
									  ->join('transaksi_pembayaran', 'transaksi_pembayaran.transaksi_id = transaksi.id', 'LEFT')
									  ->group_by('transaksi_pembayaran.id')
									  ->get('jurnal')->result_array();
		// print_r($data['list']); exit();
		$this->template->load('layout/template','transaksi/keuangan/jurnal/index', $data);
	}

	public function post_jurnal($transaksi_pembayaran_id){
		$this->db->where('transaksi_pembayaran_id', $transaksi_pembayaran_id)
				 ->update('jurnal', ['status' => '1']);

		$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Jurnal berhasil diposting', 'success'));

		redirect('transaksi/keuangan/jurnal/detail/'.$transaksi_pembayaran_id);
	}

	public function detail($transaksi_pembayaran_id){
		$cek = $this->db->where('transaksi_pembayaran.id', $transaksi_pembayaran_id)
						->join('k_coa', 'k_coa.id = jurnal.coa_id')
						->join('transaksi', 'transaksi.id = jurnal.transaksi_id')
						->join('transaksi_pembayaran', 'transaksi_pembayaran.transaksi_id = transaksi.id')
						->order_by('jurnal.id', 'ASC')->get('jurnal');

		if($cek->num_rows() > 0){
			$data['jurnal']		 = $cek->row_array();
			$data['transaksi'] 	 = $this->transaksi_model->get_detail('id', $data['jurnal']['transaksi_id'])->row_array();
			// print_r(['jurnal']); die;
			$data['jurnal_list'] = $cek->result_array();
			
			$this->template->load('layout/template','transaksi/keuangan/jurnal/detail', $data);

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> ID Transaksi tidak ditemukan', 'danger'));
			redirect('transaksi/keuangan/jurnal');
		}
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_rekening'];

		unset($p['id_rekening']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
		$this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required|numeric');
		$this->form_validation->set_rules('atas_nama', 'Pemilik Rekening', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_rek->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal diubah','success'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fas fa-info-circle"></i></b> Form tidak valid<br>'.validation_errors(),'warning'));
		}

		redirect('master_data/keuangan/rekening');
	}

	public function delete($id){

		if($this->m_rek->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dihapus','success'));
		}

		redirect('master_data/keuangan/rekening');
	}
    
}