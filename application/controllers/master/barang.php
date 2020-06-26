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
		// $data['barang'] = $this->barang->get_data();
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

    public function save(){
		$this->form_validation->set_rules('id', 'ID Barang', 'required|is_unique[barang.id]');
		$this->form_validation->set_rules('id_jenisbarang', 'Jenis Barang', 'required');
		$this->form_validation->set_rules('id_merk', 'Merk', 'required');
		$this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('warna', 'Warna', 'required');
		$this->form_validation->set_rules('stok', 'Stok', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');
		$this->form_validation->set_rules('file_upload', 'File Upload', 'required');

		if ($this->form_validation->run() == TRUE) {
			if($this->model->save()){
				$this->session->set_flashdata('notif', '<div class="alert alert-success">Berhasil.</div>');
				redirect('pegawai');
			}else{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger">Terjadi Kesalahan</div>');
				redirect('pegawai');
			}
		} else {
			$this->tambah();
		}
	} 

    

}