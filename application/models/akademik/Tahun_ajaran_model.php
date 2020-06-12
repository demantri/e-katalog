<?php
 
Class Tahun_ajaran_model extends CI_Model{

   protected $table = 'ak_tahun_ajaran';
    
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

   public function insert_komponen($data){
      $this->db->insert('ak_tahun_ajaran_komponen', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function update_komponen($data, $id){
      $this->db->where('id', $id)
               ->update('ak_tahun_ajaran_komponen', $data);
      return true;
   }

   public function delete_komponen($id){
      $this->db->where('id', $id)
               ->delete('ak_tahun_ajaran_komponen');

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

}
