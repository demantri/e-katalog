<?php 

class Laporan extends CI_Controller{

	function __construct(){
		parent::__construct();	

		$this->load->model('laporan_model');
		$this->load->model('keuangan/Coa_model', 'm_coa');

		$this->load->model('hr/absensi_model', 'm_absensi');
		$this->load->model('hr/gaji_model', 'm_gaji');
		$this->load->model('hr/tunjangan_model', 'm_tunjangan');
		$this->load->model('hr/karyawan_model', 'm_karyawan');
		$this->load->model('akademik/Siswa_model', 'm_siswa');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function jurnal(){
		if($this->input->get('start')){
			$data['jurnal'] = $this->laporan_model->get_jurnal([
														// 'jurnal.status' => '0',
														'DATE(waktu_jurnal) >=' => $this->input->get('start'),
														'DATE(waktu_jurnal) <=' => $this->input->get('end')
													])->result_array();
			// print_r($data['jurnal']);exit;
		}else{
			$data['jurnal'] = $this->laporan_model->get_jurnal(['jurnal.status' => '0'])->result_array();
		}

		$this->template->load('layout/template','laporan/jurnal', $data);
	}

	public function buku_besar(){
		if($this->input->get('bulan')){
			$req = [
				'jurnal.status' 	   => '1',
				'MONTH(waktu_jurnal) ' => $this->input->get('bulan'),
				'YEAR(waktu_jurnal)'   => $this->input->get('tahun')
			];

			if($this->input->get('coa_id') != 'all'){
				$req['coa_id'] = $this->input->get('coa_id');
			}

			$data['jurnal'] = $this->laporan_model->get_jurnal($req)->result_array();
		}else{
			$req = [
				'jurnal.status' 	   => '1',
				'MONTH(waktu_jurnal) ' => date('m'),
				'YEAR(waktu_jurnal)'   => date('Y')
			];
			$data['jurnal'] = $this->laporan_model->get_jurnal($req)->result_array();
		}

		$data['akun'] = $this->m_coa->get_data();

		$this->template->load('layout/template','laporan/buku_besar', $data);
	}

	public function penggajian(){

			if($this->input->get('tahun')){
				$data['tahun'] = $this->input->get('tahun');
			}else{
				$data['tahun'] = date('Y');
			}

			$stop = false;

			for ($i=1; $i <= 12; $i++){ 
				$list[$i] = $this->m_gaji->get_list($i, $data['tahun']);
				$list[$i]['next'] = $this->m_gaji->calculateGaji($i, $data['tahun']);
			}

			$data['gaji'] = $list;

			$this->template->load('layout/template','laporan/penggajian', $data);
	}

	public function penggajian_detail($bulan, $tahun){
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['gaji'] = $this->m_gaji->calculateGaji($bulan, $tahun);
		$this->load->view('laporan/penggajian_detail',$data);
	} 

	public function piutang($tipe){
		if(in_array($tipe, ['karyawan', 'siswa'])){
			$req = [];

			if($this->input->get('bulan')){
				$req['bulan'] = $this->input->get('bulan');
			}
			if($this->input->get('tahun')){
				$req['tahun'] = $this->input->get('tahun');
			}
			if($this->input->get('com_id')){
				$req['com_id'] = $this->input->get('com_id');
			}

			$data['list']  = $this->laporan_model->get_kartu_piutang($tipe, $req);

			if($tipe == 'karyawan'){
				$list = $this->m_karyawan->get_data();
				$data['detail'] = $this->m_karyawan->get_detail('hr_karyawan.id', $this->input->get('com_id'))->row_array();
			}else{
				$list = $this->m_siswa->get_data();
				$data['detail'] = $this->m_karyawan->get_detail('ak_siswa.id', $this->input->get('com_id'))->row_array();
			}
			$data['com'] = $list;
			
			$this->template->load('layout/template','laporan/piutang/'.$tipe, $data);

		}else{
			show_404();
		}
	}

	
}