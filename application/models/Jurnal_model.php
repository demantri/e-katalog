<?php
 
Class Jurnal_model extends CI_Model{

   protected $table = 'jurnal';

   public function insert_single($data){
      $this->db->insert($this->table, $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_multiple($data){
      $this->db->insert_batch($this->table, $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

}
