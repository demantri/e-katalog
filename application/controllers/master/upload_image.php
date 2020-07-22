<?php /**
 * 
 */
class upload_image extends ci_controller
{
	
	function __construct(){
		parent::__construct();	
		$this->load->model('master/barang_model', 'model');

		// if(!$this->session->userdata('login')){
		// 	redirect('');
		// }
	}

	public function index(){
		$data['file'] = $this->model->data_upload();
		// print_r($data['barang']);
		$this->template->load('master/gambarv', 'dashboard', $data);
	}

	public function add()
	{
        // $data['kode'] =  $this->model->kd_upload();
        // $data['jenis'] = $this->barang->get_kategori();
		$this->template->load('master/gambarf', 'dashboard', $data);
	}

	function save()
	{
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2999;
		$config['max_width']            = 1920;
		$config['max_height']           = 1080;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('nama_file'))
		{
				redirect('master/upload_image/add');
		}
		else
		{
			$data['nama_file'] = $this->upload->data("file_name");
			$data['keterangan'] = $this->input->post('keterangan');
			$data['tipe_berkas'] = $this->upload->data('file_ext');
			$data['ukuran_berkas'] = $this->upload->data('file_size');

			$this->db->insert('upload_file',$data);
			redirect('master/upload_image');
		}
	}

}

?>