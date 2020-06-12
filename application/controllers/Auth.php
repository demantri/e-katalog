<?php 

class Auth extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('user_model');	
		$this->load->model('hr/karyawan_model', 'm_pegawai');
		$this->load->model('hr/absensi_model', 'm_absensi');
	}

	public function index(){
		if($this->session->userdata('login')){
			redirect('dashboard');
		
		}else{
			$this->load->view('login');
		}
	}

	public function login(){
		$p = $this->input->post();

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == TRUE){

			$check = $this->user_model->get_detail($p);

			if($check->num_rows() > 0){

				$data_user = $check->row_array();
				$this->session->set_userdata('role', 'admin');
				$this->session->set_userdata('login', true);
				$this->session->set_userdata('user_data', $data_user);
				redirect('dashboard');

			}else{

				$check = $this->db->where($p)->get('hr_karyawan');

				if($check->num_rows() > 0){
					$data_user = $check->row_array();
					$this->session->set_userdata('role', 'karyawan');
					$this->session->set_userdata('login', true);
					$this->session->set_userdata('user_data', $data_user);
					redirect('karyawan');

				}else{
					$this->session->set_flashdata('alert_message', show_alert('<b><i class="fa fa-danger"></i> Username / Password Salah</b><br> Silahkan masukkan username / password dengan benar','danger'));
					redirect('');
				}

			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'danger'));
			redirect('');
		}
	}

	public function rfid(){
		$this->load->view('rfid');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}

	public function insert_rfid(){
		$rfid = $this->input->post('rfid');
		$cek  = $this->m_pegawai->get_detail('rfid', $rfid);

		if($cek->num_rows() > 0){
			$pegawai = $cek->row_array();

			$jam  	 = date('H:i:s');
			$tanggal = date('Y-m-d');

			$cek_kerja = $this->db->where('is_aktif', '1')->get('hr_waktu')->result_array();
			$hari_kerja = [];
			foreach ($cek_kerja as $row) {
				$hari_kerja[] = $row['hari'];
			}

			$jam_kerja = $this->db->where('hari', getDay($tanggal))->get('hr_waktu')->row_array();

			if(filterDay($tanggal, $hari_kerja)){

				$tanggal = date('Y-m-d');
				$absen   = $this->m_absensi->get_detail([
												'DATE(waktu_masuk)' => $tanggal,
												'karyawan_id'		=> $pegawai['karyawan_id']
											]);

				if($absen->num_rows() > 0){
					$p = $absen->row_array();

					$s = true;

					if($p['waktu_masuk'] != '' && !(strtotime($jam) > strtotime($jam_kerja['jam_pulang_mulai']) && strtotime($jam) < strtotime($jam_kerja['jam_pulang_selesai']))){
						$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Absen Masuk sudah dilakukan hari ini','warning'));
						$s = false;

					}else if($p['waktu_keluar'] != ''){
						$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Absen Pulang sudah dilakukan hari ini','warning'));
						$s = false;
					}

					if($s){
						if($this->m_absensi->update(['waktu_keluar' => $tanggal." ".$jam], $p['id'])){
				        		$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-check"></i> Absensi Pulang Berhasil Dilakukan','success'));

			        	}else{
			        		$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-times"></i> Absen Gagal Dimasukkan','danger'));
			        	}
					}

				}else{
					if(strtotime($jam) > strtotime($jam_kerja['jam_tiba_mulai']) && strtotime($jam) < strtotime($jam_kerja['jam_tiba_selesai'])){
						if(strtotime($jam) > strtotime($jam_kerja['jam_tiba_terlambat'])){
			        		$data['status'] = 'terlambat';
			        		
			        	}else{
			        		$data['status'] = 'hadir';
			        	}

			        	$data['waktu_masuk'] = $tanggal." ".$jam;
			        	$data['karyawan_id']	 = $pegawai['karyawan_id'];

			        	if($this->m_absensi->insert($data)){
			        		$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-check"></i> Absensi Masuk Berhasil Dilakukan','success'));

			        	}else{
			        		$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-times"></i> Absen Gagal Dimasukkan','danger'));
			        	}

			        }else{
			        	$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Bukan Jam Absen','warning'));
			        }
			        
				}

			}else{
				$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Bukan Masa Hari Kerja','warning'));
			}

		}else{
			$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-times"></i> RFID tidak ditemukan','danger'));
		}

		redirect('rfid');
	}
}