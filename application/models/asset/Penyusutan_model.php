<?php
 
Class Penyusutan_model extends CI_Model{

   protected $table = 'a_aset';
    
   public function get_data(){
      $this->db->select('*, a_aset.id AS id_aset, a_kategori.id AS id_kategori')
               ->join('a_kategori', 'a_kategori.id = a_aset.kategori_id');
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

   public function get_dataPenyusutan($req = []){
      if(array_key_exists('start_date', $req)){
         $this->db->where('tanggal >=',$req['start_date']);     
      }

      if(array_key_exists('end_date', $req)){
         $this->db->where('tanggal <=',$req['end_date']);
      }

      if(array_key_exists('bulan', $req)){
         $this->db->where('MONTH(tanggal) <=',$req['bulan']);      
      }

      if(array_key_exists('tahun', $req)){
         $this->db->where('YEAR(tanggal) <=',$req['tahun']);
      }

      if(array_key_exists('id_aset', $req)){
         $this->db->where('detail_aset.aset_id',$req['id_aset']);
      }

      if(array_key_exists('id_detail_aset', $req)){
         $this->db->where('detail_aset.id',$req['id_detail_aset']);
      }

      $this->db->join('a_aset aset','aset.id = detail_aset.aset_id')
               ->join('a_kategori kategori','kategori.id = aset.kategori_id')
               ->join('transaksi_aset', 'transaksi_aset.id = detail_aset.transaksi_aset_id')
               ->join('transaksi', 'transaksi.id = transaksi_aset.transaksi_id');

      return $this->db->get('a_aset_detail detail_aset')->result_array();
   }

   public function get_dataPenyusutan_by_kategori($id){

      $this->db->where('kategori.id', $id)
             ->join('aset','aset.id = detail_aset.aset_id')
             ->join('kategori','kategori.id = aset.id_kategori');

      return $this->db->get('detail_aset')->result_array();
   }

   public function calculatePenyusutan($harga_asset, $residu, $masa_pakai, $tgl_perolehan, $jumlah){
       $num = 0;

       $tgl = substr($tgl_perolehan, 8, 2);
       $bln = substr($tgl_perolehan, 5, 2);
       $num = $bln;

       if($tgl >= '15'){
         $num = $num + 1;

         if($bln == '12'){
           $num = 1;
         }
       }

       $num = 13 - $num;

       $harga_penyusutan = ($num / 12) * ($harga_asset - $residu) / $masa_pakai;
       $total_penyusutan = ($harga_asset - $harga_penyusutan) * $jumlah;
       return $total_penyusutan; 
  }
}
