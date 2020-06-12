<?php
 
Class Perolehan_model extends CI_Model{

   protected $table = 'transaksi';
    
   public function get_data(){
      $this->db->select('*, perolehan.id AS perolehan_id, pelanggan.id AS pelanggan_id')
               ->join('pelanggan', 'pelanggan.id = perolehan.pelanggan_id');
      return $this->db->get($this->table)->result_array();
   }

   public function get_list_item($id){
      $this->db->select('*, perolehan.id AS perolehan_id, perolehan_detail.id AS perolehan_detail_id')
               ->join('perolehan_detail', 'perolehan_detail.perolehan_id = perolehan.id')
               ->join('produk', 'produk.id = perolehan_detail.produk_id')
               ->where('perolehan.id', $id);
      return $this->db->get($this->table)->result_array();
   }

   public function get_list_pembayaran($id){
      $this->db->where('perolehan_id', $id);
      return $this->db->get('perolehan_pembayaran')->result_array();
   }

   public function get_item_by_produk($perolehan_id, $produk_id){
      $this->db->select('*, perolehan.id AS perolehan_id, perolehan_detail.id AS perolehan_detail_id')
               ->join('perolehan_detail', 'perolehan_detail.perolehan_id = perolehan.id')
               ->join('produk', 'produk.id = perolehan_detail.produk_id')
               ->where('produk.id', $produk_id)
               ->where('perolehan.id', $perolehan_id);
      return $this->db->get($this->table);
   }

   public function get_detail($key, $val = ''){

      $this->db->select('*, perolehan.id AS perolehan_id')
               ->join('pelanggan', 'pelanggan.id = perolehan.pelanggan_id');

      if(is_array($key)){
         $this->db->where($key);
      
      }else{
         $this->db->where($key, $val);
      }

      return $this->db->get($this->table);
   }

   public function last_data(){
      $this->db->order_by('id','DESC')
               ->limit(1);
      return $this->db->get($this->table)->row_array();
   }

   public function generate_code(){
      $num  = $this->db->from($this->table)->count_all_results() + 1;
      $code = "PNJ-".$num;
      return $code;
   }

   public function insert($data){
      $this->db->insert($this->table, $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_pembayaran($data){
      $this->db->insert('perolehan_pembayaran', $data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function insert_item($data){
      $this->db->insert('perolehan_detail', $data);

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

   public function update_item($data, $id){
      $this->db->where('id', $id)
               ->update('perolehan_detail', $data);
      return true;
   }

   public function delete_item($id){
      $this->db->where('id', $id)
               ->delete('perolehan_detail');

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function get_total_price($perolehan_id){
      $this->db->select('SUM(perolehan_detail.qty * produk.harga_pr) AS total')
               ->join('perolehan_detail', 'perolehan_detail.perolehan_id = perolehan.id')
               ->join('produk', 'produk.id = perolehan_detail.produk_id')
               ->where('perolehan.id', $perolehan_id);
      return $this->db->get('perolehan')->row_array()['total'];
   }

}
