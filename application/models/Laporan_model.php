<?php
 
Class Laporan_model extends CI_Model{

   public function get_jurnal($key, $val = ''){
      $this->db->select('*, transaksi.id AS transaksi_id')
               // ->from('jurnal')
               ->join('k_coa', 'k_coa.id = jurnal.coa_id')
               ->join('transaksi', 'transaksi.id = jurnal.transaksi_id')
               ->join('transaksi_beban', 'transaksi_beban.transaksi_id = jurnal.transaksi_id')
               ->join('k_beban', 'k_beban.id = transaksi_beban.beban_id')
               ->group_by('jurnal.id', 'ASC');

      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get('jurnal');
   }

   public function get_kartu_piutang($tipe, $req = array()){
      $this->load->model('transaksi_model');

      $this->db->select('*, transaksi.id AS transaksi_id');
      if(isset($req['com_id'])){
         $this->db->where($tipe.'.id', $req['com_id']);
      }

      if(isset($req['bulan'])){
         if($req['bulan'] != 'all'){
            $this->db->where('MONTH(tanggal_transaksi)', $req['bulan']);
         }
      }

      if(isset($req['tahun'])){
         if($req['tahun'] != 'all'){
            $this->db->where('YEAR(tanggal_transaksi)', $req['tahun']);
         }
      }

      if($tipe == 'karyawan'){
         $this->db->join('hr_karyawan karyawan', 'karyawan.id = transaksi.karyawan_id')
                  ->where('tipe', 'pinjaman')
                  ->order_by('karyawan.nama_karyawan', 'ASC');
         $com  = 'nama_karyawan';
         $code = 'kode_karyawan';
      }else{
         $this->db->join('ak_siswa siswa', 'siswa.id = transaksi.siswa_id')
                  ->where('tipe', 'pinjaman')
                  ->order_by('ak_siswa.nama_lengkap', 'ASC');
         $com  = 'nama_lengkap';
         $code = 'nis';
      }
      $this->db->order_by('tanggal_transaksi', 'DESC');

      $get = $this->db->get('transaksi')->result_array();
      $item = [];
      foreach ($get as $row) {
         $item[] = [
            'transaksi' => $row['kode_transaksi'],
            'kode' => $row[$code],
            'nama' => $row[$com],
            'tanggal_transaksi' => date('Y-m-d', strtotime($row['tanggal_transaksi'])),
            'posisi' => 'debit',
            'nominal'  => $row['total_transaksi'],
            'ket' => 'Peminjaman'
         ];

         $cek = $this->transaksi_model->get_list_pembayaran($row['transaksi_id']);
         $i = 0;
         foreach ($cek as $rows) { $i++;
            if($i > 1){
               $item[] = [
                  'transaksi' => $row['kode_transaksi'],
                  'kode' => $row[$code],
                  'nama' => $row[$com],
                  'tanggal_transaksi' => date('Y-m-d', strtotime($rows['tanggal_bayar'])),
                  'posisi' => 'kredit',
                  'nominal'  => $rows['jumlah_bayar'],
                  'ket' => 'Pelunasan'
               ];
            }
         }
      }

      return $item;
   }



}
