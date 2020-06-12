<?php
 
Class Pembayaran_model extends CI_Model{

   protected $table = 'transaksi_';
    
   public function get_data(){
      return $this->db->get($this->table)->result_array();
   }

   public function get_detail($key, $val = ''){
      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get($this->table);
   }

   public function insert($data){
      $this->db->insert($this->table, $data);

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

   public function delete($id){
      $this->db->where('id', $id)
               ->delete($this->table);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function get_unpaid($siswa_id, $ta = '', $tipe = ''){
      $this->db->select('*, transaksi_pendidikan.id AS transaksi_pendidikan_id')
               ->join('ak_tahun_ajaran_komponen ta_komponen', 'ta_komponen.id = transaksi_pendidikan.ta_komponen_id')
               ->join('ak_komponen_biaya komponen_biaya', 'komponen_biaya.id = ta_komponen.komponen_biaya_id')
               ->join('transaksi', 'transaksi.id = transaksi_pendidikan.transaksi_id');

      if($ta != ''){
         $this->db->where('ta_komponen.tahun_ajaran_id', $ta);
      }

      if($tipe != ''){
         if($tipe == 'Pendaftaran'){
            $this->db->where('ta_komponen.tipe', 'Pendaftaran');
         }else{
            $this->db->where('ta_komponen.tipe !=', 'Pendaftaran');
         }
      }

      $this->db->where('transaksi.siswa_id', $siswa_id)
               ->where('transaksi.status', 'Belum Lunas');

      return $this->db->get('transaksi_pendidikan')->result_array();
   }

}
