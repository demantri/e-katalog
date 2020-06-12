<?php
 
Class Absensi_model extends CI_Model{

   protected $table = 'hr_absensi';

   public function get_list($req = '', $type = ''){

      $join = '';

      if($req != ''){
         if(array_key_exists('bulan', $req)){
            $join_date[] = "MONTH(waktu_masuk) = '".$req['bulan']."'";
         }

         if(array_key_exists('tahun', $req)){
            $join_date[] = "YEAR(waktu_masuk) = '".$req['tahun']."'";
         }

         if(array_key_exists('condition', $req)){
            $this->db->where($req['condition']);
         }
      }

      $i = 0;
      foreach ($join_date as $val) { $i++;
         
         if($i == 1){
            $join .= 'AND ';
         }

         $join .= $val;

         if(count($join_date) != $i){
            $join.= "AND ";
         }
      }

      if($type == 'gaji'){
         $this->db->select('karyawan.*,
                        jabatan.nama_jabatan,
                        jabatan.gaji,
                        COUNT(absensi.id) AS total_masuk,
                        COUNT(CASE absensi.status WHEN "terlambat" THEN 1 ELSE NULL END) AS total_terlambat,
                        COUNT(CASE absensi.status WHEN "izin" THEN 1 ELSE NULL END) AS total_izin,
                        COUNT(CASE absensi.status WHEN "dinas" THEN 1 ELSE NULL END) AS total_dinas,
                        COUNT(CASE absensi.status WHEN "sakit" THEN 1 ELSE NULL END) AS total_sakit,
                        COUNT(CASE absensi.status WHEN "hadir" THEN 1 ELSE NULL END) AS total_hadir')
               // ->where('absensi.waktu_masuk != "0000-00-00 00:00:00"')
                ->group_by('karyawan.id');

      }else{
         $this->db->select('karyawan.*,
                     absensi.id AS id_absensi,
                     DAY(waktu_masuk) AS hari,
                     absensi.waktu_masuk,
                     absensi.waktu_keluar,
                     absensi.status');
      }
      
      $this->db->join('hr_absensi absensi','absensi.karyawan_id = karyawan.id '.$join,'LEFT')
               ->join('hr_jabatan jabatan', 'jabatan.id = karyawan.jabatan_id');
      return $this->db->get('hr_karyawan karyawan');
   }
    
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
      $this->db->select('RIGHT(kode_karyawan,4) as kode', FALSE)
               ->order_by('kode_karyawan','DESC')
               ->limit(1);    
      
      $query = $this->db->get($this->table);  
      if($query->num_rows() <> 0){
         $data = $query->row();      
         $kode = intval($data->kode) + 1;    
      }else{
         $kode = 1;    
      }

      $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
      $code = "ABS-".$kodemax;
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

   public function get_izin_list($condition = ''){

      $this->db->select('izin.*, karyawan.kode_karyawan, karyawan.nama_karyawan');

      if($condition != ''){
         $this->db->where($condition);
      }

      $this->db->join('hr_karyawan karyawan','karyawan.id = izin.karyawan_id');

      return $this->db->get('hr_izin izin');
   }

   public function insert_izin($data){
      $this->db->insert('hr_izin',$data);

      if($this->db->affected_rows() > 0){
         return true;
      }
      return false;
   }

   public function update_izin($data, $id_izin){
      $this->db->where('id',$id_izin)
             ->update('hr_izin', $data);

      return true;
   }

   public function get_izin_detail($id_izin){
      $this->db->where('id',$id_izin);
      return $this->db->get('hr_izin');
   }

}
