<?php 

class jenisbarang extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('master/barang_model', 'jenis');

		// if(!$this->session->userdata('login')){
		// 	redirect('');
		// }
	}

	public function index(){
		$data['jenis'] = $this->jenis->get_jenis();
		// print_r($data['jenis']);exit;
		$this->template->load('master/jenisv', 'dashboard', $data);
		// $this->template->load('layout/admin/home', 'dashboard');
	}

	// public function view()
	// {
	// 	$data['jenis'] = $this->jenis->get_jenis();
	// 	// print_r($data['jenis']);
	// 	$this->template->load('master/jenisv', 'dashboard', $data);
	// }

	// public function tambah()
	// {
	// 	$this->template->load('master/jenisf', 'dashboard');
	// }

}