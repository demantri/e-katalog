<?php 

class Dashboard extends CI_Controller{

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
		$this->template->load('layout/home');
	}

	public function karyawan(){
		if($this->input->get('bulan')){
			$req['bulan'] = $this->input->get('bulan');
		}else{
			$req['bulan'] = date('m');
		}

		if($this->input->get('tahun')){
			$req['tahun'] = $this->input->get('tahun');
		}else{
			$req['tahun'] = date('Y');
		}

		$req['condition'] = array(
			'karyawan.id' => $this->session->userdata('user_data')['id']
		);
		$absensi = $this->m_absensi->get_list($req)->result_array();

		$ab = [];
		foreach ($absensi as $row){
			$ab[$row['id']]['id_karyawan']   = $row['id'];
			$ab[$row['id']]['nama_karyawan'] = $row['nama_karyawan'];
			$ab[$row['id']]['absensi'][$row['hari']]['id_absensi'] 	 = $row['id_absensi'];
			$ab[$row['id']]['absensi'][$row['hari']]['hari'] 		 = $row['hari'];
			$ab[$row['id']]['absensi'][$row['hari']]['waktu_masuk']  = $row['waktu_masuk'];
			$ab[$row['id']]['absensi'][$row['hari']]['waktu_keluar'] = $row['waktu_keluar'];
			$ab[$row['id']]['absensi'][$row['hari']]['status'] 	     = $row['status'];
		}

		$data['get']     = $this->m_waktu->get_data();
		$data['absensi'] = $ab;
		//$data['gaji']    = $this->db->where($req)->get('hr_gaji')->num_rows();

		$cek_work = $this->m_waktu->get_detail('is_aktif','1')->result_array();
		$work_day = [];
		foreach ($cek_work as $row) {
			$work_day[] = $row['hari'];
		}

		$data['workday'] = $work_day;

		$cond = array(
					'karyawan.id' => $this->session->userdata('user_data')['id'],
					'MONTH(izin.tanggal_mulai)' => $req['bulan'],
					'YEAR(izin.tanggal_mulai)' => $req['tahun'],
					'status' => 'approve'
				);
		$izin = $this->m_absensi->get_izin_list($cond)->result_array();
		$d = 0;
		foreach ($izin as $row) {
			$date1 = new DateTime($row['tanggal_mulai']);
            $date2 = new DateTime($row['tanggal_selesai']);
            $interval = $date1->diff($date2);
            $d += $interval->days + 1;
		}

		$data['total_cuti'] = $d;

		$this->template->load('layout/karyawan', 'karyawan/index', $data);
	}

	public function izin(){

		if($this->session->userdata('login') && $this->session->userdata('role') == 'karyawan'){
			$data['active'] = 'izin';
			$data['pending'] = $this->m_absensi->get_izin_list(['status' => 'pending', 'karyawan.id' => $this->session->userdata('user_data')['id']])->result_array();
			$data['approve'] = $this->m_absensi->get_izin_list(['status' => 'approve', 'karyawan.id' => $this->session->userdata('user_data')['id']])->result_array();
			$data['deny'] = $this->m_absensi->get_izin_list(['status' => 'deny', 'karyawan.id' => $this->session->userdata('user_data')['id']])->result_array();
			$this->template->load('layout/karyawan','karyawan/izin', $data);
		
		}else{
			redirect();
		}
	}

	public function gaji(){

		if($this->session->userdata('login') && $this->session->userdata('role') == 'karyawan'){
			$data['active'] = 'gaji';

			if($this->input->get('tahun')){
				$data['tahun'] = $this->input->get('tahun');
			}else{
				$data['tahun'] = date('Y');
			}

			$stop = false;

			for ($i=1; $i <= 12; $i++){ 
				$list[$i] = $this->m_gaji->get_list($i, $data['tahun'], $this->session->userdata('user_data')['id']);
				$list[$i]['next'] = $this->m_gaji->calculateGaji($i, $data['tahun'], $this->session->userdata('user_data')['id']);
			}

			$data['gaji'] = $list;
			$this->template->load('layout/karyawan','karyawan/gaji', $data);
		
		}else{
			redirect();
		}
	}

	public function gaji_detail($id_gaji){
		if($this->session->userdata('login') && $this->session->userdata('role') == 'karyawan'){

			$id_karyawan = $this->session->userdata('user_data')['id'];
			$data['gaji'] = $this->m_gaji->get_detail($id_gaji, $id_karyawan)->row_array();

			if(count($data['gaji']) > 0){

				$data['active'] = 'gaji';
				$data['list'] = $this->m_gaji->get_list_detail($id_gaji, $id_karyawan)->result_array();
				//var_dump($data['list']);
				$this->template->load('layout/karyawan','karyawan/gaji_detail',$data);
			}else{
				redirect('karyawan/gaji');
			}

		}else{
			reidirect();
		}
	}

	public function gaji_detail_cetak($id_gaji){
		if($this->session->userdata('login')){

			$this->load->model('gaji_model');
			$id_karyawan = $this->session->userdata('data_user')['id'];
			$data['gaji'] = $this->m_gaji->get_detail($id_gaji, $id_karyawan)->row_array();

			if(count($data['gaji']) > 0){

				$data['active'] = 'gaji';
				$data['list'] = $this->m_gaji->get_list_detail($id_gaji, $id_karyawan)->row_array();

				$this->load->view('auth_karyawan/gaji_cetak',$data);
			}else{
				redirect('auth_karyawan/gaji');
			}

		}else{
			reidirect();
		}
	}

	public function pinjaman(){
		if($this->session->userdata('login') && $this->session->userdata('role') == 'karyawan'){
			$karyawan_id = $this->session->userdata('user_data')['id'];

			$data['pinjaman_pending'] = $this->transaksi_model->get_detail([
																'is_deny' => '0', 
																'level <' => '3',
																'level >=' => '1',
																'tipe' => 'pinjaman'])->result_array();
			$data['pinjaman_acc'] = $this->transaksi_model->get_detail(['is_deny' => '0', 'level' => '3', 'tipe' => 'pinjaman'])->result_array();
			$data['pinjaman_deny'] = $this->transaksi_model->get_detail(['level' => '0', 'tipe'=> 'pinjaman'])->result_array();
			$data['sisa_pinjaman'] = $this->transaksi_model->get_nominal_pinjaman($karyawan_id);
			$data['gaji']		   = $this->db->where('karyawan.id', $karyawan_id)
											  ->join('hr_jabatan jabatan', 'jabatan.id = karyawan.jabatan_id')
											  ->get('hr_karyawan karyawan')->row_array()['gaji'];

			$this->template->load('layout/karyawan','karyawan/pinjaman',$data);

		}else{
			reidirect();
		}
	}

}