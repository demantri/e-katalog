<?php 

class Produk extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('user_model');
		$this->load->model('hr/absensi_model', 'm_absensi');
		$this->load->model('hr/waktu_model', 'm_waktu');
		$this->load->model('hr/gaji_model', 'm_gaji');
		$this->load->model('transaksi_model');

		// if(!$this->session->userdata('login')){
		// 	redirect('');
		// }
	}

	public function index(){
		$this->template->load('layout/home','dashboard');
	}

	public function produk_page()
	{
		$this->template->load('layout/home','layout/product_page');
	}

}