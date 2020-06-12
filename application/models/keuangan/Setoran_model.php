<?php
 
Class Setoran_model extends CI_Model{

   protected $table = 'k_setoran';
    
   public function get_data(){
      $this->db->join('k_pemilik', 'k_pemilik.id = k_setoran.pemilik_id');
      return $this->db->get($this->table)->result_array();
   }

   public function get_detail($key, $val = ''){
      $this->db->join('k_pemilik', 'k_pemilik.id = k_setoran.pemilik_id');
      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get($this->table);
   }

   public function generate_code(){
      $this->db->select('RIGHT(kode_setoran,4) as kode', FALSE)
               ->order_by('kode_setoran','DESC')
               ->limit(1);    
      
      $query = $this->db->get($this->table);  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "STR-".$kodemax;
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

}
