<?php 

class Kelas extends CI_Controller{

   function __construct(){
      parent::__construct();  
      $this->load->model('akademik/kelas_model','m_kelas');

      if(!$this->session->userdata('login')){
         redirect('');
      }
   }

   public function index(){
      $data['list']      = $this->m_kelas->get_data();
      $data['last_code'] = $this->m_kelas->generate_code();
      $this->template->load('layout/template','master_data/akademik/kelas/index', $data);
   }

   public function detail($kelas_id){
      $data['id'] = $kelas_id;
      $data['list_kelas'] = $this->m_kelas->get_list_kelas($kelas_id);
      $this->template->load('layout/template','master_data/kelas/detail', $data);
   }

   public function add(){
      $p = $this->input->post();

      $this->form_validation->set_data($p);
      $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');

      if($this->form_validation->run() == TRUE){

         if($this->m_kelas->insert($p)){
            $this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dimasukkan','success'));
         }else{
            $this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dimasukkan','danger'));
         }

      }else{
         $this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
      }

      redirect('master_data/akademik/kelas');
   }

   public function update(){
      $p  = $this->input->post();
      $id = $p['id_kelas'];

      unset($p['id_kelas']);

      $this->form_validation->set_data($p);
      $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');

      if($this->form_validation->run() == TRUE){

         if($this->m_kelas->update($p, $id)){
             $this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil diubah','success'));
         }else{
             $this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal diubah','danger'));
         }

      }else{
         $this->session->set_flashdata('alert_message', show_alert(validation_errors(),'warning'));
      }

      redirect('master_data/akademik/kelas');
   }

   public function delete($kelas_id){

      if($this->m_kelas->delete($kelas_id)){
         $this->session->set_flashdata('alert_message', show_alert('<b class="text-success"><i class="fa fa-check-circle"></i></b> Data berhasil dihapus','success'));
      }else{
         $this->session->set_flashdata('alert_message', show_alert('<b class="text-danger"><i class="fa fa-minus-circle"></i></b> Data gagal dihapus','danger'));
      }

      redirect('master_data/akademik/kelas');
   }
    
}