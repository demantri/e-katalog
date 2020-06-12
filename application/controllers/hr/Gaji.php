<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('hr/absensi_model', 'm_absensi');
		$this->load->model('hr/gaji_model', 'm_gaji');
		$this->load->model('hr/tunjangan_model', 'm_tunjangan');
		$this->load->model('hr/karyawan_model', 'm_karyawan');
		$this->load->model('transaksi_model');

		date_default_timezone_set("Asia/Jakarta");
	}

	public function daftar(){

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

			$this->template->load('layout/template','transaksi/hr/gaji/daftar', $data);
	}

	public function insert_lembur(){
		$this->form_validation->set_rules('karyawan_id', 'Karyawan', 'required');
		$this->form_validation->set_rules('jml_lembur', 'Jam Lembur', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('tgl', 'Tanggal Lembur', 'required');

		if ($this->form_validation->run() == TRUE){

			$lembur = $this->m_tunjangan->get_list('lembur')->result_array();
			$i = 0; $s = true;
			foreach ($lembur as $row){ $i++;

				if($row['jml'] == $this->input->post('jml_lembur')){
					$nominal_lembur = $row['nominal'];
					$s = false;
					break;
				}

				if($i == 1){
					$max = $row['jml'];
					$n_lembur = $row['nominal'];
				}else{
					if($row['jml'] > $max){
						$max = $row['jml'];
						$n_lembur = $row['nominal_lembur'];
					}
				}
			}

			if($s){
				$nominal_lembur = $n_lembur;
			}

			$data = array(
				'karyawan_id' => $this->input->post('karyawan_id'),
				'tanggal' => $this->input->post('tgl'),
				'total_jam' => $this->input->post('jml_lembur'),
				'nominal_lembur' => $nominal_lembur
			);

			if($this->m_gaji->insert_lembur($data)){
				$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Terjadi kesalahan saat input data','danger'));
			}
			
		}else{
			$this->session->set_flashdata('alert_message',show_alert(validation_errors(),'warning'));
		}

		redirect('transaksi/hr/gaji/lembur');

	}

	public function generate_gaji(){
		if($this->input->is_ajax_request()){
			
			$get_waktu = $this->db->where('is_aktif','1')
				 			  	  ->get('hr_waktu')->result_array();
			$work_day = [];

			foreach ($get_waktu as $row) {
				$work_day[] = $row['hari'];
			}

			$req = array(
				'bulan' => $this->input->post('bulan'),
				'tahun' => $this->input->post('tahun')
			);

			$count = $this->db->where($req)
							  ->get('hr_gaji')
							  ->num_rows();

			if($count > 0){
				$response['status']  = 'error';
				$response['message'] = show_alert('<i class="fa fa-warning"></i> Gaji bulan ini sudah digenerate','warning');
			
			}else{
				
				$absensi  = $this->m_absensi->get_list($req, 'gaji')->result_array();

				$bulan    = $req['bulan'];
				$tahun    = $req['tahun'];

				if($this->m_gaji->insert([
								'bulan' => $bulan,
								'tahun' => $tahun,
								'waktu_generate' => date('Y-m-d H:i:s')
							])){

					$history = $this->db->where($req)->get('hr_gaji')->row_array();
					$i = 0;
					$total_gaji = $total_pajak = 0;

					$thr  = $this->db->where(['tipe' => 'tahunan', 'bulan' => $bulan, 'tahun' => $tahun])
						 ->get('hr_tunjangan');
					$lain = $this->db->where('tipe', 'harian')
						 ->or_where('tipe', 'bulanan')
						 ->get('hr_tunjangan')->result_array();

					$waktu = date('Y-m-d H:i:s');

					$this->db->trans_begin();

					foreach ($absensi as $row){
						$nominal_tunjangan = 0;

						$day = [];
						for($d=1; $d<=31; $d++){
			                $time = mktime(12, 0, 0, $bulan, $d, $tahun);          
			                if(date('m', $time) == $bulan){     
			                    $day[]= $d;
			                }
			            }

			            $num_days = 0; $c = 0;
			            foreach ($day as $k){
			            	$c++;
			            	if(filterDay($tahun.'-'.$bulan.'-'.$c, $work_day)){
			            		$num_days++;
			            	}
			            	
			            }

			            $lembur = $this->db->select('SUM(nominal_lembur) AS nominal')
			            				   ->where('karyawan_id', $row['id'])
			            				   ->where('MONTH(tanggal)', $bulan)
			            				   ->where('YEAR(tanggal)', $tahun)
			            				   ->get('hr_lembur')->row_array();
			            $nominal_lembur = $lembur['nominal'];

						$base = $row['gaji'] / $num_days;
						$kehadiran = $row['total_hadir'] + $row['total_dinas'];

						$n_hadir = ($kehadiran * $base);
						$n_telat = $row['total_terlambat'] * ((50/100) * $base);

						$pokok = $n_hadir + $n_telat;
						$nominal_pokok	   = $pokok;

						if($thr->num_rows() > 0){
			            	$tunjangan[] = ['nominal' => (int)$row['gaji'], 'name' => 'THR'];
			            	$nominal_tunjangan += $row['gaji'];

			            }else{
			            	$tunjangan[] = ['nominal' => 0, 'name' => 'THR'];
			            }

			            foreach ($lain as $rows){
			            	$key = str_replace('_', ' ', strtolower($rows['nama_tunjangan']));
			            	if($rows['tipe'] == 'harian'){
			            		$val = $rows['nominal'] * $kehadiran;
			            	}else{
			            		$val = (int)$rows['nominal'];
			            	}
			            	$nominal_tunjangan += $val;
			            	$tunjangan[] = ['nominal' => $val, 'name' => $rows['nama_tunjangan']];
			            }

			            $nominal_hutang = $this->transaksi_model->get_nominal_pinjaman($row['id']);

			            $this->db->where('tipe', 'pinjaman')
				                 ->where('level', '3')
				                 ->where('status', 'Belum Lunas')
				                 ->where('karyawan_id', $row['id']);

				      	$list_hutang = $this->db->get('transaksi')->result_array();

				      	foreach ($list_hutang as $hutang) {
				      		$h['status']      = 'Lunas';
				      		$h['sisa_bayar']  = 0;
				      		$h['total_bayar'] = $hutang['total_transaksi'];

				      		$this->db->insert('transaksi_pembayaran',[
				      						'transaksi_id'	=> $hutang['id'],
				      						'tanggal_bayar' => $waktu,
				      						'jumlah_bayar'  => $hutang['sisa_bayar'],
				      						'keterangan_pembayaran' => 'Pelunasan Otomatis Via Penggajian Bulanan'
				      					]);

				      		$this->db->where('id', $hutang['id'])
				      				 ->update('transaksi', $h);


				      	}

						$data[$i]['gaji_id']	 		= $history['id'];
						$data[$i]['karyawan_id'] 		= $row['id'];
						$data[$i]['total_masuk'] 		= $row['total_masuk'];
						$data[$i]['total_hadir'] 		= $kehadiran;
						$data[$i]['total_terlambat'] 	= $row['total_terlambat'];
						$data[$i]['maksimal_kehadiran'] = $num_days;
						$data[$i]['gaji_pokok'] 		 = $nominal_pokok;
						$data[$i]['gaji_kehadiran']		 = $n_hadir;
						$data[$i]['gaji_keterlambatan']  = $n_telat;		
						$data[$i]['tunjangan_lembur'] 	 = $nominal_lembur;
						$data[$i]['tunjangan_lain']		 = $nominal_tunjangan;
						$data[$i]['tunjangan_komponen']  = json_encode($tunjangan);
						$data[$i]['hutang']				 = $nominal_hutang;
						$data[$i]['total_gaji']			 = $nominal_pokok + $nominal_lembur + $nominal_tunjangan - $nominal_hutang;
						
						$total_gaji += $data[$i]['total_gaji'];

						$i++;
					}

					$this->db->insert_batch('hr_gaji_detail', $data);
					
					if($this->db->trans_status()){
						$this->db->trans_commit();
						$response['status']  = 'success';
						$response['message'] = show_alert('<i class="fa fa-check"></i> Gaji berhasil digenerate','success');
					
					}else{
						$this->db->trans_rollback();
						$response['status']  = 'error';
						$response['message'] = show_alert('<i class="fa fa-warning"></i> Terjadi kesalahan saat generate','danger');
					}

				}else{
					$response['status']  = 'error';
					$response['message'] = show_alert('<i class="fa fa-check"></i> Gagal input gaji','danger');
				}

			}

			echo json_encode($response);

		}else{
			show_404();
		}
	}

	public function lembur(){
		$data['list'] = $this->m_gaji->get_lembur_list()->result_array();
		$data['karyawan'] = $this->m_karyawan->get_data();
		$this->template->load('layout/template','transaksi/hr/gaji/lembur', $data);
	}

	public function detail($id_gaji){
		if($this->session->userdata('login')){
			$data['gaji'] = $this->m_gaji->get_detail($id_gaji)->row_array();

			if(count($data['gaji']) > 0){

				$data['list'] = $this->m_gaji->get_list_detail($id_gaji)->result_array();

				$this->template->load('layout/template','transaksi/hr/gaji/detail',$data);
			}else{
				redirect('transaksi/hr/gaji/daftar');
			}

		}else{
			redirect();
		}
	}

	public function detail_preview($bulan, $tahun){
		if($this->session->userdata('login')){

			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['gaji'] = $this->m_gaji->calculateGaji($bulan, $tahun);
			
			//echo "<pre>".print_r($data['gaji'], true)."</pre>";
			$this->template->load('layout/template','transaksi/hr/gaji/preview',$data);

		}else{
			redirect();
		}
	}

	public function cetak_slip($id_gaji, $id_karyawan){
		if($this->session->userdata('login')){
			$data['gaji'] = $this->m_gaji->get_detail($id_gaji)->row_array();

			if(count($data['gaji']) > 0){
				$data['karyawan'] = $this->m_karyawan->get_detail('hr_karyawan.id',$id_karyawan)->row_array();
				$data['list']     = $this->m_gaji->get_list_detail($id_gaji, $id_karyawan)->row_array();

				$this->load->view('transaksi/hr/gaji/invoice',$data);
			}else{
				redirect('transaksi/hr/gaji/daftar');
			}

		}else{
			redirect();
		}
	}

	public function insert_pinjaman(){
		$p = $this->input->post();
		$p['total_transaksi'] = format_angka($p['total_transaksi']);
		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('total_transaksi', 'Nominal Pinjaman', 'required|numeric|greater_than[0]');

		if ($this->form_validation->run() == TRUE){
			$p['tanggal_transaksi'] = date('Y-m-d H:i:s');
			$p['status']			= 'Belum Lunas';
			$p['is_created']		= '1';
			$p['pembayaran']		= 'Kredit';
			$p['jenis']				= 'keluar';
			$p['tipe']				= 'pinjaman';
			$p['kode_transaksi']	= $this->transaksi_model->generate_code('pinjaman');
			$p['karyawan_id']		= $this->session->userdata('user_data')['id'];
			$p['sisa_bayar']		= $p['total_transaksi'];

			if($this->transaksi_model->insert($p)){
				$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-check"></i> Pinjaman berhasil diajukan','success'));
			}else{
				$this->session->set_flashdata('alert_message',show_alert('<i class="fa fa-warning"></i> Pinjaman gagal diajukan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message',show_alert(validation_errors(),'warning'));
		}

		redirect('karyawan/pinjaman');
	}
}