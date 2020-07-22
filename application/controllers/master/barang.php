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

	// public function view()
	// {
	// 	// $data['barang'] = $this->barang->get_data();
	// 	// print_r($data['barang']);
	// 	$this->template->load('master/barangv', 'dashboard', $data);
	// }

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

    // test

    public function save(){
		$data = array(
            array(
                'field' => 'id',
                'label' => 'ID Barang',
                'rules' => 'required|is_unique[merk.id]',
                'errors' => array(
                'required' => '%s tidak boleh kosong',
                'is_unique' => "".$_POST['id']." sudah terdaftar!"
                )
            ),
            array(
                'field' => 'id_jenisbarang',
                'label' => 'Jenis barang',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s harus dipilih!'
                )
            ),
            array(
                'field' => 'id_merk',
                'label' => 'Merk',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s harus dipilih!'
                )
            ),
            array(
                'field' => 'namabarang',
                'label' => 'Nama barang',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s harus tidak boleh kosong.'
                )
            ),
            array(
                'field' => 'warna',
                'label' => 'Warna',
                'rules' => 'required',
                'errors' => array(
                    'required' => '%s harus dipilih!'
                )
            ),
            array(
                'field' => 'stok',
                'label' => 'Stok',
                'rules' => 'is_natural|required',
                'errors' => array(
                    'is_natural' => 'Harus berupa angka!',
                    'required' 		=> 'Harus diisi!'
                )
            ),
            array(
                'field' => 'harga',
                'label' => 'Harga',
                'rules' => 'is_natural|required',
                'errors' => array(
                    'is_natural'	=> 'Harus berupa angka!', 
                    'required' 		=> 'Harus diisi!'
                )
            ),
            array(
                'field' => 'nama_file',
                'label' => 'File',
                'rules' => 'required',
                'errors' => array(
                    // 'is_natural'	=> 'Harus berupa angka!', 
                    'required' 		=> '%s harus diisi!'
                )
            )
            
        );
        
        $this->form_validation->set_rules($data);
        // $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><li>', '</li></div>');
        // print_r($data);exit;

        $config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2999;
		$config['max_width']            = 1920;
		$config['max_height']           = 1080;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);

        if ($this->form_validation->run() == FALSE){
        $this->session->set_flashdata('error_message', show_alert('<i class="fa fa-close"></i><strong>Data gagal tersimpan!</strong>','danger'));
        $this->tambah();
	        if (!$this->upload->do_upload('nama_file')) {
					redirect('master/barang/tambah');
			} else {
				$data['nama_file'] = $this->upload->data("file_name");
				$data['keterangan'] = $this->input->post('keterangan');
				$data['tipe_berkas'] = $this->upload->data('file_ext');
				$data['ukuran_berkas'] = $this->upload->data('file_size');

				$this->db->insert('upload_file',$data);
				redirect('master/barang');
			} 
		}else{
            $this->session->set_flashdata('success_message', show_alert('<i class="fa fa-check"></i><strong>Berhasil!</strong> Data tersimpan.','success'));
            $this->db->insert('barang', $_POST);
            redirect('master/barang');
        }
	}
}