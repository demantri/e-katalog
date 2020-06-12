<?php 

class Pembayaran extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('transaksi_model');
		$this->load->model('akademik/komponen_model', 'm_komponen');
		$this->load->model('akademik/siswa_model', 'm_siswa');
		$this->load->model('akademik/kelas_model', 'm_kelas');
		$this->load->model('akademik/pembayaran_model', 'm_pembayaran');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function pembayaran_pendidikan($tipe){
		$data[] = [];

		if(in_array($tipe, ['pendaftaran','operasional'])){
			if($this->input->get('komp')){
				if($tipe == 'pendaftaran'){
					$search = 'kode_pendaftaran';
					$komp   = 'Pendaftaran';

				}else{
					$search = 'nis';
					$komp   = 'Operasional'; 
				}

				$siswa = $this->m_siswa->get_detail($search, $this->input->get('komp'));

				if($siswa->num_rows() > 0){
					$data['siswa']      = $siswa->row_array();
					$data['kelas']		= $this->m_kelas->get_data();
					$data['pembayaran'] = $this->m_pembayaran->get_unpaid($data['siswa']['ak_siswa_id'], $data['siswa']['tahun_ajaran_id'], $komp);

				}else{
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Kode tidak ditemukan','danger'));
					redirect('transaksi/keuangan/pembayaran_pendidikan/pendaftaran');
				}
			}

			$this->template->load('layout/template','transaksi/akademik/pembayaran/'.$tipe.'/index', $data);

		}else{
			show_404();
		}

	}

	public function insert_pendaftaran(){
		$p = $this->input->post();
		$n = 0;

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nis', 'NIS', 'required|numeric');
		$this->form_validation->set_rules('kelas_id', 'Kelas', 'required|numeric');

		if($this->form_validation->run() == TRUE){
			
			$this->db->trans_begin();

			foreach ($p['bayar'] as $row) { $n++;
				
			}

			$trans = $this->db->where('siswa_id', $p['siswa_id'])
							  ->where('tipe','komponen_pendidikan')
							  ->limit(1)->get('transaksi')->row_array();

			if($n > 0){
				$data = [
					'nis' 	   => $p['nis'],
					'kelas_id' => $p['kelas_id'],
					'level'	   => '1'
				];
				$this->m_siswa->update($data, $p['siswa_id']);

				$this->transaksi_model->update([
											'total_bayar' => $trans['total_transaksi'],
											'status'	  => 'Lunas'
										], $trans['id']);

				$waktu_jurnal = date('Y-m-d H:i:s');

				unset($trans['id']);
				$trans['kode_transaksi'] = str_replace('KMPP', 'PKMPP', $trans['kode_transaksi']);
				$trans['pembayaran']     = 'Tunai';
				$this->transaksi_model->insert($trans);

				$trans = [];

				$trans = $this->db->where('siswa_id', $p['siswa_id'])
							  ->where('tipe','komponen_pendidikan')
							  ->order_by('id', 'DESC')
							  ->limit(1)->get('transaksi')->row_array();

				$jurnal[0]['coa_id'] 	   = '7'; //Pendaftaran Diterima Dimuka
				$jurnal[0]['transaksi_id'] = $trans['id'];
				$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
				$jurnal[0]['posisi']	   = 'd';
				$jurnal[0]['nominal']      = $trans['total_transaksi'];

				$jurnal[1]['coa_id'] 	   = '6'; //Piutang
				$jurnal[1]['transaksi_id'] = $trans['id'];
				$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
				$jurnal[1]['posisi']	   = 'k';
				$jurnal[1]['nominal']      = $trans['total_transaksi'];
				$this->db->insert_batch('jurnal', $jurnal);
				
				if($this->db->trans_status()){
					$this->db->trans_commit();
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check-circle"></i> Pembayaran berhasil dilakukan','success'));

				}else{
					$this->db->trans_rollback();
					$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> Terjadi Kesalahan','danger'));
				}
			
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Silahkan Pilih Komponen Pembayaran','warning'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('transaksi/keuangan/pembayaran_pendidikan/pendaftaran');
	}

	public function operasional(){
		$data[] = [];

		if($this->input->get('nis')){
			$siswa = $this->siswa_model->get_detail('nis', $this->input->get('nis'));

			if($siswa->num_rows() > 0){
				$data['siswa']      = $siswa->row_array();
				$data['pembayaran'] = $this->pembayaran_model->get_unpaid($data['siswa']['siswa_id'], $data['siswa']['tahun_ajaran_id'], 'Bulanan');

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> NIS tidak ditemukan','danger'));
			}
		}

		$this->template->load('layout/template','transaksi/pembayaran/operasional', $data);
	}


	public function insert_bulanan(){

		$this->db->trans_begin();
		$p = $this->input->post();
		$n = 0;
		foreach ($p['bayar'] as $row) { $n++;
			
		}

		$trans = $this->db->where('siswa_id', $p['siswa_id'])
						  ->where('tipe','komponen_operasional')
						  ->order_by('id', 'DESC')
						  ->limit(1)->get('transaksi')->row_array();

		if($n > 0){

			$this->transaksi_model->update([
										'total_bayar' => $trans['total_transaksi'],
										'status'	  => 'Lunas'
									], $trans['id']);

			$waktu_jurnal = date('Y-m-d H:i:s');

			unset($trans['id']);
			$trans['kode_transaksi'] = str_replace('KMPO', 'PKMPO', $trans['kode_transaksi']);
			$trans['pembayaran']     = 'Tunai';
			$trans['status']		 = 'Lunas';
			$this->transaksi_model->insert($trans);

			$trans = [];

			$trans = $this->db->where('siswa_id', $p['siswa_id'])
						  ->where('tipe','komponen_operasional')
						  ->order_by('id', 'DESC')
						  ->limit(1)->get('transaksi')->row_array();

			$jurnal[0]['coa_id'] 	   = '8'; //Pendaftaran Diterima Dimuka
			$jurnal[0]['transaksi_id'] = $trans['id'];
			$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
			$jurnal[0]['posisi']	   = 'd';
			$jurnal[0]['nominal']      = $trans['total_transaksi'];

			$jurnal[1]['coa_id'] 	   = '6'; //Piutang
			$jurnal[1]['transaksi_id'] = $trans['id'];
			$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
			$jurnal[1]['posisi']	   = 'k';
			$jurnal[1]['nominal']      = $trans['total_transaksi'];
			$this->db->insert_batch('jurnal', $jurnal);
			
			if($this->db->trans_status()){
				$this->db->trans_commit();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check-circle"></i> Pembayaran berhasil dilakukan','success'));

			}else{
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-times"></i> Terjadi Kesalahan','danger'));
			}
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-warning"></i> Silahkan Pilih Komponen Pembayaran','warning'));
		}

		redirect('transaksi/keuangan/pembayaran_pendidikan/operasional');
	}
    
}