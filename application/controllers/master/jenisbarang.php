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

    public function save()
    {
        $this->form_validation->set_rules('id', 'ID Jenis', 'required|is_unique[jenisbarang.id]');
        $this->form_validation->set_rules('jenis', 'Jenis Barang', 'required|min_length[3]',
        array(
                'required'      => '* %s tidak boleh kosong.',
                'min_length'    => '* min 3 karakter.'
            ));

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error_message', show_alert('<i class="fa fa-close"></i><strong>Data gagal tersimpan!</strong>','danger'));
        $this->tambah();
        }else{
            $this->session->set_flashdata('success_message', show_alert('<i class="fa fa-check"></i><strong>Berhasil!</strong> Data tersimpan.','success'));
            $this->db->insert('jenisbarang', $_POST);
            redirect('master/jenisbarang');
        }
    }

}