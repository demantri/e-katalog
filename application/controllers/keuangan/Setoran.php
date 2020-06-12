<?php 

class Setoran extends CI_Controller{

	function __construct(){
		parent::__construct();	
		$this->load->model('keuangan/pemilik_model', 'm_pemilik');
		$this->load->model('keuangan/Rek_model', 'm_rek');
		$this->load->model('transaksi_model', 'm_transaksi');

		if(!$this->session->userdata('login')){
			redirect('');
		}
	}

	public function dana($tipe){
		if(in_array($tipe, ['in','out'])){

			if($tipe == 'in'){
				$trans = 'setoran';
			}else{
				$trans = 'penarikan';
			}

			$data['tipe']      = $tipe;
			$data['pemilik']   = $this->m_pemilik->get_data();
			$data['rek']	   = $this->m_rek->get_data();
			$data['list']      = $this->db->where('tipe', $trans)
										  ->join('k_rek', 'k_rek.id = transaksi.rek_id')
										  ->get('transaksi')->result_array();
			$data['last_code'] = $this->m_transaksi->generate_code($trans);
			$this->template->load('layout/template','master_data/keuangan/setoran/index', $data);

		}else{
			show_404();
		}
		
	}

	public function add($tipe){
		if(in_array($tipe, ['in', 'out'])){
			$p = $this->input->post();

			if($tipe == 'in'){
				$trans = 'setoran';
			}else{
				$trans = 'penarikan';
			}

			$p['total_transaksi'] = format_angka($p['total_transaksi']);
			$p['total_bayar']	  = $p['total_transaksi'];
			$p['tanggal_transaksi'] = date('Y-m-d H:i:s');
			$p['is_created']		= '1';
			$p['tipe']				= $trans;
			$p['pembayaran']		= 'Tunai';
			

			if($tipe == 'in'){
				$p['jenis']	= 'masuk';
				$p['level'] = '2';

			}else{
				$p['jenis']	= 'keluar';
				$p['level'] = '1';
			}

			$pemilik = $this->m_pemilik->get_detail('id', $p['pemilik_id'])->row_array();
			$p['nama_pemilik'] = $pemilik['nama_pemilik'];

			$this->form_validation->set_data($p);
			$this->form_validation->set_rules('total_transaksi', 'Nominal', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('pemilik_id', 'Pemilik', 'required|numeric');
			$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
			$this->form_validation->set_rules('kd_giro', 'No Giro', 'required');

			if($this->form_validation->run() == TRUE){

				$this->db->trans_begin();
				$this->m_transaksi->insert($p);

				if($tipe == 'in'){
					$find = 'setoran';
				}else{
					$find = 'penarikan';
				}

				$trans = $this->m_transaksi->last_data($find);
				$this->m_transaksi->insert_pembayaran([
											'transaksi_id'  => $trans['id'],
											'jumlah_bayar'  => $trans['total_bayar'],
											'tanggal_bayar' => $trans['tanggal_transaksi']
										]);
				$last = $this->m_transaksi->get_last_pembayaran($trans['id']);
				$rek = [
					'rek_id' 				  => $p['rek_id'],
					'transaksi_pembayaran_id' => $last['id']
				];
				$this->m_rek->insert_history($rek);

				$detail_rek = $this->m_rek->get_detail('id', $rek_id)->row_array();
				
				if($tipe == 'in'){
					$detail_rek['saldo'] += $trans['total_bayar'];
				}else{
					$detail_rek['saldo'] -= $trans['total_bayar'];
				}

				$this->m_rek->update(['saldo' => $detail_rek['saldo']], $rek_id);

				if($this->db->trans_status()){
					$this->db->trans_commit();
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
				}else{
					$this->db->trans_rollback();
					$this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan'));
				}

			}else{
				$this->session->set_flashdata('alert_message', show_alert('<b class="text-warning"><i class="fas fa-info-circle"></i></b> Form tidak valid<br>'.validation_errors(),'warning'));
			}

			redirect('transaksi/keuangan/setoran/'.$tipe);

		}else{
			show_404();
		}

	}
}