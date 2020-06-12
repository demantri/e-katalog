<?php 

class Siswa extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('akademik/siswa_model', 'm_siswa');
		$this->load->model('akademik/tahun_ajaran_model', 'm_ta');
		$this->load->model('transaksi_model');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$data['list']      = $this->m_siswa->get_data();
		$data['last_code'] = $this->m_siswa->generate_code();
		$this->template->load('layout/template','master_data/akademik/siswa/index', $data);
	}

	public function detail($siswa_id){
		$cek = $this->m_siswa->get_detail('ak_siswa.id',$siswa_id);

		if($cek->num_rows() > 0){
			$data['siswa'] = $cek->row_array();
			$this->template->load('layout/template','master_data/akademik/siswa/detail', $data);
		
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> ID Siswa tidak ditemukan','danger'));
			redirect('master_data/akademik/siswa/');
		}

	}

	public function pendaftaran(){
		$this->template->load('layout/template','master_data/akademik/siswa/pendaftaran');
	}

	public function pendaftaran_list(){
		$data['calon'] = $this->m_siswa->get_detail(['level' => '0', 'is_undur' => '0'])->result_array();
		$data['tetap'] = $this->m_siswa->get_detail(['level' => '1', 'is_undur' => '0'])->result_array();
		$data['undur'] = $this->m_siswa->get_detail('is_undur', '1')->result_array();
		$this->template->load('layout/template','master_data/akademik/siswa/index', $data);
	}

	public function insert_pendaftaran(){
		$p = $this->input->post();

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('anak_ke', 'Anak Ke', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('jumlah_saudara', 'Jumlah Saudara', 'required|numeric|greater_than[-1]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[Laki - Laki,Perempuan]');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('agama', 'Agama', 'required');

		$this->form_validation->set_rules('ot_bpk_nama_lengkap', 'Nama Lengka Ayah', 'required');
		$this->form_validation->set_rules('ot_bpk_tempat_lahir', 'Tempat Lahir Ayah', 'required');
		$this->form_validation->set_rules('ot_bpk_tanggal_lahir', 'Tanggal Lahir Ayah', 'required');
		$this->form_validation->set_rules('ot_bpk_agama', 'Agama Ayah', 'required');
		$this->form_validation->set_rules('ot_bpk_pekerjaan', 'Pekerjaan Ayah', 'required');
		$this->form_validation->set_rules('ot_bpk_pendidikan', 'Pendidikan Ayah', 'required');

		$this->form_validation->set_rules('ot_ib_nama_lengkap', 'Nama Lengkap Ibu', 'required');
		$this->form_validation->set_rules('ot_ib_tempat_lahir', 'Tempat Lahir Ibu', 'required');
		$this->form_validation->set_rules('ot_ib_tanggal_lahir', 'Tanggal Lahir Ibu', 'required');
		$this->form_validation->set_rules('ot_ib_agama', 'Agama Ibu', 'required');
		$this->form_validation->set_rules('ot_ib_pekerjaan', 'Pekerjaan Ibu', 'required');
		$this->form_validation->set_rules('ot_ib_pendidikan', 'Pendidikan Ibu', 'required');


		if($this->form_validation->run() == TRUE){

			$waktu_jurnal = date('Y-m-d H:i:s');
			$p['tahun_ajaran_id']  = $this->m_ta->get_detail('is_aktif','1')->row_array()['id'];
			$this->m_siswa->insert($p);

			$biaya_daftar = $this->db->select('SUM(ak_tahun_ajaran_komponen.nominal) AS nominal_biaya')
									 ->where('ak_tahun_ajaran_komponen.tipe', 'Pendaftaran')
								 	 ->where('tahun_ajaran_id', $p['tahun_ajaran_id'])
								 	 ->get('ak_tahun_ajaran_komponen')->row_array()['nominal_biaya'];

			$last_siswa   = $this->db->order_by('id', 'DESC')->limit(1)->get('ak_siswa')->row_array();
			$trans = [
				'siswa_id' 		 	=> $last_siswa['id'],
				'kode_transaksi' 	=> $this->transaksi_model->generate_code('komponen_pendidikan'),
				'tanggal_transaksi' => date('Y-m-d H:i:s'),
				'tipe'			 	=> 'komponen_pendidikan',
				'jenis'			 	=> 'masuk',
				'pembayaran'	 	=> 'Kredit',
				'level'			 	=> '3',
				'total_transaksi'	=> $biaya_daftar,
				'total_bayar'		=> '0',
				'sisa_bayar'		=> '0',
				'status'			=> 'Belum Lunas',
				'is_created'		=> '1',
				'metode'			=> 'Cash'
			];
			$this->transaksi_model->insert($trans);

			$last_trans = $this->db->where('tipe', 'komponen_pendidikan')
								   ->limit(1)->order_by('id', 'DESC')
								   ->get('transaksi')
								   ->row_array();
			
			$pendaftaran = $this->db->where('ak_tahun_ajaran_komponen.tipe', 'Pendaftaran')
								    ->where('tahun_ajaran_id', $p['tahun_ajaran_id'])
								    ->get('ak_tahun_ajaran_komponen')->result_array();

			$i = $nominal_pendaftaran = 0; $tgl_jurnal = date('Y-m-d H:i:s');
			foreach ($pendaftaran as $row){
				$kmp[$i]['transaksi_id']   = $last_trans['id'];
				$kmp[$i]['ta_komponen_id'] = $row['id'];
				$kmp[$i]['harga_komponen'] = $row['nominal'];

				$nominal_pendaftaran += $row['nominal'];
				$i++;
			}

			$this->db->insert_batch('transaksi_pendidikan', $kmp);

			$jurnal[0]['coa_id'] 	   = '6'; //Piutang
			$jurnal[0]['transaksi_id'] = $last_trans['id'];
			$jurnal[0]['waktu_jurnal'] = $waktu_jurnal;
			$jurnal[0]['posisi']	   = 'd';
			$jurnal[0]['nominal']      = $nominal_pendaftaran;

			$jurnal[1]['coa_id'] 	   = '7'; //Pendapatan Diterima Dimuka
			$jurnal[1]['transaksi_id'] = $last_trans['id'];
			$jurnal[1]['waktu_jurnal'] = $waktu_jurnal;
			$jurnal[1]['posisi']	   = 'k';
			$jurnal[1]['nominal']      = $nominal_pendaftaran;
			$this->db->insert_batch('jurnal', $jurnal);

			//////////////////////////////////////////////////////////////////////////

			$operasional = $this->db->where('ak_tahun_ajaran_komponen.tipe', 'Bulanan')
								    ->where('tahun_ajaran_id', $p['tahun_ajaran_id'])
								    ->get('ak_tahun_ajaran_komponen')->result_array();

			$biaya_ops = 0;
			foreach ($operasional as $row){
				$biaya_ops += $row['nominal'];
			}

			$trans = [
				'siswa_id' 		 	=> $last_siswa['id'],
				'kode_transaksi' 	=> $this->transaksi_model->generate_code('komponen_operasional'),
				'tanggal_transaksi' => date('Y-m-d H:i:s'),
				'tipe'			 	=> 'komponen_operasional',
				'jenis'			 	=> 'masuk',
				'pembayaran'	 	=> 'Kredit',
				'level'			 	=> '3',
				'total_transaksi'	=> $biaya_ops,
				'total_bayar'		=> '0',
				'sisa_bayar'		=> '0',
				'status'			=> 'Belum Lunas',
				'is_created'		=> '1',
				'metode'			=> 'Cash'
			];
			$this->transaksi_model->insert($trans);

			$last_trans = $this->db->where('tipe', 'komponen_operasional')
								   ->limit(1)->order_by('id', 'DESC')
								   ->get('transaksi')
								   ->row_array();

			$i = 0;
			foreach ($operasional as $row){
				$kmpo[$i]['transaksi_id']   = $last_trans['id'];
				$kmpo[$i]['ta_komponen_id'] = $row['id'];
				$kmpo[$i]['harga_komponen'] = $row['nominal'];
				$i++;

				$jurnals[0]['coa_id'] 	   = '6'; //Piutang
				$jurnals[0]['transaksi_id'] = $last_trans['id'];
				$jurnals[0]['waktu_jurnal'] = $waktu_jurnal;
				$jurnals[0]['posisi']	   = 'd';
				$jurnals[0]['nominal']      = $row['nominal'];

				$jurnals[1]['coa_id'] 	   = '8'; //Pendapatan SPP
				$jurnals[1]['transaksi_id'] = $last_trans['id'];
				$jurnals[1]['waktu_jurnal'] = $waktu_jurnal;
				$jurnals[1]['posisi']	   = 'k';
				$jurnals[1]['nominal']      = $row['nominal'];
				$this->db->insert_batch('jurnal', $jurnals);
			}

			$this->db->insert_batch('transaksi_pendidikan', $kmpo);
			
			if($this->db->trans_status()){
				$this->db->trans_commit();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dimasukkan','success'));
			}else{
				$this->db->trans_rollback();
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dimasukkan','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/akademik/pendaftaran/add');
	}

	public function update(){
		$p  = $this->input->post();
		$id = $p['id_siswa'];
		unset($p['id_siswa']);

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('kode_plg', 'Kode Siswa', 'required');
		$this->form_validation->set_rules('nama_plg', 'Nama Siswa', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('no_telp', 'No Handphone', 'required|numeric|max_length[13]');

		if($this->form_validation->run() == TRUE){

			if($this->m_siswa->update($p, $id)){
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil diubah','success'));
			}else{
				$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal diubah','danger'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
		}

		redirect('master_data/siswa');
	}

	public function delete($id){

		if($this->m_siswa->delete($id)){
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Data berhasil dihapus','success'));
		}else{
			$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-close"></i> Data gagal dihapus','danger'));
		}

		redirect('master_data/siswa');
	}

	public function undur_diri($siswa_id){
		$data = [
			'is_undur'	   => '1',
			'tgl_undur'	   => date('Y-m-d')
		];
		$this->m_siswa->update($data, $siswa_id);

		$get = $this->db->select('SUM(transaksi_pendidikan.harga_komponen) AS total_komponen')
		                ->join('ak_tahun_ajaran_komponen ta_komponen','ta_komponen.id = transaksi_pendidikan.ta_komponen_id')
		                ->join('ak_komponen_biaya komponen_biaya','komponen_biaya.id = ta_komponen.komponen_biaya_id')
		                ->join('transaksi', 'transaksi.id = transaksi_pendidikan.transaksi_id')
		                ->where('nama_komponen !=', 'Pendaftaran')
		                ->where('ta_komponen.tipe', 'Pendaftaran')
		                ->where('siswa_id', $siswa_id)
		                ->get('transaksi_pendidikan')->row_array();

		$trans = [
			'siswa_id' 		 	=> $siswa_id,
			'kode_transaksi' 	=> $this->transaksi_model->generate_code('undur_diri'),
			'tanggal_transaksi' => date('Y-m-d H:i:s'),
			'tipe'			 	=> 'undur_diri',
			'jenis'			 	=> 'keluar',
			'pembayaran'	 	=> 'Kredit',
			'level'			 	=> '3',
			'total_transaksi'	=> $get['total_komponen'],
			'total_bayar'		=> '0',
			'sisa_bayar'		=> $get['total_komponen'],
			'status'			=> 'Belum Lunas',
			'is_created'		=> '1',
			'metode'			=> 'Cash'
		];
		$this->transaksi_model->insert($trans);

		$this->session->set_flashdata('alert_message', show_alert('<i class="fa fa-check"></i> Berhasil melakukan pengunduran diri','success'));

		/**$waktu_jurnal = date('Y-m-d H:i:s');
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
		$this->db->insert_batch('jurnal', $jurnal);**/

		redirect('master_data/akademik/siswa/detail/'.$siswa_id);
	}
    
}