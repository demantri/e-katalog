<?php 

class Absensi extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('hr/absensi_model', 'm_absensi');
		$this->load->model('hr/waktu_model', 'm_waktu');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function daftar(){

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
		$data['gaji']    = $this->db->where($req)->get('hr_gaji')->num_rows();

		$cek_work = $this->m_waktu->get_detail('is_aktif','1')->result_array();
		$work_day = [];
		foreach ($cek_work as $row) {
			$work_day[] = $row['hari'];
		}

		$data['workday'] = $work_day;

		$this->template->load('layout/template','transaksi/hr/absensi/daftar', $data);
	}

	public function insert_absen(){

		$jam_masuk  = $this->input->post('jam_masuk');
		$jam_keluar = $this->input->post('jam_keluar');
		$tanggal    = $this->input->post('tanggal');
		
		$hari = $this->m_waktu->get_detail('hari', getDay($tanggal))->row_array();

		if(strtotime($jam_masuk) > strtotime($hari['jam_tiba_mulai']) && strtotime($jam_masuk) < strtotime($hari['jam_tiba_selesai'])){
			if(strtotime($jam_masuk) > strtotime($hari['jam_tiba_terlambat'])){
        		$data['status'] = 'terlambat';
        		
        	}else{
        		$data['status'] = 'hadir';
        	}

        	if(strtotime($jam_keluar) > strtotime($hari['jam_pulang_mulai']) && strtotime($jam_keluar) < strtotime($hari['jam_pulang_selesai'])){

        		$data['karyawan_id']  = $this->input->post('id_karyawan');
        		$data['waktu_masuk']  = $this->input->post('tanggal')." ".$jam_masuk;
        		$data['waktu_keluar'] = $this->input->post('tanggal')." ".$jam_keluar;

        		$this->db->insert('hr_absensi', $data);
        		$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-check"></i> Data absen berhasil dimasukkan','success'));

			}else{
				$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Absen Keluar hanya bisa dilakukan pada jam <b>'.$hari['jam_pulang_mulai'].'</b> s/d <b>'.$hari['jam_pulang_selesai'].'</b>'.' '.$jam_keluar,'warning'));
			}

		}else{
			$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Absen Masuk hanya bisa dilakukan pada jam <b>'.$hari['jam_tiba_mulai'].'</b> s/d <b>'.$hari['jam_tiba_selesai'].'</b>','warning'));
		}

		$bulan = date('m', strtotime($this->input->post('tanggal')));
		$tahun = date('Y', strtotime($this->input->post('tanggal')));

		redirect('transaksi/hr/absensi/daftar?bulan='.$bulan.'&tahun='.$tahun);

	}

	public function cuti(){
		$data['pending'] = $this->m_absensi->get_izin_list(['status' => 'pending'])->result_array();
		$data['approve'] = $this->m_absensi->get_izin_list(['status' => 'approve'])->result_array();
		$data['deny']    = $this->m_absensi->get_izin_list(['status' => 'deny'])->result_array();
		$this->template->load('layout/template','transaksi/hr/absensi/cuti', $data);
	}

	public function set_izin($tipe, $id_izin){
		if(in_array($tipe, ['approve','deny','undo'])){

			$izin = $this->m_absensi->get_izin_detail($id_izin)->row_array();

			if(count($izin) > 0){
				if($tipe == 'undo'){
					$izin_tipe = 'deny';
				}else{
					$izin_tipe = $tipe;
				}
				$data['status'] = $izin_tipe;

				if($this->m_absensi->update_izin($data, $id_izin)){

					if($tipe == 'approve'){
						$period = new DatePeriod(
						     new DateTime($izin['tanggal_mulai']),
						     new DateInterval('P1D'),
						     new DateTime($izin['tanggal_selesai'])
						);

						$i = 0;
	                    foreach ($period as $key => $value){
	                    	$absensi[$i]['karyawan_id'] 			= $izin['karyawan_id'];
	                    	$absensi[$i]['waktu_masuk'] 		    = $value->format('Y-m-d')." 00:00:00";
	                    	$absensi[$i]['waktu_keluar'] 			= $value->format('Y-m-d')." 00:00:00";
	                    	$absensi[$i]['status']					= strtolower($izin['tipe']);
						    $i++;     
						}

						$absensi[$i+1]['karyawan_id'] 				= $izin['karyawan_id'];
                    	$absensi[$i+1]['waktu_masuk'] 		    	= $izin['tanggal_selesai']." 00:00:00";
                    	$absensi[$i+1]['waktu_keluar'] 				= $izin['tanggal_selesai']." 00:00:00";
                    	$absensi[$i+1]['status']					= strtolower($izin['tipe']);

						$this->db->insert_batch('hr_absensi',$absensi);
					
					}else if($tipe == 'undo'){
						$period = new DatePeriod(
						     new DateTime($izin['tanggal_mulai']),
						     new DateInterval('P1D'),
						     new DateTime($izin['tanggal_selesai'])
						);

						$i = 0;
	                    foreach ($period as $key => $value){
	                    	$absensi[$i]['karyawan_id'] 			= $izin['karyawan_id'];
	                    	$absensi[$i]['waktu_masuk'] 		    = $value->format('Y-m-d')." 00:00:00";
	                    	$absensi[$i]['waktu_keluar'] 			= $value->format('Y-m-d')." 00:00:00";
	                    	$absensi[$i]['status']					= strtolower($izin['tipe']);
	                    	$this->db->where($absensi[$i])
						    		 ->delete('hr_absensi'); 
						    $i++;
						}

						$absensi[$i+1]['karyawan_id'] 				= $izin['karyawan_id'];
                    	$absensi[$i+1]['waktu_masuk'] 		    	= $izin['tanggal_selesai']." 00:00:00";
                    	$absensi[$i+1]['waktu_keluar'] 				= $izin['tanggal_selesai']." 00:00:00";
                    	$absensi[$i+1]['status']					= strtolower($izin['tipe']);
                    	$this->db->where($absensi[$i+1])
						    	 ->delete('hr_absensi'); 
					}

					$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
				}else{
					$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Terjadi kesalahan saat ubah data','danger'));
				}

				redirect('transaksi/hr/absensi/cuti');

			}else{
				redirect();
			}

		}else{
			redirect();
		}
	}


	public function insert_izin(){
		if($this->session->userdata('login') && $this->session->userdata('role') == 'karyawan'){
			$this->form_validation->set_rules('tipe', 'Tipe', 'required|in_list[Izin,Sakit,Dinas]');
			$this->form_validation->set_rules('start', 'Tanggal Mulai', 'required');
			$this->form_validation->set_rules('end', 'Tanggal Selesai', 'required');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');


			if ($this->form_validation->run() == TRUE){
				$start = $this->input->post('start');
				$end   = $this->input->post('end');
				$i = 0;

				$period = new DatePeriod(
				    		 new DateTime($start),
				     		 new DateInterval('P1D'),
				     		 new DateTime($end)
				);

                foreach ($period as $key => $value){
                	$check = $this->db->where('karyawan_id', $this->session->userdata('user_data')['id'])
		                			  ->where('CAST(waktu_masuk AS date) =', $value->format('Y-m-d'))
		                			  ->get('hr_absensi')
		                			  ->num_rows();
		            if($check > 0){
		            	$i++;
		            }  
				}

				if($start == $end){
					$check = $this->db->where('karyawan_id', $this->session->userdata('user_data')['id'])
		                			  ->where('CAST(waktu_masuk AS date) =', $start)
		                			  ->get('hr_absensi')
		                			  ->num_rows();
		            if($check > 0){
		            	$i++;
		            }  
                	
				}else{
					$check = $this->db->where('karyawan_id', $this->session->userdata('user_data')['id'])
		                			  ->where('CAST(waktu_masuk AS date) = ', $end)
		                			  ->get('hr_absensi')
		                			  ->num_rows();
		            if($check > 0){
		            	$i++;
		            }  
				}

				if($i == 0){
					$data = array(
						'karyawan_id' => $this->session->userdata('user_data')['id'],
						'tipe' => $this->input->post('tipe'),
						'tanggal_mulai' => $this->input->post('start'),
						'tanggal_selesai' => $this->input->post('end'),
						'keterangan' => $this->input->post('keterangan')
					);

					if($this->m_absensi->insert_izin($data)){
						$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
					}else{
						$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Terjadi kesalahan saat input data','danger'));
					}
				
				}else{

					$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Keterangan kehadiran sudah tercatat, harap pilih rentang tanggal lain','warning'));	

				}

				
			}else{
				$this->session->set_flashdata('alert_message',show_alert(validation_errors(),'warning'));	
			}

			redirect('karyawan/izin');

		}else{
			redirect();
		}
	}
    
}