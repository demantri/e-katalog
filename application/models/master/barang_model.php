<?php
 
Class barang_model extends CI_Model{

   // protected $table = 'barang';
    
   public function get_data(){
        $query = $this->db->get('barang');
        return $query->result_array();
      }

   public function get_jenis(){
        $query = $this->db->get('jenisbarang');
        return $query->result_array();
      }

   public function get_merk(){
        $query = $this->db->get('merk');
        return $query->result_array();
      }
}
