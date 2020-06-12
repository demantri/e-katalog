<?php 

class barang extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('master/barang_model', 'barang');

		// if(!$this->session->userdata('login')){
		// 	redirect('');
		// }
	}

	public function index(){
		$data['barang'] = $this->barang->get_data();
		// print_r($data['barang']);
		$this->template->load('master/barangv', 'dashboard', $data);
	}

	public function view()
	{
		$data['barang'] = $this->barang->get_data();
		// print_r($data['barang']);
		$this->template->load('master/barangv', 'dashboard', $data);
	}

	public function tambah()
	{
        $data['kode'] =  $this->barang->kode();
        $data['jenis'] = $this->barang->get_kategori();
		$this->template->load('master/barangf', 'dashboard', $data);
	}

	function get_sub_merk(){
        if($this->input->post('id_jenisbarang'))
          {
           echo $this->barang->get_sub_merk($this->input->post('id_jenisbarang'));
          }
    }

}