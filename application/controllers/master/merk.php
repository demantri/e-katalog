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
		// print_r($data['merk']);
		$this->template->load('master/merkv', 'dashboard', $data);
		// $this->template->load('layout/admin/home', 'dashboard');
	}

	public function tambah()
	{
		$data['kode'] = $this->merk->id_merk();
		// print($data['kode']);exit;
		$data['jenis'] = $this->merk->get_jenis();

		$this->template->load('master/merkf', 'dashboard', $data);
	}

	public function save(){
        $config = array(
            array(
                'field' => 'id',
                'label' => 'ID Merk',
                'rules' => 'required|is_unique[merk.id]',
                'errors' => array(
                'required' => '%s tidak boleh kosong',
                'is_unique' => "".$_POST['id']." sudah terdaftar!"
                )
            ),
            array(
                'field' => 'id_jenis',
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s tidak boleh kosong'
                )
            ),
            array(
                'field' => 'nama_merk',
                'label' => 'Nama Merk',
                'rules' => 'required|is_unique[merk.nama_merk]',
                'errors' => array(
                    'required'  => '%s harus diisi!',
                    'is_unique' => 'Merk sudah tersimpan sebelumnya, silahkan tambah merk baru..'
                )
              )
            
        );
        
        $this->form_validation->set_rules($config);
        // $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>', '</li></div>');

        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('error_message', show_alert('<i class="fa fa-close"></i><strong>Data gagal tersimpan!</strong>','danger'));
        $this->tambah();
        }else{
            $this->session->set_flashdata('success_message', show_alert('<i class="fa fa-check"></i><strong>Berhasil!</strong> Data tersimpan.','success'));
            $this->db->insert('merk', $_POST);
            redirect('master/merk');
        }
    }

}