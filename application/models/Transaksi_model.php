<?php
 
Class Transaksi_model extends CI_Model{

   protected $table = 'transaksi';
    
   public function get_data(){
      $this->db->select('*, transaksi.id AS transaksi_id');
      return $this->db->get($this->table)->result_array();
   }

   public function get_list_item($tipe, $id){
      $this->db->select('*, transaksi.id AS transaksi_id')
               ->where('transaksi.id', $id);

      if($tipe == 'perolehan'){
         $this->db->select('transaksi_aset.id AS transaksi_aset_id, a_aset.id AS aset_id')
                  ->join('transaksi_aset','transaksi_aset.transaksi_id = transaksi.id')
                  ->join('a_aset','a_aset.id = transaksi_aset.aset_id');

      }else if($tipe == 'setoran' || $tipe == 'penarikan'){
         $this->db->select('total_transaksi AS subtotal, 1 AS jumlah')
                  ->join('k_pemilik', 'k_pemilik.id = transaksi.pemilik_id');
      
      }else if($tipe == 'bop'){
         $this->db->join('transaksi_bop', 'transaksi_bop.transaksi_id = transaksi.id');
      
      }else if($tipe == 'undur_diri'){
         $this->db->join('ak_siswa', 'ak_siswa.id = transaksi.siswa_id');

         /**$this->db->join('transaksi_pendidikan', 'transaksi_pendidikan.transaksi_id = transaksi.id')
                  ->join('ak_tahun_ajaran_komponen ta_komponen','ta_komponen.id = transaksi_pendidikan.ta_komponen_id')
                  ->join('ak_komponen_biaya komponen_biaya','komponen_biaya.id = ta_komponen.komponen_biaya_id')
                  ->where('nama_komponen !=', 'Pendaftaran')
                  ->where('ta_komponen.tipe', 'Pendaftaran');**/

      }else if($tipe == 'pemeliharaan'){
          $this->db->select('transaksi_pemeliharaan.id AS pemeliharaan_id')
                  ->join('transaksi_pemeliharaan','transaksi_pemeliharaan.transaksi_id = transaksi.id')
                  ->join('a_aset_detail', 'a_aset_detail.id = transaksi_pemeliharaan.aset_detail_id')
                  ->join('a_aset', 'a_aset.id = a_aset_detail.aset_id');
      
      }else if($tipe == 'pinjaman'){
         $this->db->select('kode_karyawan, nama_karyawan, nama_jabatan')
                  ->join('hr_karyawan karyawan', 'karyawan.id = transaksi.karyawan_id')
                  ->join('hr_jabatan jabatan', 'jabatan.id = karyawan.jabatan_id');
      
      }else if($tipe == 'transaksi_beban'){
         $this->db->select('transaksi_beban.id AS transaksi_beban_id')
                  ->join('transaksi_beban', 'transaksi_beban.transaksi_id = transaksi.id')
                  ->join('k_beban', 'k_beban.id = transaksi_beban.beban_id');
      }

      $get_item = $this->db->get($this->table)->result_array();
      // print_r($get_item); die;

      $i = 0;
      $item = [];
      foreach ($get_item as $row){
         if($tipe == 'perolehan'){
            $item[$i]['id']       = $row['transaksi_aset_id'];
            $item[$i]['komponen'] = $row['kode_aset']." / ".$row['nama_aset']; 
            $item[$i]['qty']    = $row['jumlah'];
            $item[$i]['nilai_residu'] = $row['nilai_residu'];
            $item[$i]['harga']    = $row['harga'];
            $item[$i]['subtotal'] = $row['subtotal']; 

         }else if($tipe == 'penarikan'){
            $item[$i]['komponen'] = $row['nama_pemilik']; 
            $item[$i]['qty']    = '1';
            $item[$i]['subtotal'] = $row['subtotal']; 
         
         }else if($tipe == 'undur_diri'){
            $item[$i]['komponen'] = $row['nis']." / ".$row['nama_lengkap']; 
            $item[$i]['qty']    = '1';
            $item[$i]['subtotal'] = $row['total_transaksi']; 
         
         }else if($tipe == 'pemeliharaan'){
            $item[$i]['komponen'] = $row['kode_aset']." / ".$row['nama_aset']."<br><small>Keterangan : ".$row['keterangan_pemeliharaan']."</small>"; 
            $item[$i]['qty']      = '1';
            $item[$i]['subtotal'] = $row['harga_pemeliharaan']; 
         
         }else if($tipe == 'pinjaman'){
            $item[$i]['komponen'] = $row['kode_karyawan']." / ".$row['nama_karyawan']."<br><small>Jabatan : ".$row['nama_jabatan']."</small>"; 
            $item[$i]['qty']      = '1';
            $item[$i]['subtotal'] = $row['total_transaksi']; 

         }else if($tipe == 'transaksi_beban'){
            $item[$i]['id']       = $row['transaksi_beban_id'];
            $item[$i]['komponen'] = $row['kode_beban']." / ".$row['nama_beban'];
            $item[$i]['qty']      = $row['qty'];
            $item[$i]['harga']    = $row['harga'];
            $item[$i]['subtotal'] = $row['subtotal'];
            $item[$i]['keterangan'] = $row['keterangan'];

         }else if($tipe == 'bop'){
            $item[$i]['id']                  = $row['transaksi_id'];
            $item[$i]['nama_komponen']       = $row['nama_komponen'];
            $item[$i]['metode_pengeluaran']  = $row['metode_pengeluaran'];
            $item[$i]['subtotal']            = $row['subtotal']; 
         }
         
         $i++;
      }

      return $item;
   }

   public function get_total_list_item($tipe, $id){
      $this->db->select('*, transaksi.id AS transaksi_id')
               ->where('transaksi.id', $id);

      if($tipe == 'perolehan'){
         $this->db->select('transaksi_aset.id AS transaksi_aset_id, a_aset.id AS aset_id')
                  ->join('transaksi_aset','transaksi_aset.transaksi_id = transaksi.id')
                  ->join('a_aset','a_aset.id = transaksi_aset.aset_id');

      }else if($tipe == 'setoran' || $tipe == 'penarikan'){
         $this->db->select('total_transaksi AS subtotal, 1 AS jumlah')
                  ->join('k_pemilik', 'k_pemilik.id = transaksi.pemilik_id');
      
      }else if($tipe == 'bop'){
         $this->db->select('SUM(transaksi_bop.subtotal) AS total')
                  ->join('transaksi_bop', 'transaksi_bop.transaksi_id = transaksi.id');
      
      }

      $nominal = $this->db->get($this->table)->row_array()['total'];

      if($nominal == ''){
         return 0;
      }

      return $nominal;
   }

   public function get_list_pembayaran($id){
      $this->db->where('transaksi_id', $id)
               ->join('transaksi', 'transaksi.id = transaksi_pembayaran.transaksi_id');
      return $this->db->get('transaksi_pembayaran')->result_array();
   }

   public function get_item_by($tipe, $transaksi_id, $component_id){
      $this->db->select('*, transaksi.id AS transaksi_id')
               ->where('transaksi.id', $transaksi_id);

      if($tipe == 'perolehan'){
         $this->db->select('transaksi_aset.id AS transaksi_aset_id')
                  ->join('transaksi_aset', 'transaksi_aset.transaksi_id = transaksi.id')
                  ->where('transaksi_aset.aset_id', $component_id);

      }else if($tipe == 'transaksi_beban'){
         $this->db->select('transaksi_beban.id AS transaksi_beban_id')
                  ->join('transaksi_beban', 'transaksi_beban.transaksi_id = transaksi.id')
                  ->where('transaksi_beban.id', $component_id);
      }

      return $this->db->get($this->table);
   }

   public function get_detail($key, $val = ''){

      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      $this->db->order_by($this->table.".id", 'DESC');

      return $this->db->get($this->table);
   }

   public function last_data($tipe){
      $this->db->order_by('id','DESC')
               ->limit(1)
               ->where('tipe',$tipe);

      return $this->db->get($this->table)->row_array();
   }

   public function generate_code($tipe, $opt = ''){
      $this->db->select('RIGHT(kode_transaksi,4) as kode', FALSE)
               ->order_by('kode_transaksi','DESC')
               ->where('tipe', $tipe)
               ->where('DATE(tanggal_transaksi)', date('Y-m-d'))
               ->limit(1);
      
      $query = $this->db->get('transaksi');  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      if($tipe == 'perolehan'){
         $prefix = "PRL";
      }else if($tipe == 'setoran'){
         $prefix = "STR";

      }else if($tipe == 'penarikan'){
         $prefix = 'PNRK';
      
      }else if($tipe == 'bop'){
         $prefix = 'BOP';
      
      }else if($tipe == 'bank'){
         $prefix = $opt.'BNK';

      }else if($tipe == 'tabungan_siswa'){
         $prefix = 'TBG';
      
      }else if($tipe == 'komponen_pendidikan'){
         $prefix = 'KMPP';
      
      }else if($tipe == 'komponen_operasional'){
         $prefix = 'KMPO';
      }else if($tipe == 'undur_diri'){
         $prefix = 'UDR';
      
      }else if($tipe == 'pemeliharaan'){
         $prefix = 'PML';

      }else if($tipe == 'perbaikan'){
         $prefix = 'PRB';

      }else if($tipe == 'pinjaman'){
         $prefix = 'PNJM';

      }else if($tipe == 'panjar'){
         $prefix = 'PNJR';

      }else if($tipe == 'transaksi_beban'){
         $prefix = 'BBN';
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "TRX-".$prefix."-".date('dmY')."-".$kodemax;
      return $code;
   }

   public function insert_bop_keluar($data){
      $this->db->insert('transaksi_bop', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert($data){
      $this->db->insert($this->table, $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_pembayaran($data){
      $this->db->insert('transaksi_pembayaran', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function get_last_pembayaran($transaksi_id){
      $this->db->limit(1)
               ->where('transaksi_id', $transaksi_id);
      return $this->db->get('transaksi_pembayaran')->row_array();
   }

   public function insert_item($tipe, $data){

      if($tipe == 'perolehan'){
         $tbl = 'transaksi_aset';
      }else if($tipe == 'transaksi_beban'){
         $tbl = $tipe;
      }

      $this->db->insert($tbl, $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function update($data, $id){
      $this->db->where('id', $id)
               ->update($this->table, $data);
      return true;
   }

   public function update_item($tipe, $data, $id){
      $this->db->where('id', $id);

      if($tipe == 'perolehan'){
         $this->db->update('transaksi_aset', $data);
      }else if($tipe == 'transaksi_beban'){
         $this->db->update('transaksi_beban', $data);
      }

      return true;
   }

   public function delete_item($tipe, $id){
      $this->db->where('id', $id);

      if($tipe == 'perolehan'){
         $this->db->delete('transaksi_aset');
      }else if($tipe == 'pemeliharaan'){
         $this->db->delete('transaksi_pemeliharaan');

      }else if($tipe == 'transaksi_beban'){
         $this->db->delete('transaksi_beban');
      }

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function get_total_price($tipe ,$transaksi_id){
      $this->db->where('transaksi.id', $transaksi_id);

      if($tipe == 'perolehan'){
         $this->db->select('SUM(transaksi_aset.subtotal) AS total')
                  ->join('transaksi_aset', 'transaksi_aset.transaksi_id = transaksi.id');
      
      }else if($tipe == 'pemeliharaan'){
         $this->db->select('SUM(transaksi_pemeliharaan.harga_pemeliharaan) AS total')
                  ->join('transaksi_pemeliharaan', 'transaksi_pemeliharaan.transaksi_id = transaksi.id');
      
      }else if($tipe == 'transaksi_beban'){
         $this->db->select('SUM(transaksi_beban.qty * transaksi_beban.harga) AS total')
                  ->join('transaksi_beban', 'transaksi_beban.transaksi_id = transaksi.id');
      }

      return $this->db->get('transaksi')->row_array()['total'];
   }

   public function get_nominal_pinjaman($karyawan_id){
      $this->db->select('SUM(sisa_bayar) AS nominal')
               ->where('tipe', 'pinjaman')
               ->where('level', '3')
               ->where('status', 'Belum Lunas')
               ->where('karyawan_id', $karyawan_id);

      return $this->db->get('transaksi')->row_array()['nominal'];
   }

}
