<?php 

class Review extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('transaksi_model');
		$this->load->model('asset/Aktiva_model', 'm_aktiva');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function cashflow(){

		$data['req'] = $this->db->where([
									'is_created' => '1',
									'jenis'		 => 'keluar'
								])
								->or_where([
									'tipe'		 => 'bank'
								])
								->order_by('id', 'DESC')
								->get('transaksi')->result_array();

		$this->template->load('layout/template','review/keuangan/index', $data);
	}

	public function detail_cashflow($transaksi_id){
		$perolehan = $this->transaksi_model->get_detail('id', $transaksi_id);
		
		if($perolehan->num_rows() > 0){
			$data['transaksi']  = $perolehan->row_array();

			if($data['transaksi']['tipe'] == 'bank'){
				if($data['transaksi']['jenis'] == 'masuk'){
					$title = 'Setoran Bank Masuk';
				}else{
					$title = 'Setoran Bank Keluar';
				}

				$item[0]['komponen']  = $title;
				$item[0]['qty'] 	  = '1';
				$item[0]['subtotal']  = $data['transaksi']['total_transaksi'];

			}else{
				$item = $this->transaksi_model->get_list_item($data['transaksi']['tipe'], $data['transaksi']['id']);
			}

			$data['item'] = $item;

			$data['pembayaran'] = $this->transaksi_model->get_list_pembayaran($data['transaksi']['id']);
			$this->template->load('layout/template','review/keuangan/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Perolehan tidak diketahui','danger'));
			redirect('transaksi/review/cashflow');
		}
	}

	public function set_approval($set, $transaksi_id){
		if(in_array($set, ['approve', 'deny'])){

			$get = $this->transaksi_model->get_detail('id', $transaksi_id)->row_array();

			if($get['tipe'] == 'bank'){
				$p['level'] = '3';
				
			}else{
				if($set == 'approve'){
					$p['level']   = '2';
				}else{
					$p['level']	  = '0';
					$p['is_deny'] = '1';
				}
			}

			$this->transaksi_model->update($p, $transaksi_id);
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Status Berhasil diubah','success'));
			redirect('transaksi/review/cashflow/detail/'.$transaksi_id);

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Transaksi tidak diketahui','danger'));
			redirect('transaksi/review/cashflow');
		}
	}

	
}