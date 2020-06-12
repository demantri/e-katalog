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

  function get_kategori(){
      $this->db->order_by("jenis", "ASC");
      $query = $this->db->get("jenisbarang");
      return $query->result();
  }

  function get_sub_merk($id_jenisbarang)
  {
      $this->db->where('id_jenis', $id_jenisbarang);
      $this->db->where('id_jenis', $id_jenisbarang);
      $this->db->order_by('nama_merk', 'ASC');
      $query = $this->db->get('merk');
      // print_r($query);exit;
      $output = '<option value="">Pilih Merk</option>';
      foreach($query->result() as $row)
      {
        $output .= '<option value="'.$row->id.'">'.$row->nama_merk.'</option>';
      }
      return $output;
  }

   public function kode(){
    $this->db->select('RIGHT(barang.id, 2) as kode', FALSE);
    $this->db->order_by('id', 'DESC');
    $this->db->limit(1);

    $query =  $this->db->get('barang');
    if ($query->num_rows()<>0) {
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    }
    else
    {
      $kode = 1;
    }
    $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT);
    $kodejadi = "BRG".$kodemax;
    return $kodejadi;
  }

}
