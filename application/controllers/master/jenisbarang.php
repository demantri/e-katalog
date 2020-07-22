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

	public function tambah()
	{
		$data['kode'] = $this->jenis->id_jenis();
		// print($data['kode']);exit;
		$this->template->load('master/jenisf', 'dashboard', $data);
	}

	public function save(){
        $config = array(
            array(
                'field' => 'id',
                'label' => 'No Akun',
                'rules' => 'required|is_unique[jenisbarang.id]',
                'errors' => array(
                    'required' => '%s tidak boleh kosong',
               'is_unique' => "".$_POST['id']." sudah ada di database"
                )
            ),
            array(
                'field' => 'jenis',
                'label' => 'Nama Jenis',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s tidak boleh kosong'
                )
              )
            
        );
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>', '</li></div>');
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE){
            $this->tambah();
        }else{
            $this->db->insert('jenisbarang', $_POST);
            redirect('master/jenisbarang');
        }
    }

}