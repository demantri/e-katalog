<?php 

class Pelunasan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('transaksi_model');
		$this->load->model('keuangan/Pelunasan_model', 'm_pelunasan');

		if(!$this->session->userdata('login')){
			redirect('');
		}

		$this->session->set_userdata('menu','keuangan');
	}

	public function get_page($page){
		if(in_array($page, ['utang', 'piutang'])){
			$data['list'] = $this->m_pelunasan->get_tagihan($page)->result_array();
			$data['page'] = $page;
			$this->template->load('layout/template','transaksi/keuangan/pelunasan/index', $data);

		}else{
			show_404();
		}
		
	}

	public function detail($page, $trans_id){
		$cek = $this->transaksi_model->get_detail([
									'level'	 => '3',
									'is_deny'=> '0',
									'id'	 => $trans_id
								]);

		if($cek->num_rows() > 0 && in_array($page, ['utang', 'piutang'])){
			$data['transaksi']  = $cek->row_array();
			$data['item']       = $this->transaksi_model->get_list_item($data['transaksi']['tipe'], $data['transaksi']['id']);
			$data['pembayaran'] = $this->transaksi_model->get_list_pembayaran($data['transaksi']['id']);
			$data['page']		= $page;

			$this->template->load('layout/template','transaksi/keuangan/pelunasan/detail', $data);
		}else{
			show_404();
		}
	}


	public function insert_pembayaran($page, $transaksi_id){
    	$status = false;
    	$transaksi = $this->transaksi_model->get_detail('id', $transaksi_id)->row_array();
    	$p = $this->input->post();

    	$p['jumlah_bayar'] = format_angka($p['jumlah_bayar']);

    	$this->form_validation->set_data($p);
		$this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required|numeric|greater_than[0]');

		if($this->form_validation->run() == TRUE){
			if($p['jumlah_bayar'] <= $transaksi['sisa_bayar']){

	    		$sisa_bayar  = $transaksi['sisa_bayar'] - $p['jumlah_bayar'];
	    		$total_bayar = $transaksi['total_bayar'] + $p['jumlah_bayar'];

	    		$this->transaksi_model->update([
	    								'total_bayar' => $total_bayar,
	    								'sisa_bayar'  => $sisa_bayar
	    							], $transaksi_id);

	    		$this->transaksi_model->insert_pembayaran([
	    									'transaksi_id'  => $transaksi_id,
	    									'jumlah_bayar'  => $p['jumlah_bayar'],
	    									'tanggal_bayar' => date('Y-m-d H:i:s'),
	    									'keterangan_pembayaran' => $p['keterangan_pembayaran']
	    							]);

	    		$waktu_jurnal = date('Y-m-d H:i:s');

	    		$jurnal[0]['coa_id'] 	   = '1'; //KAS
				$jurnal[0]['transaksi_id'] = $transaksi_id;
				$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
				$jurnal[0]['posisi']	   = 'd';
				$jurnal[0]['nominal']      = $p['jumlah_bayar'];

	    		if($page == 'utang'){
	    			$jurnal[1]['coa_id'] 	   = '4'; //UTANG
	    		}else{
	    			$jurnal[1]['coa_id'] 	   = '6'; //PIUTANG
	    		}	

				$jurnal[1]['transaksi_id'] = $transaksi_id;
				$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
				$jurnal[1]['posisi']	   = 'k';
				$jurnal[1]['nominal']      = $p['jumlah_bayar'];
				$this->db->insert_batch('jurnal', $jurnal);

	    		if($sisa_bayar == 0){
	    			$status = true;
	    			$this->transaksi_model->update(['status' => 'Lunas'], $transaksi_id);
	    			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Pelunasan pembayaran berhasil dilakukan','success'));
	    		}else{
	    			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
	    		}

	    	}else{
	    		$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Jumlah bayar tidak boleh melebihi sisa pembayaran','warning'));
	    	}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('transaksi/keuangan/pelunasan/'.$page.'/detail/'.$transaksi_id);
    	
    }
    
}