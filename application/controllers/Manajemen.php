<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';

class Manajemen extends CI_Controller {	
	
	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['roleIda'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
		$this->load->helper(array('url','html'));
		$this->load->model('db_model');
	}
     
	public function index()
	{
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$data['data']	= $this->db_model->list_users()->result_object();				
		$data['page']	= "page_manajemen";							
		$data['roleId']	= $this->db->query("select * from tbl_roles")->result_object();
		
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_manajemen',$data);
		$this->load->view('admin/templates/footer');
		
		
	}
	
	public function update(){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		ob_start();
		
		$name			= $this->input->post('name');
		$mobile			= $this->input->post('mobile');
		$password		= $this->input->post('password');
		$email			= $this->input->post('email');
		$roleId			= $this->input->post('roleId');
		$data = array(
            'name'  	=> $name,
            'mobile'	=> $mobile,
            'password' 	=> $password,
			'Email'		=> $email,
			'roleId'	=> $roleId,
		);

		
		$this->db->where('NIP', $NIP);
		$this->db->update('tbl_users', $data);
		  
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_manajemen_edit',$data);
		$this->load->view('admin/templates/footer');
		  
		header('location:'.base_url().'manajemen');
		
		ob_flush();		
	}
	
	public function edit_user($userId){
		//echo $id_doc;

		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$data = $this->db->query("select * from tbl_users where userId=".$userId)->result_array();
		$data['roleId']	= $this->db->query("select * from tbl_roles")->result_object();
		$data['name']	 		= $data[0]['name'];
		$data['mobile'] 		= $data[0]['mobile'];
		$data['email']	 		= $data[0]['email'];
		$data['password']	 	= $data[0]['password'];
		$data['roleId']	 		= $data[0]['roleId'];
		
		
		$data['page']	= "page_manajemen";
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_manajemen_edit',$data);
		$this->load->view('admin/templates/footer');
				
	}
	
	public function delete_user($userId){

		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$this->db->delete('tbl_users', array('userId' => $userId));
		//$this->load->view('admin/page_user_edit',$data);
		$this->load->view('admin/templates/footer');

		header('location:'.base_url().'manajemen');
	}
	
	public function submit(){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		ob_start();
		$name			= $this->input->post('name');
		$mobile			= $this->input->post('mobile');
		$password		= md5($this->input->post('password'));
		$email			= $this->input->post('email');
		$roleId			= $this->input->post('roleId');
		$data = array(
            'name'  	=> $name,
            'mobile'	=> $mobile,
            'password' 	=> $password,
			'Email'		=> $email,
			'roleId'	=> $roleId,
         );    		 		 
	
		 print_r($data);
		 
		 $cek = $this->db_model->insert_user($data);	 
		 
		 if ($cek!=1) {			  
			 echo "<script>alert('Error Save'); </script>";
		 }else{
			  //echo '<script>alert("Sukses");</script>';			  
			  redirect('Manajemen');		
		 }
		 
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_manajemen_edit',$data);
		$this->load->view('admin/templates/footer');
		ob_flush(); 
		
	}
	
}

