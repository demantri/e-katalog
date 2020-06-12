<?php 

class User extends CI_Controller{


	public function index(){
		$this->template->load('layout/admin/home', 'dashboard');
	}

	/*public function produk_page()
	{
		$this->template->load('layout/home','layout/product_page');
	}*/

}