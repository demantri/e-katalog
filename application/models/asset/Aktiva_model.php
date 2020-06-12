<?php
 
Class Aktiva_model extends CI_Model{

   protected $table = 'a_aset';
    
   public function get_data(){
      $this->db->select('*, a_aset.id AS id_aset, a_kategori.id AS id_kategori')
               ->join('a_kategori', 'a_kategori.id = a_aset.kategori_id');
      return $this->db->get($this->table)->result_array();
   }

   public function get_unconfirm($trans_id){
      $this->db->select('*, a_aset_detail.id AS aset_detail_id')
               ->join('transaksi_aset', 'transaksi_aset.transaksi_id = transaksi.id')
               ->join('a_aset_detail', 'a_aset_detail.transaksi_aset_id = transaksi_aset.id')
               ->join('a_aset', 'a_aset.id = a_aset_detail.aset_id')
               ->where([
                  'transaksi_id'  => $trans_id,
                  'level'         => '3',
                  'is_konfirmasi' => '0'
               ]);
      return $this->db->get('transaksi')->result_array();
   }

   public function get_detail($key, $val = ''){
      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get($this->table);
   }

   public function generate_code(){
      $this->db->select('RIGHT(kode_aset,4) as kode', FALSE)
               ->order_by('kode_aset','DESC')
               ->limit(1);    
      
      $query = $this->db->get('a_aset');  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "AT-".$kodemax;
      return $code;
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

   public function get_list_detail($aset_id){
      $this->db->where('a_aset_detail.aset_id', $aset_id)
               ->join('transaksi_aset', 'transaksi_aset.id = a_aset_detail.transaksi_aset_id')
               ->join('transaksi', 'transaksi.id = transaksi_aset.transaksi_id')
               ->join('a_lokasi', 'a_lokasi.id = a_aset_detail.lokasi_id', 'LEFT')
               ->order_by('a_aset_detail.id', 'ASC');
      return $this->db->get('a_aset_detail')->result_array();
   }

   public function get_unlocated($aset_id = ''){
      $this->db->select('*, a_aset_detail.id AS aset_detail_id');

      if($aset_id != ''){
         $this->db->where('a_aset_detail.aset_id', $aset_id);
      }

      $this->db->join('a_aset', 'a_aset.id = a_aset_detail.aset_id')
               ->join('transaksi_aset', 'a_aset_detail.transaksi_aset_id = transaksi_aset.id')
               ->join('transaksi', 'transaksi_aset.transaksi_id = transaksi.id')
               ->where('is_active', '1')
               ->where('is_konfirmasi', '1')
               ->where('is_retur', '0')
               ->where('lokasi_id', null);
      return $this->db->get('a_aset_detail')->result_array();
   }

   public function insert_location($aset_id, $location_id){
      $this->db->where_in('id',$aset_id)
               ->update('a_aset_detail', [
                                 'lokasi_id' => $location_id
                              ]);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_retur($aset_id){
      $this->db->where_in('id',$aset_id)
               ->update('a_aset_detail', [
                                 'is_retur' => '1'
                              ]);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_itemPemeliharaan($data){
      $this->db->insert('transaksi_pemeliharaan', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }
}
