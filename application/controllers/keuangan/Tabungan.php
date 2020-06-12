<?php 

class Tabungan extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('akademik/siswa_model', 'm_siswa');
		$this->load->model('akademik/tahun_ajaran_model', 'm_ta');
		$this->load->model('keuangan/rek_model', 'm_rek');
		$this->load->model('transaksi_model', 'm_transaksi');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function index(){
		$tahun_ajaran_id = $this->m_ta->get_detail('is_aktif', '1')->row_array()['id'];
		$data['siswa'] = $this->m_siswa->get_detail(['level' => '1', 'tahun_ajaran_id' => $tahun_ajaran_id])->result_array();

		if($this->input->get('id')){
			$siswa_id = $this->input->get('id');
			$cek 	  = $this->m_siswa->get_detail('ak_siswa.id', $siswa_id);

			if($cek->num_rows() > 0){
				$data['last_code']    = $this->m_transaksi->generate_code('tabungan_siswa');
				$data['siswa_detail'] = $cek->row_array();
				$data['list']  = $this->m_siswa->get_tabungan($siswa_id);

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> ID Siswa tidak ditemukan', 'danger'));
				redirect('transaksi/keuangan/tabungan_siswa');
			}
		}

		$this->template->load('layout/template','transaksi/keuangan/tabungan/index', $data);
		
	}

	public function add($siswa_id){

		$p = $this->input->post();

		$p['siswa_id']			= $siswa_id;
		$p['total_transaksi'] 	= format_angka($p['total_transaksi']);
		$p['total_bayar']	    = $p['total_transaksi'];
		$p['tanggal_transaksi'] = date('Y-m-d H:i:s');
		$p['is_created']		= '1';
		$p['tipe']				= 'tabungan_siswa';
		$p['pembayaran']		= 'Tunai';
		$p['metode']			= 'Cash';
		$p['status']			= 'Lunas';
		$p['level']				= '3';

		$this->form_validation->set_data($p);
		$this->form_validation->set_rules('total_transaksi', 'Nominal', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		if($this->form_validation->run() == TRUE){

			$cek = $this->db->where('DATE(tanggal_transaksi)', date('Y-m-d', strtotime($p['tanggal_transaksi'])))
							->where('siswa_id', $siswa_id)
							->where('tipe','tabungan_siswa')
					 		->get('transaksi');

			if($cek->num_rows() == 0){

				$this->db->trans_begin();
				$this->m_transaksi->insert($p);

				$trans = $this->m_transaksi->last_data('tabungan_siswa');
				$this->m_transaksi->insert_pembayaran([
											'transaksi_id'  => $trans['id'],
											'jumlah_bayar'  => $trans['total_bayar'],
											'tanggal_bayar' => $trans['tanggal_transaksi']
										]);

				if($this->db->trans_status()){
					$this->db->trans_commit();
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
				}else{
					$this->db->trans_rollback();
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan', 'danger'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data sudah ada', 'warning'));
			}

		}else{
			$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fas fa-info-circle"></i></b> Form tidak valid<br>'.validation_errors(),'warning'));
		}

		redirect('transaksi/keuangan/tabungan_siswa?id='.$siswa_id);

	}
}