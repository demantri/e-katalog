<?php 

class merk extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('master/barang_model', 'merk');

		// if(!$this->session->userdata('login')){
		// 	redirect('');
		// }
	}

	public function index(){
		$data['merk'] = $this->merk->get_merk();
		$this->template->load('master/merkv', 'dashboard', $data);
		// $this->template->load('layout/admin/home', 'dashboard');
	}

	public function tambah()
	{
		$this->template->load('master/merkf', 'dashboard');
	}

}