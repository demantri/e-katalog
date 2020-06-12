<?php 

class Aktiva extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('asset/Aktiva_model', 'm_aktiva');
		$this->load->model('asset/Kategori_model', 'm_kategori');
		$this->load->model('transaksi_model');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_aktiva->get_data();
		$data['kategori']  = $this->m_kategori->get_data();
		$data['last_code'] = $this->m_aktiva->generate_code();
		$this->template->load('layout/template','master_data/asset/aktiva/index', $data);
	}

	public function detail($aset_id){
		
		$cek = $this->m_aktiva->get_detail('id', $aset_id);

		if($cek->num_rows() > 0){
			$data['aset'] = $cek->row_array();
			$data['list'] = $this->m_aktiva->get_list_detail($aset_id);

			$this->template->load('layout/template','master_data/asset/aktiva/detail', $data);

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> ID Aktiva tidak diketahui','success'));
			redirect('master_data/asset/aktiva');
		}
	}

	public function add(){
		$p = $this->input->post();
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_aset', 'Nama Aktiva', 'required');
		$this->form_validation->set_rules('kategori_id', 'Kategori', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_aktiva->insert($p)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/asset/aktiva');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_aset'];

		unset($p['id_aset']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_aset', 'Nama Aktiva', 'required');
		$this->form_validation->set_rules('kategori_id', 'Kategori', 'required');

		if($this->form_validation->run() == TRUE){

			if($this->m_aktiva->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/asset/aktiva');
	}

	public function delete($id){

		if($this->m_aktiva->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/asset/aktiva');
	}

	public function pemeliharaan(){
		$find = [
			'is_created' => '1',
			'tipe'		 => 'pemeliharaan'
		];
		$data['list']      = $this->transaksi_model->get_detail($find)->result_array();
		$this->template->load('layout/template','transaksi/asset/fix/pemeliharaan/index', $data);
	}

	public function pemeliharaan_add(){
		$last = $this->transaksi_model->last_data('pemeliharaan');
		if($last['is_created'] != '0'){
			$data = [
				'kode_transaksi' => $this->transaksi_model->generate_code('pemeliharaan'),
				'tipe'			 => 'pemeliharaan'
			];
			$this->transaksi_model->insert($data);

			$last = $this->transaksi_model->last_data('pemeliharaan');
		}

		$data['aset']      	  = $this->m_aktiva->get_data();
		$data['pemeliharaan'] = $last;
		$data['item']	  	  = $this->transaksi_model->get_list_item('pemeliharaan',$last['id']);

		$this->template->load('layout/template','transaksi/asset/fix/pemeliharaan/add', $data);
	}

	public function insert_pemeliharaanProduk(){
		if($this->input->is_ajax_request()){
			$s = false;
			$p = $this->input->post();
			$p['harga_pemeliharaan'] = format_angka($p['harga_pemeliharaan']);
			unset($p['aset_id']);

			$this->form_validation->set_data($p);
			$this->form_validation->set_rules('harga_pemeliharaan', 'Harga Pemeliharaan', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('aset_detail_id', 'Detail Aset', 'required|numeric|greater_than[0]');

			if($this->form_validation->run() == TRUE){

				$cek = $this->db->where('aset_detail_id', $p['aset_detail_id'])
								->where('transaksi_id', $p['transaksi_id'])
								->get('transaksi_pemeliharaan');

				if($cek->num_rows() == 0){
					if($this->m_aktiva->insert_itemPemeliharaan($p)){
						$response['message'] = 'Data berhasil ditambahkan';
						$response['data']    = $this->transaksi_model->get_list_item('pemeliharaan', $p['transaksi_id']);
						$response['status']  = true;
					
					}else{
						$response['message'] = 'Data gagal ditambahkan';
						$response['status']  = false;
					}

				}else{
					$response['message'] = 'Aset sudah masuk daftar perbaikan';
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
    
    public function delete_pemeliharaanProduk($transaksi_id){

		if($this->input->is_ajax_request()){
			if($this->transaksi_model->delete_item('pemeliharaan', $this->input->post('pemeliharaan_id'))){
				$response['message'] = 'Data berhasil dihapus';
				$response['data']    = $this->transaksi_model->get_list_item('pemeliharaan', $transaksi_id);
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

	public function insert_pemeliharaan($transaksi_id){
		$p = $this->input->post();
		$p['total_bayar'] = format_angka($p['total_bayar']);
		$p['jenis']		  = 'keluar';

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_transaksi', 'Kode Transaksai', 'required');
		$this->form_validation->set_rules('pembayaran', 'Tipe Pembayaran', 'required');
		$this->form_validation->set_rules('total_bayar', 'Total Dibayar', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){

			$total_transaksi = $this->transaksi_model->get_total_price('pemeliharaan',$transaksi_id);

			if($total_transaksi > 0){

				$p['total_transaksi'] 	= $total_transaksi;
				$p['sisa_bayar'] 		= $p['total_transaksi'] - $p['total_bayar'];
				$p['tanggal_transaksi'] = date('Y-m-d H:i:s');
				$p['is_created'] = '1';

				if($p['pembayaran'] == 'Kredit'){
					$p['status'] = 'Belum Lunas';
				}else{
					$p['status'] = 'Lunas';
				}

				if($this->transaksi_model->update($p, $transaksi_id)){
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
					redirect('transaksi/asset/pemeliharaan');

				}else{
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan','danger'));
					redirect('transaksi/asset/pemeliharaan/add');
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fa fa-ban"></i></b> Tidak ada Produk yang dipilih','warning'));
				redirect('transaksi/asset/pemeliharaan/add');
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fa fa-ban"></i> Form Tidak Valid</b><br>'.validation_errors(),'warning'));
			
			//echo "<pre>".print_r($p,true)."</pre>";

			redirect('transaksi/asset/pemeliharaan');
		}
	}

	public function pemeliharaan_detail($transaksi_id){
		$perolehan = $this->transaksi_model->get_detail('id', $transaksi_id);
		
		if($perolehan->num_rows() > 0){
			$data['transaksi']  = $perolehan->row_array();
			$data['item']       = $this->transaksi_model->get_list_item('pemeliharaan', $data['transaksi']['id']);
			$data['pembayaran'] = $this->transaksi_model->get_list_pembayaran($data['transaksi']['id']);
			$this->template->load('layout/template','transaksi/asset/fix/pemeliharaan/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
			redirect('transaksi/asset/pemeliharaan');
		}
		
	}
}