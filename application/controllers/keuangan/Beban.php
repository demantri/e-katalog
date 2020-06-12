<?php 

class Beban extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('keuangan/Beban_model', 'm_beban');
		$this->load->model('keuangan/Coa_model', 'm_coa');
		$this->load->model('transaksi_model');

		if(!$this->session->userdata('login')){
			redirect('');
		}

		$this->session->set_userdata('menu','keuangan');
	}

	public function index(){
		$data['last_code'] = $this->m_beban->generate_code();
		$data['list']      = $this->m_beban->get_data();
		$data['coa']	   = $this->m_coa->get_data();
		$this->template->load('layout/template','master_data/keuangan/beban/index', $data);
	}

	public function add(){
		// testing
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_beban', 'Nama Beban', 'required');
		$this->form_validation->set_rules('coa_id', 'Nama COA', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_beban->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/keuangan/beban');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_beban'];

		unset($p['id_beban']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_beban', 'Nama Beban', 'required');
		$this->form_validation->set_rules('coa_id', 'Nama COA', 'required');

		if($this->form_validation->run() == TRUE){

			if(!isset($p['is_bulanan'])){
				$p['is_bulanan'] = '0';
			}

			if($this->m_beban->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/keuangan/beban');
	}

	public function delete($beban_id){

		if($this->m_beban->delete($beban_id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('keuangan/beban');
	}

	public function keluar(){
		$data['list']      = $this->transaksi_model->get_detail(['is_created' => '1', 'tipe' => 'transaksi_beban'])->result_array();
		// print_r($data['list']); exit;
		$this->template->load('layout/template','transaksi/keuangan/beban/index', $data);
	}

	public function keluar_detail($pembelian_id){
		$pembelian = $this->transaksi_model->get_detail('transaksi.id', $pembelian_id);
		
		if($pembelian->num_rows() > 0){
			$data['pembelian']  = $pembelian->row_array();
			$data['item']       = $this->transaksi_model->get_list_item('transaksi_beban' ,$data['pembelian']['id']);
			$data['pembayaran'] = $this->transaksi_model->get_list_pembayaran($data['pembelian']['id']);
			$this->template->load('layout/template','transaksi/keuangan/beban/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID pembelian tidak diketahui','danger'));
			redirect('keuangan/transaksi_beban');
		}
		
	}

	public function keluar_add(){
		$last = $this->transaksi_model->last_data('transaksi_beban');
		if($last['is_created'] != '0'){
			$data = [
				'kode_transaksi' => $this->transaksi_model->generate_code('transaksi_beban'),
				'tipe'			 => 'transaksi_beban'
			];
			$this->transaksi_model->insert($data);

			$last = $this->transaksi_model->last_data('transaksi_beban');
		}

		$data['bb']    		= $this->m_beban->get_data();
		$data['pembelian'] 	= $last;
		$data['item']	   	= $this->transaksi_model->get_list_item('transaksi_beban', $last['id']);
		// print_r($data['item']);die;

		$this->template->load('layout/template','transaksi/keuangan/beban/add', $data);
	}

	public function keluar_insert($pembelian_id){
		$p = $this->input->post();

		$p['total_bayar'] = format_angka($p['total_bayar']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_transaksi', 'Kode Transaksi', 'required');

		if($this->form_validation->run() == TRUE){

			$total_beli = $this->transaksi_model->get_total_price('transaksi_beban', $pembelian_id);

			if($total_beli > 0){

				$this->db->trans_begin();

				$p['total_transaksi']    = $total_beli;
				$p['total_bayar']		 = $p['total_bayar'];
				$p['sisa_bayar']   		 = $total_beli - $p['total_bayar'];
				$p['tanggal_transaksi']  = date('Y-m-d H:i:s');
				$p['is_created']    	 = '1';
				$p['jenis']				 = 'keluar';

				if($p['pembayaran'] == 'Tunai'){
					$p['status'] = 'Lunas';
				}else{
					$p['status'] = 'Belum Lunas';
				}

				if($this->transaksi_model->update($p, $pembelian_id)){

					if($this->db->trans_status()){
						$this->db->trans_commit();
						$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
						redirect('transaksi/keuangan/beban');
					
					}else{
						$this->db->trans_rollback();
						$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Terjadi kesalahan','danger'));
						redirect('transaksi/keuangan/beban/add');
					}

				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
					redirect('transaksi/keuangan/beban/add');
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-ban"></i> Tidak ada Produk yang dipilih','warning'));
				redirect('transaksi/keuangan/beban/add');
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
			redirect('transaksi/keuangan/beban/add');
		}

		
	}

	public function insert_produk(){
		if($this->input->is_ajax_request()){
			$s = false;
			$p = $this->input->post();
			$p['harga'] = format_angka($p['harga']);

			$this->form_validation->set_data($p);
			$this->form_validation->set_rules('beban_id', 'Beban', 'required');
			$this->form_validation->set_rules('qty', 'Jumlah', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

			if($this->form_validation->run() == TRUE){

				$check = $this->transaksi_model->get_item_by('transaksi_beban', $p['transaksi_id'],$p['beban_id']);

				if($check->num_rows() > 0){
					$item = $check->row_array();

					$p['qty'] += $item['qty'];
					$p['subtotal'] = $p['harga'] * $p['qty'];
					if($this->transaksi_model->update_item('transaksi_beban',$p, $item['transaksi_beban_id'])){
						$s = true;
					}

				}else{
					$p['subtotal'] = $p['harga'] * $p['qty'];
					if($this->transaksi_model->insert_item('transaksi_beban',$p)){
						$s = true;
					}
				}

				if($s){
					$response['message'] = 'Data berhasil ditambahkan';
					$response['data']    = $this->transaksi_model->get_list_item('transaksi_beban', $p['transaksi_id']);
					$response['status']  = true;
				
				}else{
					$response['message'] = 'Data gagal ditambahkan';
					$response['status']  = false;
				}

			}else{
				$response['message'] = validation_errors();
				$response['status']  = false;
			}

			echo json_encode($response);

		}else{
			show_404();
		}
	}

	public function update_produk($transaksi_id){
		if($this->input->is_ajax_request()){
			$p = $this->input->post();

			$this->form_validation->set_data($p);
			$this->form_validation->set_rules('qty', 'Jumlah', 'required|numeric|greater_than[0]');

			if($this->form_validation->run() == TRUE){

					if($this->transaksi_model->update_item('transaksi_beban', ['qty' => $p['qty']], $p['transaksi_beban_id'])){
						$response['message'] = 'Data berhasil diubah';
						$response['data']    = $this->transaksi_model->get_list_item('transaksi_beban', $transaksi_id);
						$response['status']  = true;
					
					}else{
						$response['message'] = 'Data gagal diubah';
						$response['status']  = false;
					}

			}else{
				$response['message'] = validation_errors();
				$response['status']  = false;
			}

			echo json_encode($response);

		}else{
			show_404();
		}
	}

	public function delete_produk($transaksi_id){

		if($this->input->is_ajax_request()){
			if($this->transaksi_model->delete_item('transaksi_beban', $this->input->post('transaksi_beban_id'))){
				$response['message'] = 'Data berhasil diubah';
				$response['data']    = $this->transaksi_model->get_list_item('transaksi_beban', $transaksi_id);
				$response['status']  = true;

			}else{
				$response['message'] = 'Data gagal dihapus';
				$response['status']  = false;
			}

			echo json_encode($response);

		}else{
			show_404();
		}
	}
    
}