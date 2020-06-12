<?php 

class Perolehan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('transaksi_model');
		$this->load->model('asset/Aktiva_model', 'm_aktiva');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function konfirmasi(){
		$status = true;
		$req = [
			'level'      	=> '3',
			'is_konfirmasi' => '0',
			'tipe'   	 	=> 'perolehan'
		];

		$data['list']      = $this->transaksi_model->get_detail($req)->result_array();

		if($this->input->get('perolehan_id')){
			$perolehan_id = $this->input->get('perolehan_id');
			$find = [
				'id' 			=> $perolehan_id,
				'is_konfirmasi' => '0',
				'tipe'			=> 'perolehan'
			];	

			$cek = $this->transaksi_model->get_detail($req);
			$data['aset'] = $this->m_aktiva->get_unconfirm($perolehan_id);

			if($cek->num_rows() > 0){

			}else{
				$status = false;
			}
		}

		if($status){
			$this->template->load('layout/template','transaksi/asset/perolehan/konfirmasi', $data);
		}else{
			show_404();
		}

	}

	public function index(){

		$req = [
			'is_created' 	=> '1',
			'tipe'   	 	=> 'perolehan'
		];

		$data['list']      = $this->transaksi_model->get_detail($req)->result_array();
		$this->template->load('layout/template','transaksi/asset/perolehan/index', $data);
	}

	public function detail($transaksi_id){
		$perolehan = $this->transaksi_model->get_detail('id', $transaksi_id);
		
		if($perolehan->num_rows() > 0){
			$data['transaksi']  = $perolehan->row_array();
			$data['item']       = $this->transaksi_model->get_list_item('perolehan', $data['transaksi']['id']);
			$data['pembayaran'] = $this->transaksi_model->get_list_pembayaran($data['transaksi']['id']);
			$this->template->load('layout/template','transaksi/asset/perolehan/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
			redirect('transaksi/asset/perolehan');
		}
		
	}

	public function add(){
		$last = $this->transaksi_model->last_data('perolehan');
		if($last['is_created'] != '0'){
			$data = [
				'kode_transaksi' => $this->transaksi_model->generate_code('perolehan'),
				'tipe'			 => 'perolehan'
			];
			$this->transaksi_model->insert($data);

			$last = $this->transaksi_model->last_data('perolehan');
		}

		$data['aset']      = $this->m_aktiva->get_data();
		$data['perolehan'] = $last;
		$data['item']	   = $this->transaksi_model->get_list_item('perolehan',$last['id']);

		$this->template->load('layout/template','transaksi/asset/perolehan/add', $data);
	}

	public function insert($transaksi_id){
		$p = $this->input->post();
		$p['total_bayar'] = format_angka($p['total_bayar']);
		$p['jenis']		  = 'keluar';

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_transaksi', 'Kode Transaksai', 'required');
		$this->form_validation->set_rules('pembayaran', 'Tipe Pembayaran', 'required');
		$this->form_validation->set_rules('total_bayar', 'Total Dibayar', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){

			$total_transaksi = $this->transaksi_model->get_total_price('perolehan',$transaksi_id);

			if($total_transaksi > 0){

				$p['total_transaksi'] 	= $total_transaksi;
				$p['sisa_bayar'] 		= $p['total_transaksi'] - $p['total_bayar'];
				$p['tanggal_transaksi'] = date('Y-m-d H:i:s');
				$p['is_created'] = '1';
				$p['jenis']		 = 'keluar';

				if($p['pembayaran'] == 'Kredit'){
					$p['status'] = 'Belum Lunas';
				}else{
					$p['status'] = 'Lunas';
				}

				if($this->transaksi_model->update($p, $transaksi_id)){
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
					redirect('transaksi/asset/perolehan');

				}else{
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan','danger'));
					redirect('transaksi/asset/perolehan/add');
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fa fa-ban"></i></b> Tidak ada Produk yang dipilih','warning'));
				redirect('transaksi/asset/perolehan/add');
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fa fa-ban"></i> Form Tidak Valid</b><br>'.validation_errors(),'warning'));
			
			//echo "<pre>".print_r($p,true)."</pre>";

			redirect('transaksi/asset/perolehan/add');
		}
	}

	public function insert_produk(){
		if($this->input->is_ajax_request()){
			$s = false;
			$p = $this->input->post();
			$p['harga'] = format_angka($p['harga']);
			$p['nilai_residu'] = format_angka($p['nilai_residu']);

			$this->form_validation->set_data($p);
			$this->form_validation->set_rules('aset_id', 'Aset', 'required');
			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('nilai_residu', 'Nilai Residu', 'required|numeric');

			if($this->form_validation->run() == TRUE){

				$p['subtotal'] = $p['jumlah'] * $p['harga'];

				if($this->transaksi_model->insert_item('perolehan',$p)){
					$response['message'] = 'Data berhasil ditambahkan';
					$response['data']    = $this->transaksi_model->get_list_item('perolehan',$p['transaksi_id']);
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

	public function update_produk($perolehan_id){
		if($this->input->is_ajax_request()){
			$p = $this->input->post();

			$this->form_validation->set_data($p);
			$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric|greater_than[0]');

			if($this->form_validation->run() == TRUE){

					if($this->transaksi_model->update_item(['qty' => $p['qty']], $p['perolehan_detail_id'])){
						$response['message'] = 'Data berhasil diubah';
						$response['data']    = $this->transaksi_model->get_list_item($perolehan_id);
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
			if($this->transaksi_model->delete_item('perolehan', $this->input->post('transaksi_aset_id'))){
				$response['message'] = 'Data berhasil diubah';
				$response['data']    = $this->transaksi_model->get_list_item('perolehan', $transaksi_id);
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
    

    public function pelunasan(){

    	$find = [
    		'is_created' => '1',
    		'status'     => 'Belum Lunas'
    	];
    	$data['list'] = $this->transaksi_model->get_detail($find)->result_array();

    	if(!$this->input->get('id')){
    		$this->template->load('layout/template','pesanan/perolehan/pelunasan', $data);
    	
    	}else{
    		$id = $this->input->get('id');
    		$find = [
	    		'is_created'   => '1',
	    		'status'       => 'Belum Lunas',
	    		'perolehan.id' => $id
	    	];

    		$perolehan = $this->transaksi_model->get_detail($find);
    		if($perolehan->num_rows() > 0){
    			$data['perolehan'] = $perolehan->row_array();
    			$data['item']      = $this->transaksi_model->get_list_item($data['perolehan']['perolehan_id']);
    			$data['pembayaran'] = $this->transaksi_model->get_list_pembayaran($data['perolehan']['perolehan_id']);
    			$this->template->load('layout/template','pesanan/perolehan/pelunasan', $data);

    		}else{
    			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
				redirect('perolehan/pesanan/pelunasan');
    		}
    	}
    }


    public function set_retur($trans_id){
    	$trans = $this->transaksi_model->get_detail(['id' => $trans_id, 'is_konfirmasi' => '0']);

    	if($trans->num_rows() > 0){

    		$this->db->trans_begin();

    		$i = 0;
    		foreach ($this->input->post('detail_aset') as $row){ $i++;
				$data[] = $row;
			}

			if($i > 0){
				$this->m_aktiva->insert_retur($data);
			}

			$this->transaksi_model->update(['is_konfirmasi' => '1'], $trans_id);

			if($this->db->trans_status()){
				$this->db->trans_commit();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Konfirmasi Penerimaan Aset Berhasil','success'));
			}else{
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Konfirmasi Penerimaan Aset Gagal','danger'));
			}

			// JURNAL HOLD

			redirect('transaksi/asset/konfirmasi');

    	}else{
    		show_404();
    	}
    }
}