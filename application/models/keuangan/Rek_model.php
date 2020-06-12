<?php
 
Class Rek_model extends CI_Model{

   protected $table = 'k_rek';
    
   public function get_data(){
      $this->db->order_by($this->table.".id",'DESC');
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

   public function generate_code(){
      $this->db->select('RIGHT(kode_rek,4) as kode', FALSE)
               ->order_by('kode_rek','DESC')
               ->limit(1);    
      
      $query = $this->db->get($this->table);  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "REK-".$kodemax;
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

   public function insert_history($data){
      $this->db->insert('k_rek_history', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function get_rek_history($key, $val = ''){

      $this->db->select('*, k_rek.id AS rek_id, k_rek_history.id AS rek_history_id');

      if(!is_array($key)){
         $this->db->where($key, $val);
      
      }else{
         $this->db->where($key);
      }

      $this->db->join('k_rek_history', 'k_rek_history.rek_id = k_rek.id')
               ->join('transaksi_pembayaran', 'transaksi_pembayaran.id = k_rek_history.transaksi_pembayaran_id')
               ->join('transaksi', 'transaksi.id = transaksi_pembayaran.transaksi_id')
               ->order_by('transaksi_pembayaran.id', 'DESC');

      return $this->db->get('k_rek')->result_array();
   }

   public function get_balance($key, $val = ''){

      $this->db->select('SUM(transaksi_pembayaran.jumlah_bayar) AS total_bayar');

      if(!is_array($key)){
         $this->db->where($key, $val);
      
      }else{
         $this->db->where($key);
      }

      $this->db->join('k_rek_history', 'k_rek_history.rek_id = k_rek.id')
               ->join('transaksi_pembayaran', 'transaksi_pembayaran.id = k_rek_history.transaksi_pembayaran_id')
               ->join('transaksi', 'transaksi.id = transaksi_pembayaran.transaksi_id');

      return $this->db->get('k_rek')->row_array()['total_bayar'];
   }
}
