<?php
 
Class Pelunasan_model extends CI_Model{
    
   public function get_data(){
      return $this->db->get($this->table)->result_array();
   }

   public function get_tagihan($page){
      $this->db->group_start();
      if($page == 'utang'){

         $this->db->where('tipe' ,'perolehan')
                  ->or_where('tipe', 'perbaikan')
                  ->or_where('tipe', 'pemeliharaan')
                  ->or_where('tipe', 'undur_diri')
                  ->or_where('tipe', 'transaksi_beban');
      
      }else if($page == 'piutang'){
         $this->db->where('tipe' ,'komponen_pendidikan')
                ->or_where('tipe', 'komponen_operasional')
                ->or_where('tipe', 'pinjaman');
      }
      $this->db->group_end();

      $this->db->where([
                  'pembayaran' => 'Kredit',
                  'level'      => '3',
                  'is_deny'    => '0'
               ])
               ->order_by('id', 'DESC')
               ->order_by('status', 'ASC');

      return $this->db->get('transaksi');
   }

}
