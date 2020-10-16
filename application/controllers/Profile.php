<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['roleIda'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {      
        $this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/page_profile');
		$this->load->view('admin/templates/footer');
    }

    public function edit($no)
     {
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
        $post = $this->input->post();
         if (!isset($no)) show_404();
       
         $user_model = $this->user_model;
         $validation = $this->form_validation;
         $validation->set_rules($user_model->rules());

         if ($validation->run()) {
             if($post["password_baru"] == $post["password_baru_konfirm"]){
                $user_model->update($no);  
             }else{
                $this->session->set_flashdata('error', 'konfirmasi password baru tidak sama');
             }
         }
         redirect(site_url('admin/profile'));
     }
   

}