<?php
class Gaji_model extends CI_model{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('transaksi_model');
	}
	
	public function get_list($bulan = '', $tahun = '', $karyawan_id = ''){

		$this->db->select('gaji.*, gaji_detail.*, gaji.id AS gaji_id,
					   COUNT(karyawan_id) AS total_karyawan,
					   SUM(total_gaji) AS total_gaji')
			 ->order_by('gaji.id','DESC')
			 ->group_by('gaji.id')
			 ->join('hr_gaji_detail gaji_detail','gaji_detail.gaji_id = gaji.id');

		if($bulan != ''){
			$this->db->where('bulan', $bulan);
		}

		if($tahun != ''){
			$this->db->where('tahun', $tahun);
		}

		if($karyawan_id != ''){
			$this->db->where('karyawan_id', $karyawan_id);
		}


		$get = $this->db->get('hr_gaji gaji')->row_array();

		$data['id_gaji'] 		= $get['gaji_id'];
		$data['bulan'] 	 		= $bulan;
		$data['tahun'] 			= $tahun;
		$data['total_gaji'] 	= $get['total_gaji'];
		$data['total_karyawan'] = $get['total_karyawan'];

		return $data;
	}

	public function calculateGaji($bulan, $tahun){

		$get_waktu = $this->db->where('is_aktif','1')
				 			  ->get('hr_waktu')->result_array();
		$work_day = [];

		foreach ($get_waktu as $row) {
			$work_day[] = $row['hari'];
		}

		$req = array(
				'bulan' => $bulan,
				'tahun' => $tahun
			);
		$absensi  = $this->m_absensi->get_list($req, 'gaji')->result_array();

		$bulan    = $bulan;
		$tahun    = $tahun;
		$i = 0;
		$total_gaji = $total_pajak = 0;
		$data = [];

		$thr  = $this->db->where(['tipe' => 'tahunan', 'bulan' => $bulan, 'tahun' => $tahun])
						 ->get('hr_tunjangan');
		$lain = $this->db->where('tipe', 'harian')
						 ->or_where('tipe', 'bulanan')
						 ->get('hr_tunjangan')->result_array();


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

			$data[$i]['karyawan_id'] 		= $row['id'];
			$data[$i]['kode_karyawan']		= $row['kode_karyawan'];
			$data[$i]['nama_karyawan']		= $row['nama_karyawan'];
			$data[$i]['total_masuk'] 		= $row['total_masuk'];
			$data[$i]['total_hadir'] 		= $kehadiran;
			$data[$i]['total_terlambat'] 	= $row['total_terlambat'];
			$data[$i]['maksimal_kehadiran'] = $num_days;
			$data[$i]['gaji_pokok'] 		 = $nominal_pokok;
			$data[$i]['gaji_kehadiran']		 = $n_hadir;
			$data[$i]['gaji_keterlambatan']  = $n_telat;		
			$data[$i]['tunjangan_lembur'] 	 = $nominal_lembur;
			$data[$i]['tunjangan_lain']		 = $nominal_tunjangan;
			$data[$i]['tunjangan_komponen']  = $tunjangan;
			$data[$i]['hutang']				 = $nominal_hutang;
			$data[$i]['total_gaji']			 = $nominal_pokok + $nominal_lembur + $nominal_tunjangan - $nominal_hutang;
			
			$total_gaji += $data[$i]['total_gaji'];

			$i++;
		}

		return array(
				'pph' => $total_pajak,
				'total_gaji' => $total_gaji,
				'total_karyawan' => $i,
				'list' => $data
			);
	}

	public function insert_lembur($data){
		$this->db->insert('hr_lembur',$data);

		if($this->db->affected_rows() > 0){
			return true;
		}
		return false;
	}

	public function get_lembur_list(){
		$this->db->join('hr_karyawan karyawan', 'karyawan.id = lembur.karyawan_id');
		return $this->db->get('hr_lembur lembur');
	}

	public function get_list_detail($id_gaji, $karyawan_id = ''){

		$this->db->where('gaji_id',$id_gaji)
				 ->join('hr_karyawan karyawan','karyawan.id = hr_gaji_detail.karyawan_id');

		if($karyawan_id != ''){
			$this->db->where('karyawan_id',$karyawan_id);
		}

		return $this->db->get('hr_gaji_detail');
	}

	public function get_detail($id_gaji, $karyawan_id = ''){
		$this->db->where('gaji.id',$id_gaji);
		$this->db->select('gaji.*, gaji_detail.*, gaji.id AS gaji_id,
						   COUNT(karyawan_id) AS total_karyawan,
						   SUM(total_gaji) AS total_gaji')
				 ->order_by('gaji.id','DESC')
				 ->join('hr_gaji_detail gaji_detail','gaji_detail.gaji_id = gaji.id');	
				 
		if($karyawan_id != ''){
			$this->db->where('karyawan_id',$karyawan_id);
		}

		return $this->db->get('hr_gaji gaji');
	}

	public function get_condition($condition){
		$this->db->where($condition);
		return $this->db->get('gaji');
	}

	public function insert($data){
		$this->db->insert('hr_gaji',$data);

		if($this->db->affected_rows() > 0){
			return true;
		}
		return false;
	}

	public function delete($id_gaji){
		$this->db->where('id',$id_gaji)
				 ->delete('hr_gaji');

		if($this->db->affected_rows() > 0){
			return true;
		}
		return false;
	}

	public function update($data, $id_gaji){
		$this->db->where('id',$id_gaji)
				 ->update('hr_gaji', $data);

		return true;
	}

	public function get_list_karyawan($id){
		return $this->db->select('gaji.*, gaji_detail.*, gaji.id AS gaji_id')
						->where('karyawan_id',$id)
						->join('hr_gaji_detail gaji_detail','gaji_detail.id_gaji = gaji.id')
						->group_by('karyawan_id')
				 		->get('hr_gaji gaji');
	}
	
}
