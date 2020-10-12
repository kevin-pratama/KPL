<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';

class Trader extends CI_Controller {	
	
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
		$data['data']	= $this->db_model->list_trader()->result_object();				
		$data['page']	= "page_trader";							
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_trader',$data);
		$this->load->view('admin/templates/footer');
		
		
	}
	
	public function update(){
		ob_start();
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		
		$id_trader	= $this->input->post('id_trader');
		$nm_trader 	= $this->input->post('nm_trader');
		$al_trader  = $this->input->post('al_trader');
		$npwp       = $this->input->post('npwp');
		$email      = $this->input->post('email');
		$al_lokasi  = $this->input->post('al_lokasi');
		$data = array(

            'id_trader' 		=> $id_trader,
            'nm_trader'			=> $nm_trader,
			'al_trader'			=> $al_trader,
			'npwp'  			=> $npwp,
			'email'				=> $email,
			'al_lokasi'			=> $al_lokasi
            );

		
		$this->db->where('id_trader', $id_trader);
      	$this->db->update('tb_r_trader', $data);
		
		header('location:'.base_url().'trader');
		
		ob_flush();		
	}
	
	public function edit_trader($id_trader){
		//echo $id_doc;

		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$data = $this->db->query("select * from tb_r_trader where id_trader=".$id_trader)->result_array();
		$data['id_trader'] 				= $data[0]['id_trader'];
		$data['nm_trader'] 				= $data[0]['nm_trader'];
		$data['al_trader']	 			= $data[0]['al_trader'];
		$data['npwp']   	 			= $data[0]['npwp'];
		$data['email']	 				= $data[0]['email'];
		$data['al_lokasi']	 			= $data[0]['al_lokasi'];
		
		
		
		$data['page']	= "page_trader";		
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_trader_edit',$data);
		$this->load->view('admin/templates/footer');
	}
	
	public function delete_trader($id_trader){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$this->db->delete('tb_r_trader', array('id_trader' => $id_trader));
		header('location:'.base_url().'trader');
	}
	
	public function submit(){
		ob_start();
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$data = $this->db->query("select ifnull(max(id_trader),0)+1 as jml from tb_r_trader")->result_array();
		 $id_trader = $data[0]['jml'];
		 
		$nm_trader		= $this->input->post('nm_trader');
		$al_trader		= $this->input->post('al_trader');
		$npwp	    	= $this->input->post('npwp');
		$email			= $this->input->post('email');
		$al_lokasi		= $this->input->post('al_lokasi');
		
		$data = array(
            'id_trader'	=> $id_trader,
            'nm_trader' => $nm_trader,
            'al_trader'	=> $al_trader,
            'npwp'   	=> $npwp,
            'email'		=> $email,
            'al_lokasi' => $al_lokasi
         );    		 		 
	   
		 print_r($data);
		 
		 $cek = $this->db_model->insert_trader($data);	 
		 
		 if ($cek!=1) {			  
			 echo "<script>alert('Error Save'); </script>";
		 }else{
			  echo '<script>alert("Sukses");</script>';			  
			  redirect('Trader');		
		 }
		 
		ob_flush(); 
		
	}
	
}

