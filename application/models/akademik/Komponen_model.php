<?php
 
Class Komponen_model extends CI_Model{

   protected $table = 'ak_komponen_biaya';
    
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

   public function generate_code(){
      $this->db->select('RIGHT(kode_komponen,4) as kode', FALSE)
               ->order_by('kode_komponen','DESC')
               ->limit(1);    
      
      $query = $this->db->get($this->table);  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "KMP-".$kodemax;
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

   public function get_komponen_ta($id){
      $this->db->select('*, ak_tahun_ajaran_komponen.id AS ta_komponen_id')
               ->join('ak_komponen_biaya','ak_komponen_biaya.id = ak_tahun_ajaran_komponen.komponen_biaya_id')
               ->where('ak_tahun_ajaran_komponen.tahun_ajaran_id',$id);

      return $this->db->get('ak_tahun_ajaran_komponen')->result_array();
   }
}
