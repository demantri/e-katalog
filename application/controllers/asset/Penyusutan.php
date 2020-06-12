<?php 

class Penyusutan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('transaksi_model');
		$this->load->model('asset/penyusutan_model', 'm_penyusutan');
		$this->load->model('asset/aktiva_model', 'm_aktiva');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){

		$req = $res = [];

	  	if($this->input->get('id_aset')){
	  		$data['detail_aset']  = $this->m_aktiva->get_list_detail($this->input->get('id_aset'));
	  		$req['id_detail_aset'] = $this->input->get('id_detail_aset');
	  	}

	  	$data['penyusutan'] = $this->m_penyusutan->get_dataPenyusutan($req);
		
	  	$log = $this->db->where('tahun', date('Y'))
	  					->order_by('bulan','ASC')
	  					->get('a_penyusutan_log')
	  					->result_array();

	  	foreach ($log as $val) {
	  		$res[] = $val['bulan'];
	  	}

	  	$data['aset'] = $this->m_aktiva->get_data();
	  	$data['log']  = $res;

		$this->template->load('layout/template','transaksi/asset/penyusutan/index', $data);
	}

	
	public function call_detail_aset(){
	    
	    $data = $this->db->select('*, a_aset_detail.id AS detail_aset_id')
	    				 ->where('a_aset_detail.aset_id', $this->input->post('id_aset'))
	    				 ->where('is_retur', '0')
	    				 ->where('is_konfirmasi', '1')
	    				 ->join('transaksi_aset','transaksi_aset.id = a_aset_detail.transaksi_aset_id')
	    				 ->join('transaksi', 'transaksi.id = transaksi_aset.transaksi_id')
	    				 ->get('a_aset_detail');

	    if($data->num_rows() > 0){
	      $response['status'] = 'success';
	      $response['data']   = $data->result_array();
	    
	    }else{
	      $response['status']  = 'error';
	      $response['message'] = 'Ruangan tidak punya aset';
	    }

	    echo json_encode($response);
  	}

}