<?php
 
Class Siswa_model extends CI_Model{

   protected $table = 'ak_siswa';
    
   public function get_data(){
      $this->db->select('*, ak_siswa.id AS ak_siswa_id')
               ->order_by($this->table.'.id', 'DESC')
               ->join('ak_tahun_ajaran', 'ak_tahun_ajaran.id = ak_siswa.tahun_ajaran_id');
      return $this->db->get($this->table)->result_array();
   }

   public function get_detail($key, $val = ''){
      $this->db->select('*, ak_siswa.id AS ak_siswa_id')
               ->order_by($this->table.'.id', 'DESC')
               ->join('ak_tahun_ajaran', 'ak_tahun_ajaran.id = ak_siswa.tahun_ajaran_id')
               ->join('ak_kelas', 'ak_kelas.id = ak_siswa.kelas_id', 'LEFT');
               
      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get($this->table);
   }

   public function generate_code(){
      $this->db->select('RIGHT(kode_plg,4) as kode', FALSE)
               ->order_by('kode_plg','DESC')
               ->limit(1);    
      
      $query = $this->db->get($this->table);  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "PLG-".$kodemax;
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

   public function get_tabungan($siswa_id){
      $this->db->where('siswa_id', $siswa_id)
               ->where('tipe', 'tabungan_siswa');
      return $this->db->get('transaksi')->result_array();
   }
}
