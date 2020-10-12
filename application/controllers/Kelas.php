<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';

class Kelas extends CI_Controller {	
	
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
		$data['data']	= $this->db_model->list_kelas()->result_object();				
		$data['page']	= "page_kelas";							
		
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_kelas',$data);
		$this->load->view('admin/templates/footer');
		
	}
	
	public function update(){
		ob_start();
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		
		$id_doc = $this->input->post('idkelas');
		$namekelas = $this->input->post('namekelas');
	
		$this->db->query("update tb_class set name='".$namekelas."' where id=".$id_doc);	
		header('location:'.base_url().'kelas');
		
		ob_flush();		
	}
	
	public function edit_kelas($id){
		//echo $id_doc;
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$data = $this->db->query("select * from tb_class where id=".$id)->result_array();
		$data['name'] = $data[0]['name'];
		$data['id'] = $data[0]['id'];		
		
		$data['page']	= "page_kelas";
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_kelas_edit',$data);
		$this->load->view('admin/templates/footer');
				
		
	}
	
	public function delete_kelas($id){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$this->db->delete('tb_class', array('id' => $id));
		header('location:'.base_url().'kelas');
	}
	
	public function submit(){
		ob_start();
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$idkelas		= $this->input->post('idkelas');
		$namekelas		= $this->input->post('namekelas');
		 
		 $data = array(
            'id'		=> $idkelas,
            'name'    	=> $namekelas
         );   

    	 		 
		 
		 print_r($data);
		 
		 $cek = $this->db_model->insert_kelas($data);	 
		 
		 if ($cek!=1) {			  
			 echo "<script>alert('Error Save'); </script>";
		 }else{
			  //echo '<script>alert("Sukses");</script>';			  
			  redirect('kelas');		
		 }
		 
		ob_flush(); 
		
	}
	
}

